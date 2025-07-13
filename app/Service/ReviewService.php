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
    public function fetchAndUpdateReviews(Lead $lead, $consoleOutput = null): bool
    {
        try {
            // Skip if no Google Business ID
            if (!$lead->google_business_id) {
                // Try to extract from URL if possible
                $businessId = $this->extractBusinessIdFromUrl($lead->link);
                if (!$businessId) {
                    $message = "No Google Business ID for lead: {$lead->id}";
                    Log::info($message);
                    if ($consoleOutput) {
                        $consoleOutput->warning($message);
                    }
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

            do {
                $reviews = $this->fetchReviewsPage($lead->google_business_id, $nextPageToken, $consoleOutput);
                
                if (!$reviews) {
                    $message = "Failed to fetch reviews for lead {$lead->id} with business ID: {$lead->google_business_id}";
                    Log::error($message);
                    if ($consoleOutput) {
                        $consoleOutput->error($message);
                    }
                    break;
                }
                
                // Check for 'items' key (used by Scrappa API)
                $reviewsArray = $reviews['items'] ?? $reviews['data'] ?? [];
                
                if (empty($reviewsArray)) {
                    $message = "No reviews found for lead {$lead->id} on page {$pageCount}";
                    Log::info($message);
                    if ($consoleOutput && $pageCount === 1) {
                        $consoleOutput->warning("Lead {$lead->id} ({$lead->name}): No reviews found");
                    }
                    break;
                }
                
                if ($consoleOutput && $pageCount === 1) {
                    $consoleOutput->info("Lead {$lead->id} ({$lead->name}): Processing reviews...");
                }

                foreach ($reviewsArray as $review) {
                    // Rating is at the main level
                    $rating = isset($review['rating']) ? (int)$review['rating'] : null;
                    
                    if ($rating >= 1 && $rating <= 5) {
                        $reviewCounts[$rating]++;
                        $totalRating += $rating;
                        $totalReviews++;
                    }
                }

                // Get next page token
                $nextPageToken = $reviews['nextPage'] ?? null;
                $pageCount++;

                // Safety limit to prevent infinite loops
                if ($pageCount > 500) {
                    Log::warning("Review fetching stopped at page 100 for lead: {$lead->id}");
                    break;
                }
            } while ($nextPageToken);

            // Calculate average rating
            $averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 2) : null;

            // Log the counts before updating
            Log::info("Review counts for lead {$lead->id}: " . json_encode([
                '1_star' => $reviewCounts[1],
                '2_star' => $reviewCounts[2],
                '3_star' => $reviewCounts[3],
                '4_star' => $reviewCounts[4],
                '5_star' => $reviewCounts[5],
                'total' => $totalReviews
            ]));

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
    protected function fetchReviewsPage(string $businessId, ?string $nextPageToken = null, $consoleOutput = null): ?array
    {
        $maxRetries = 3;
        $retryDelay = 2; // seconds
        
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $params = [
                    'business_id' => $businessId,
                    'sort' => 1, // Sort by most relevant
                ];

                // Add next page token if available
                if ($nextPageToken) {
                    $params['nextPage'] = $nextPageToken;
                }

                $response = Http::timeout(30)
                    ->withHeaders([
                        'x-api-key' => $this->apiKey,
                    ])
                    ->get($this->baseUrl, $params);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    // Validate response structure
                    if (!is_array($data)) {
                        $message = "Scrappa API returned non-array response for business {$businessId}";
                        Log::warning($message, [
                            'response_type' => gettype($data),
                            'response' => substr(json_encode($data), 0, 500),
                            'attempt' => $attempt
                        ]);
                        
                        if ($consoleOutput) {
                            $consoleOutput->error($message);
                            $consoleOutput->line("  Response type: " . gettype($data));
                            $consoleOutput->line("  Response: " . substr(json_encode($data), 0, 200) . "...");
                        }
                        
                        if ($attempt < $maxRetries) {
                            if ($consoleOutput) {
                                $consoleOutput->warning("  Retrying in {$retryDelay} seconds...");
                            }
                            sleep($retryDelay);
                            continue;
                        }
                        return null;
                    }
                    
                    // Check for expected structure
                    if (!isset($data['items']) && !isset($data['data'])) {
                        $message = "Scrappa API response missing items/data key for business {$businessId}";
                        Log::warning($message, [
                            'response_keys' => array_keys($data),
                            'response_sample' => substr(json_encode($data), 0, 500),
                            'attempt' => $attempt
                        ]);
                        
                        if ($consoleOutput) {
                            $consoleOutput->error($message);
                            $consoleOutput->line("  Response keys: " . implode(', ', array_keys($data)));
                            if (count($data) < 10) {
                                $consoleOutput->line("  Full response: " . json_encode($data));
                            } else {
                                $consoleOutput->line("  Response sample: " . substr(json_encode($data), 0, 200) . "...");
                            }
                        }
                        
                        // Check if it's an error response
                        if (isset($data['error']) || isset($data['message'])) {
                            $errorMsg = $data['error'] ?? $data['message'] ?? 'Unknown error';
                            Log::error("Scrappa API error response", [
                                'business_id' => $businessId,
                                'error' => $errorMsg,
                                'attempt' => $attempt
                            ]);
                            
                            if ($consoleOutput) {
                                $consoleOutput->error("  API Error: " . $errorMsg);
                            }
                        }
                        
                        if ($attempt < $maxRetries) {
                            if ($consoleOutput) {
                                $consoleOutput->warning("  Retrying in {$retryDelay} seconds...");
                            }
                            sleep($retryDelay);
                            continue;
                        }
                        return null;
                    }
                    
                    // Log if we get an empty response
                    $itemsCount = count($data['items'] ?? $data['data'] ?? []);
                    if ($itemsCount === 0 && !$nextPageToken) {
                        Log::info("Scrappa API returned 0 reviews for business {$businessId} on first page", [
                            'has_next_page' => isset($data['nextPage']),
                            'response_keys' => array_keys($data)
                        ]);
                    }
                    
                    return $data;
                }

                // Log different types of HTTP errors
                $statusCode = $response->status();
                $body = $response->body();
                
                if ($statusCode === 429) {
                    $message = "Scrappa API rate limit hit for business {$businessId}";
                    Log::warning($message . ", attempt {$attempt}/{$maxRetries}");
                    
                    if ($consoleOutput) {
                        $consoleOutput->warning($message);
                    }
                    
                    if ($attempt < $maxRetries) {
                        if ($consoleOutput) {
                            $consoleOutput->line("  Waiting " . ($retryDelay * 2) . " seconds before retry...");
                        }
                        sleep($retryDelay * 2); // Double delay for rate limits
                        continue;
                    }
                } elseif ($statusCode === 401) {
                    $message = "Scrappa API authentication failed - check API key";
                    Log::error($message, [
                        'business_id' => $businessId,
                        'response' => substr($body, 0, 200)
                    ]);
                    
                    if ($consoleOutput) {
                        $consoleOutput->error($message);
                        $consoleOutput->line("  Response: " . substr($body, 0, 100));
                    }
                    
                    return null; // Don't retry auth errors
                } elseif ($statusCode >= 500) {
                    $message = "Scrappa API server error (HTTP {$statusCode}) for business {$businessId}";
                    Log::error($message, [
                        'status' => $statusCode,
                        'response' => substr($body, 0, 500),
                        'attempt' => $attempt
                    ]);
                    
                    if ($consoleOutput) {
                        $consoleOutput->error($message);
                        $consoleOutput->line("  Response: " . substr($body, 0, 200) . "...");
                    }
                    
                    if ($attempt < $maxRetries) {
                        if ($consoleOutput) {
                            $consoleOutput->warning("  Retrying in {$retryDelay} seconds...");
                        }
                        sleep($retryDelay);
                        continue;
                    }
                } else {
                    $message = "Scrappa API error (HTTP {$statusCode}) for business {$businessId}";
                    Log::error($message, [
                        'status' => $statusCode,
                        'response' => substr($body, 0, 500),
                        'attempt' => $attempt
                    ]);
                    
                    if ($consoleOutput) {
                        $consoleOutput->error($message);
                        $consoleOutput->line("  Response: " . substr($body, 0, 200) . "...");
                    }
                }
                
                if ($attempt < $maxRetries) {
                    sleep($retryDelay);
                    continue;
                }
                
                return null;

            } catch (Exception $e) {
                Log::error("Exception calling Scrappa API for business {$businessId}", [
                    'error' => $e->getMessage(),
                    'attempt' => $attempt,
                    'class' => get_class($e)
                ]);
                
                if ($attempt < $maxRetries) {
                    sleep($retryDelay);
                    continue;
                }
                
                return null;
            }
        }
        
        Log::error("Failed to fetch reviews after {$maxRetries} attempts for business {$businessId}");
        return null;
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