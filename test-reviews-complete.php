<?php

// Complete test script for review fetching using the same approach as LeadService

require_once __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Complete Review API Test\n";
echo "========================\n\n";

$businessId = '0x47a84e21b8b0f545:0xf2637b649ae01e0';
$apiKey = env('SCRAPPA_API_KEY');

echo "Business ID: $businessId\n";
echo "API Key: " . ($apiKey ? 'Set (length: ' . strlen($apiKey) . ')' : 'NOT SET') . "\n\n";

if (!$apiKey) {
    echo "ERROR: SCRAPPA_API_KEY not set in .env\n";
    exit(1);
}

// Test 1: Direct API call using curl (same as LeadService)
echo "Test 1: Direct API call using curl (same method as LeadService)\n";
echo "================================================================\n";

$curl = curl_init();
$url = "https://app.scrappa.co/api/maps/reviews?business_id=" . urlencode($businessId) . "&sort=1";

curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-api-key: " . $apiKey
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

echo "HTTP Code: $httpCode\n";

if ($err) {
    echo "cURL Error: $err\n";
    exit(1);
}

if ($httpCode !== 200) {
    echo "API Error Response:\n";
    echo substr($response, 0, 500) . "\n";
    exit(1);
}

$data = json_decode($response, true);

if (!$data) {
    echo "Failed to decode JSON\n";
    exit(1);
}

echo "Response keys: " . implode(', ', array_keys($data)) . "\n";

// Check which key contains the reviews
$reviewsKey = null;
if (isset($data['items']) && is_array($data['items'])) {
    $reviewsKey = 'items';
    echo "Found reviews in 'items' key: " . count($data['items']) . " reviews\n";
} elseif (isset($data['data']) && is_array($data['data'])) {
    $reviewsKey = 'data';
    echo "Found reviews in 'data' key: " . count($data['data']) . " reviews\n";
}

if (!$reviewsKey) {
    echo "No reviews found in response\n";
    echo "Full response:\n";
    print_r($data);
    exit(1);
}

// Analyze first review structure
if (!empty($data[$reviewsKey])) {
    echo "\nFirst review structure:\n";
    $firstReview = $data[$reviewsKey][0];
    
    foreach ($firstReview as $key => $value) {
        if (is_array($value)) {
            echo "  $key: [array]\n";
            foreach ($value as $subKey => $subValue) {
                if (!is_array($subValue)) {
                    echo "    $subKey: " . (is_string($subValue) ? substr($subValue, 0, 50) : json_encode($subValue)) . "\n";
                }
            }
        } else {
            echo "  $key: " . (is_string($value) ? substr($value, 0, 50) : json_encode($value)) . "\n";
        }
    }
    
    // Find rating field
    echo "\nSearching for rating field:\n";
    $foundRating = false;
    
    // Check main level
    foreach (['rating', 'star_rating', 'stars', 'score'] as $field) {
        if (isset($firstReview[$field])) {
            echo "  Found '$field' at main level: " . $firstReview[$field] . "\n";
            $foundRating = true;
        }
    }
    
    // Check nested levels
    foreach ($firstReview as $key => $value) {
        if (is_array($value)) {
            foreach (['rating', 'star_rating', 'stars', 'score'] as $field) {
                if (isset($value[$field])) {
                    echo "  Found '$field' in nested '$key': " . $value[$field] . "\n";
                    $foundRating = true;
                }
            }
        }
    }
    
    if (!$foundRating) {
        echo "  WARNING: No rating field found!\n";
    }
}

// Test 2: Process all reviews and count ratings
echo "\n\nTest 2: Processing all reviews on first page\n";
echo "============================================\n";

$ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
$totalFound = 0;
$noRatingCount = 0;

foreach ($data[$reviewsKey] as $idx => $review) {
    $rating = null;
    
    // Try to find rating in various locations
    if (isset($review['rating'])) {
        $rating = $review['rating'];
    } elseif (isset($review['user_review']['rating'])) {
        $rating = $review['user_review']['rating'];
    } elseif (isset($review['star_rating'])) {
        $rating = $review['star_rating'];
    } elseif (isset($review['stars'])) {
        $rating = $review['stars'];
    }
    
    if ($rating !== null) {
        $ratingInt = (int)$rating;
        if ($ratingInt >= 1 && $ratingInt <= 5) {
            $ratingCounts[$ratingInt]++;
            $totalFound++;
        }
    } else {
        $noRatingCount++;
        if ($noRatingCount <= 3) {
            echo "Review $idx has no rating. Keys: " . implode(', ', array_keys($review)) . "\n";
        }
    }
}

echo "\nRating distribution:\n";
foreach ($ratingCounts as $stars => $count) {
    echo "  $stars stars: $count\n";
}
echo "Total reviews with ratings: $totalFound\n";
echo "Reviews without ratings: $noRatingCount\n";

// Test 3: Check pagination
echo "\n\nTest 3: Pagination\n";
echo "==================\n";

if (isset($data['nextPage'])) {
    echo "NextPage token found: " . substr($data['nextPage'], 0, 50) . "...\n";
    
    // Try fetching next page
    echo "\nFetching page 2...\n";
    
    $curl2 = curl_init();
    $url2 = "https://app.scrappa.co/api/maps/reviews?business_id=" . urlencode($businessId) . "&sort=1&nextPage=" . urlencode($data['nextPage']);
    
    curl_setopt_array($curl2, [
        CURLOPT_URL => $url2,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-api-key: " . $apiKey
        ],
    ]);
    
    $response2 = curl_exec($curl2);
    $httpCode2 = curl_getinfo($curl2, CURLINFO_HTTP_CODE);
    curl_close($curl2);
    
    if ($httpCode2 === 200) {
        $data2 = json_decode($response2, true);
        if ($data2 && isset($data2[$reviewsKey])) {
            echo "Page 2 fetched successfully: " . count($data2[$reviewsKey]) . " reviews\n";
        } else {
            echo "Page 2 response invalid\n";
        }
    } else {
        echo "Failed to fetch page 2: HTTP $httpCode2\n";
    }
} else {
    echo "No nextPage token found - might be single page\n";
}

// Test 4: Update the ReviewService with findings
echo "\n\nTest 4: ReviewService Update Recommendations\n";
echo "============================================\n";

echo "Based on the API response, the ReviewService should:\n";
echo "1. Look for reviews in the '$reviewsKey' key\n";
echo "2. Check for rating in these locations:\n";

if ($foundRating) {
    echo "   - " . implode("\n   - ", array_filter([
        isset($firstReview['rating']) ? "review['rating']" : null,
        isset($firstReview['user_review']['rating']) ? "review['user_review']['rating']" : null,
        isset($firstReview['star_rating']) ? "review['star_rating']" : null,
        isset($firstReview['stars']) ? "review['stars']" : null,
    ])) . "\n";
}

echo "3. Use 'nextPage' token for pagination\n";

// Test 5: Full service test
echo "\n\nTest 5: Testing actual ReviewService\n";
echo "====================================\n";

use App\Models\Lead;
use App\Service\ReviewService;

// Find or create a test lead
$lead = Lead::where('google_business_id', $businessId)->first();

if (!$lead) {
    // Find lead with ID 1
    $lead = Lead::find(1);
    if ($lead) {
        $lead->google_business_id = $businessId;
        $lead->save();
        echo "Updated lead ID 1 with business ID\n";
    } else {
        echo "No lead found to test with\n";
        exit(1);
    }
}

echo "Testing with lead: {$lead->name} (ID: {$lead->id})\n";

$reviewService = new ReviewService();
$result = $reviewService->fetchAndUpdateReviews($lead);

echo "Service result: " . ($result ? 'SUCCESS' : 'FAILED') . "\n";

$lead->refresh();
echo "\nUpdated lead data:\n";
echo "1-star: {$lead->one_star_count}\n";
echo "2-star: {$lead->two_star_count}\n";
echo "3-star: {$lead->three_star_count}\n";
echo "4-star: {$lead->four_star_count}\n";
echo "5-star: {$lead->five_star_count}\n";
echo "Total: {$lead->total_reviews}\n";
echo "Average: " . ($lead->average_rating ?? 'null') . "\n";

echo "\n\nDONE!\n";