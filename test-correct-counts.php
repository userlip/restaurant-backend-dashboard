<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Service\ReviewService;

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$businessId = '0x47a84e21b8b0f545:0xf2637b649ae01e0';

echo "Testing Correct Review Counting\n";
echo "===============================\n\n";

// Test the fetchReviewsPage method directly
$reviewService = new ReviewService();
$reflection = new ReflectionClass($reviewService);
$fetchMethod = $reflection->getMethod('fetchReviewsPage');
$fetchMethod->setAccessible(true);

$totalReviews = 0;
$ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
$nextPageToken = null;
$pageCount = 0;

echo "Fetching ALL reviews (sort=1 - most relevant)...\n\n";

do {
    $pageCount++;
    $response = $fetchMethod->invoke($reviewService, $businessId, $nextPageToken);
    
    if (!$response || empty($response['items'])) {
        break;
    }
    
    $pageReviews = count($response['items']);
    echo "Page $pageCount: $pageReviews reviews\n";
    
    foreach ($response['items'] as $review) {
        $rating = isset($review['rating']) ? (int)$review['rating'] : null;
        
        if ($rating >= 1 && $rating <= 5) {
            $ratingCounts[$rating]++;
            $totalReviews++;
        }
    }
    
    $nextPageToken = $response['nextPage'] ?? null;
    
    // Show running totals every 5 pages
    if ($pageCount % 5 == 0) {
        echo "  Running total: $totalReviews reviews\n";
    }
    
    // Limit for testing
    if ($pageCount >= 20) {
        echo "  (Stopped at 20 pages for testing)\n";
        break;
    }
    
} while ($nextPageToken);

echo "\n\nFinal Results:\n";
echo "==============\n";
echo "Total reviews: $totalReviews\n\n";

echo "Rating distribution:\n";
$totalForAvg = 0;
foreach ($ratingCounts as $stars => $count) {
    $percentage = $totalReviews > 0 ? round(($count / $totalReviews) * 100, 1) : 0;
    echo "  $stars stars: $count ({$percentage}%)\n";
    $totalForAvg += $stars * $count;
}

$avgRating = $totalReviews > 0 ? round($totalForAvg / $totalReviews, 2) : 0;
echo "\nCalculated average: $avgRating\n";

echo "\nThis should match the Google rating much more closely!\n";