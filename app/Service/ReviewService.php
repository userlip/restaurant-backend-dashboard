<?php

namespace App\Service;

use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ReviewService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://app.scrappa.co/api/maps/reviews';

    public function __construct()
    {
        $this->apiKey = config('services.scrappa.api_key');
    }

    /**
     * Fetch reviews for a lead from Scrappa API
     *
     * @param Lead $lead
     * @return bool
     */
    public function fetchAndUpdateReviews(Lead $lead): bool
    {
        try {
            // Skip if no Google Business ID
            if (!$lead->google_business_id) {
                // Try to extract from URL if possible
                $businessId = $this->extractBusinessIdFromUrl($lead->link);
                if (!$businessId) {
                    Log::info("No Google Business ID for lead: {$lead->id}");
                    return false;
                }
                $lead->update(['google_business_id' => $businessId]);
            }

            $reviewCounts = [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
            ];
            $totalRating = 0;
            $totalReviews = 0;
            $nextPageToken = null;
            $pageCount = 0;

            $stopFetching = false;
            
            do {
                $reviews = $this->fetchReviewsPage($lead->google_business_id, $nextPageToken);
                
                if (!$reviews) {
                    Log::error("Failed to fetch reviews for lead {$lead->id} with business ID: {$lead->google_business_id}");
                    break;
                }
                
                // Check for 'items' key (used by Scrappa API)
                $reviewsArray = $reviews['items'] ?? $reviews['data'] ?? [];
                
                if (empty($reviewsArray)) {
                    Log::info("No reviews found for lead {$lead->id} on page {$pageCount}");
                    break;
                }
                
                Log::info("Fetched " . count($reviewsArray) . " reviews for lead {$lead->id} on page {$pageCount}");

                foreach ($reviewsArray as $review) {
                    // Rating is at the main level
                    $rating = isset($review['rating']) ? (int)$review['rating'] : null;
                    
                    if ($rating >= 1 && $rating <= 5) {
                        $reviewCounts[$rating]++;
                        $totalRating += $rating;
                        $totalReviews++;
                        
                        // Stop when we encounter a 4-star review (since we're sorting by lowest rating first)
                        if ($rating >= 4) {
                            Log::info("Stopping at 4-star review for lead {$lead->id}. Total reviews processed: {$totalReviews}");
                            $stopFetching = true;
                            break;
                        }
                    }
                }

                if ($stopFetching) {
                    break;
                }

                // Get next page token
                $nextPageToken = $reviews['nextPage'] ?? null;
                $pageCount++;

                // Safety limit to prevent infinite loops
                if ($pageCount > 50) {
                    Log::warning("Review fetching stopped at page 50 for lead: {$lead->id}");
                    break;
                }

                // Small delay between requests
                if ($nextPageToken) {
                    sleep(1);
                }
            } while ($nextPageToken);

            // Calculate average rating
            $averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 2) : null;

            // Update the lead with review data
            $lead->update([
                'one_star_count' => $reviewCounts[1],
                'two_star_count' => $reviewCounts[2],
                'three_star_count' => $reviewCounts[3],
                'four_star_count' => $reviewCounts[4],
                'five_star_count' => $reviewCounts[5],
                'total_reviews' => $totalReviews,
                'average_rating' => $averageRating,
                'reviews_last_updated_at' => now(),
            ]);

            Log::info("Successfully updated reviews for lead: {$lead->id}. Total: {$totalReviews}");
            return true;

        } catch (Exception $e) {
            Log::error("Error fetching reviews for lead {$lead->id}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Fetch a single page of reviews
     *
     * @param string $businessId
     * @param string|null $nextPageToken
     * @return array|null
     */
    protected function fetchReviewsPage(string $businessId, ?string $nextPageToken = null): ?array
    {
        try {
            $params = [
                'business_id' => $businessId,
                'sort' => 4, // Sort by lowest rating first
            ];

            // Add next page token if available
            if ($nextPageToken) {
                $params['nextPage'] = $nextPageToken;
            }

            $response = Http::withHeaders([
                'x-api-key' => $this->apiKey,
            ])->get($this->baseUrl, $params);

            if ($response->successful()) {
                $data = $response->json();
                
                
                return $data;
            }

            Log::error("Scrappa API error for business {$businessId}: HTTP {$response->status()} - " . $response->body());
            return null;

        } catch (Exception $e) {
            Log::error("Error calling Scrappa API: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Extract Google Business ID from a Google Maps URL
     *
     * @param string|null $url
     * @return string|null
     */
    protected function extractBusinessIdFromUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        // Try to find any business ID pattern in the URL
        // Business IDs are in format: 0x[hex]:0x[hex]
        if (preg_match('/(0x[a-f0-9]+:0x[a-f0-9]+)/i', $url, $matches)) {
            return $matches[1];
        }

        // Alternative patterns for different URL structures
        $patterns = [
            '/!1s(0x[a-f0-9]+:[a-f0-9x]+)/i',
            '/place\/[^\/]+\/(0x[a-f0-9]+:0x[a-f0-9]+)/i',
            '/data=!.*!1s(0x[a-f0-9]+:0x[a-f0-9]+)/i',
            '/\@.*?!1s(0x[a-f0-9]+:0x[a-f0-9]+)/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Update reviews for all active leads
     *
     * @return void
     */
    public function updateAllActiveLeads(): void
    {
        $leads = Lead::whereIn('status', ['new', 'contacted'])
            ->whereNotNull('link')
            ->get();

        $successCount = 0;
        $failCount = 0;

        foreach ($leads as $lead) {
            if ($this->fetchAndUpdateReviews($lead)) {
                $successCount++;
            } else {
                $failCount++;
            }

            // Add a small delay to avoid rate limiting
            sleep(1);
        }

        Log::info("Review update completed. Success: {$successCount}, Failed: {$failCount}");
    }
}