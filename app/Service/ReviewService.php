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
            $page = 1;
            $hasMore = true;

            while ($hasMore) {
                $reviews = $this->fetchReviewsPage($lead->google_business_id, $page);
                
                if (!$reviews || empty($reviews['data'])) {
                    $hasMore = false;
                    break;
                }

                foreach ($reviews['data'] as $review) {
                    // Handle different possible field names for rating
                    $rating = (int) ($review['rating'] ?? $review['star_rating'] ?? 0);
                    if ($rating >= 1 && $rating <= 5) {
                        $reviewCounts[$rating]++;
                        $totalRating += $rating;
                        $totalReviews++;
                    }
                }

                // Check if there are more pages
                $hasMore = $reviews['has_more'] ?? false;
                $page++;

                // Safety limit to prevent infinite loops
                if ($page > 50) {
                    Log::warning("Review fetching stopped at page 50 for lead: {$lead->id}");
                    break;
                }
            }

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
     * @param int $page
     * @return array|null
     */
    protected function fetchReviewsPage(string $businessId, int $page = 1): ?array
    {
        try {
            $response = Http::withHeaders([
                'x-rapidapi-key' => $this->apiKey,
            ])->get($this->baseUrl, [
                'business_id' => $businessId,
                'sort' => 1, // Sort by newest
                'page' => $page,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error("Scrappa API error: " . $response->body());
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

        // Pattern to match Google Business ID in various URL formats
        // Example: https://www.google.com/maps/place/.../@...!1s0x3bae179ad3b6da99:0xd823b05add6a7fae
        $patterns = [
            '/!1s(0x[a-f0-9]+:[a-f0-9x]+)/',
            '/0x[a-f0-9]+:[a-f0-9x]+/',
            '/place\/.*\/data=.*!1s(0x[a-f0-9]+:[a-f0-9x]+)/',
            '/data=!.*!1s(0x[a-f0-9]+:0x[a-f0-9]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1] ?? $matches[0];
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