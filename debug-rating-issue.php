<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Lead;
use App\Service\ReviewService;

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Debug Rating Count Issue\n";
echo "========================\n\n";

// Test with a lead
$lead = Lead::whereNotNull('google_business_id')->first();

if (!$lead) {
    // Create a test lead
    $lead = new Lead();
    $lead->id = 999999;
    $lead->name = 'Test Lead';
    $lead->google_business_id = '0x47a84e21b8b0f545:0xf2637b649ae01e0';
}

echo "Testing with lead: {$lead->name}\n";
echo "Business ID: {$lead->google_business_id}\n\n";

// Manually test the review counting logic
$reviewService = new ReviewService();
$reflection = new ReflectionClass($reviewService);
$fetchMethod = $reflection->getMethod('fetchReviewsPage');
$fetchMethod->setAccessible(true);

// Fetch first page
$response = $fetchMethod->invoke($reviewService, $lead->google_business_id, null);

if (!$response || empty($response['items'])) {
    echo "No reviews found\n";
    exit(1);
}

echo "Got " . count($response['items']) . " reviews\n\n";

// Initialize counts like in the service
$reviewCounts = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
];

echo "Processing reviews:\n";
echo "===================\n";

foreach ($response['items'] as $idx => $review) {
    echo "\nReview " . ($idx + 1) . ":\n";
    echo "  Raw rating value: " . json_encode($review['rating'] ?? 'missing') . "\n";
    echo "  Type: " . gettype($review['rating'] ?? null) . "\n";
    
    $rating = isset($review['rating']) ? (int)$review['rating'] : null;
    echo "  Converted to int: $rating\n";
    
    if ($rating >= 1 && $rating <= 5) {
        echo "  Incrementing count for $rating stars\n";
        $reviewCounts[$rating]++;
    } else {
        echo "  Invalid rating - skipped\n";
    }
    
    if ($idx >= 4) { // Just show first 5 for debugging
        echo "\n... (showing first 5 only)\n";
        break;
    }
}

echo "\nFinal counts:\n";
foreach ($reviewCounts as $stars => $count) {
    echo "  $stars stars: $count\n";
}

// Now test the actual service method
echo "\n\nTesting actual ReviewService:\n";
echo "=============================\n";

// Reset the lead's counts
$lead->one_star_count = 0;
$lead->two_star_count = 0;
$lead->three_star_count = 0;
$lead->four_star_count = 0;
$lead->five_star_count = 0;
$lead->total_reviews = 0;

// Call the service
$result = $reviewService->fetchAndUpdateReviews($lead);

echo "Service result: " . ($result ? 'SUCCESS' : 'FAILED') . "\n";
echo "\nCounts after service:\n";
echo "1-star: {$lead->one_star_count}\n";
echo "2-star: {$lead->two_star_count}\n";
echo "3-star: {$lead->three_star_count}\n";
echo "4-star: {$lead->four_star_count}\n";
echo "5-star: {$lead->five_star_count}\n";
echo "Total: {$lead->total_reviews}\n";

// Check the database update array
echo "\n\nChecking what values would be saved:\n";
$updateArray = [
    'one_star_count' => $reviewCounts[1],
    'two_star_count' => $reviewCounts[2],
    'three_star_count' => $reviewCounts[3],
    'four_star_count' => $reviewCounts[4],
    'five_star_count' => $reviewCounts[5],
];

echo "Update array:\n";
print_r($updateArray);