<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Lead;
use App\Service\ReviewService;

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Debug Review Processing\n";
echo "======================\n\n";

// Get a specific lead ID from command line or use default
$leadId = $argv[1] ?? 1;

$lead = Lead::find($leadId);
if (!$lead) {
    echo "Lead with ID $leadId not found\n";
    exit(1);
}

echo "Testing with Lead:\n";
echo "ID: {$lead->id}\n";
echo "Name: {$lead->name}\n";
echo "Business ID: {$lead->google_business_id}\n";
echo "Link: {$lead->link}\n\n";

// Create review service
$reviewService = new ReviewService();

// Use reflection to test the fetchReviewsPage method
$reflection = new ReflectionClass($reviewService);
$fetchMethod = $reflection->getMethod('fetchReviewsPage');
$fetchMethod->setAccessible(true);

// Extract business ID if needed
if (!$lead->google_business_id && $lead->link) {
    $extractMethod = $reflection->getMethod('extractBusinessIdFromUrl');
    $extractMethod->setAccessible(true);
    
    $businessId = $extractMethod->invoke($reviewService, $lead->link);
    if ($businessId) {
        echo "Extracted Business ID: $businessId\n";
        $lead->google_business_id = $businessId;
        $lead->save();
    }
}

if (!$lead->google_business_id) {
    echo "No Google Business ID available\n";
    exit(1);
}

echo "\nFetching first page of reviews...\n";

// Fetch first page
$response = $fetchMethod->invoke($reviewService, $lead->google_business_id, null);

if (!$response) {
    echo "Failed to fetch reviews - check logs\n";
    exit(1);
}

echo "\nAPI Response Structure:\n";
echo "Top-level keys: " . implode(', ', array_keys($response)) . "\n";

// Check for items or data key
$reviewsKey = null;
if (isset($response['items'])) {
    $reviewsKey = 'items';
    echo "Number of reviews in 'items': " . count($response['items']) . "\n";
} elseif (isset($response['data'])) {
    $reviewsKey = 'data';
    echo "Number of reviews in 'data': " . count($response['data']) . "\n";
}

if ($reviewsKey && !empty($response[$reviewsKey])) {
    echo "\nFirst Review Structure:\n";
    $firstReview = $response[$reviewsKey][0];
        
        // Show all fields
        foreach ($firstReview as $key => $value) {
            if (is_array($value)) {
                echo "  $key: [array with " . count($value) . " items]\n";
                // If it's a small array, show its structure
                if (count($value) <= 5) {
                    foreach ($value as $subKey => $subValue) {
                        echo "    $subKey: " . (is_string($subValue) ? substr($subValue, 0, 50) : json_encode($subValue)) . "\n";
                    }
                }
            } else {
                echo "  $key: " . (is_string($value) ? substr($value, 0, 100) : json_encode($value)) . "\n";
            }
        }
        
        echo "\nRating Detection:\n";
        
        // Check for rating in main object
        $rating = null;
        if (isset($firstReview['rating'])) {
            $rating = $firstReview['rating'];
            echo "Found 'rating' field: $rating\n";
        }
        if (isset($firstReview['star_rating'])) {
            $rating = $firstReview['star_rating'];
            echo "Found 'star_rating' field: $rating\n";
        }
        
        // Check if rating might be nested
        foreach ($firstReview as $key => $value) {
            if (is_array($value)) {
                if (isset($value['rating'])) {
                    echo "Found nested rating in '$key': " . $value['rating'] . "\n";
                }
                if (isset($value['star_rating'])) {
                    echo "Found nested star_rating in '$key': " . $value['star_rating'] . "\n";
                }
                if (isset($value['stars'])) {
                    echo "Found nested stars in '$key': " . $value['stars'] . "\n";
                }
            }
        }
        
        echo "\nProcessing all reviews on first page:\n";
        $counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $foundRatings = 0;
        
        foreach ($response[$reviewsKey] as $idx => $review) {
            $rating = null;
            
            // Try different rating locations
            if (isset($review['rating'])) {
                $rating = $review['rating'];
            } elseif (isset($review['star_rating'])) {
                $rating = $review['star_rating'];
            } elseif (isset($review['stars'])) {
                $rating = $review['stars'];
            }
            
            // Check nested structures
            if (!$rating) {
                foreach ($review as $field => $value) {
                    if (is_array($value) && (isset($value['rating']) || isset($value['star_rating']) || isset($value['stars']))) {
                        $rating = $value['rating'] ?? $value['star_rating'] ?? $value['stars'];
                        break;
                    }
                }
            }
            
            if ($rating !== null) {
                $ratingInt = (int)$rating;
                if ($ratingInt >= 1 && $ratingInt <= 5) {
                    $counts[$ratingInt]++;
                    $foundRatings++;
                } else {
                    echo "  Review $idx: Invalid rating value: $rating\n";
                }
            } else {
                echo "  Review $idx: No rating found\n";
                if ($idx < 3) { // Show structure of first few reviews without rating
                    echo "    Fields: " . implode(', ', array_keys($review)) . "\n";
                }
            }
        }
        
        echo "\nRating Summary:\n";
        echo "Found ratings in $foundRatings/" . count($response['data']) . " reviews\n";
        foreach ($counts as $stars => $count) {
            if ($count > 0) {
                echo "  $stars stars: $count\n";
            }
        }
    }
}

// Check pagination
echo "\nPagination Info:\n";
if (isset($response['nextPage'])) {
    echo "NextPage token: " . substr($response['nextPage'], 0, 50) . "...\n";
} else {
    echo "No nextPage token found\n";
}

// Now test the full update process
echo "\n\nTesting Full Update Process:\n";
echo "============================\n";

$result = $reviewService->fetchAndUpdateReviews($lead);

echo "Update result: " . ($result ? 'SUCCESS' : 'FAILED') . "\n";

// Reload lead to see updated values
$lead->refresh();

echo "\nUpdated Lead Data:\n";
echo "1-star reviews: {$lead->one_star_count}\n";
echo "2-star reviews: {$lead->two_star_count}\n";
echo "3-star reviews: {$lead->three_star_count}\n";
echo "4-star reviews: {$lead->four_star_count}\n";
echo "5-star reviews: {$lead->five_star_count}\n";
echo "Total reviews: {$lead->total_reviews}\n";
echo "Average rating: " . ($lead->average_rating ?? 'null') . "\n";
echo "Last updated: " . ($lead->reviews_last_updated_at ?? 'null') . "\n";