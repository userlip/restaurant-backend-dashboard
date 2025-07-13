<?php

// Simple test of ReviewService without database

require_once __DIR__ . '/vendor/autoload.php';

use App\Service\ReviewService;
use Illuminate\Support\Facades\Http;

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$businessId = '0x47a84e21b8b0f545:0xf2637b649ae01e0';

echo "Testing ReviewService with business ID: $businessId\n";
echo "================================================\n\n";

// Test the fetchReviewsPage method directly
$reviewService = new ReviewService();
$reflection = new ReflectionClass($reviewService);
$fetchMethod = $reflection->getMethod('fetchReviewsPage');
$fetchMethod->setAccessible(true);

echo "Fetching first page...\n";
$page1 = $fetchMethod->invoke($reviewService, $businessId, null);

if (!$page1) {
    echo "Failed to fetch first page\n";
    exit(1);
}

echo "Success! Got " . count($page1['items'] ?? []) . " reviews\n";

// Count ratings
$ratings = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
$total = 0;

foreach ($page1['items'] ?? [] as $review) {
    if (isset($review['rating'])) {
        $rating = (int)$review['rating'];
        if ($rating >= 1 && $rating <= 5) {
            $ratings[$rating]++;
            $total++;
        }
    }
}

echo "\nFirst page ratings:\n";
foreach ($ratings as $stars => $count) {
    if ($count > 0) {
        echo "  $stars stars: $count\n";
    }
}

// Test pagination
if (isset($page1['nextPage'])) {
    echo "\nFetching second page...\n";
    $page2 = $fetchMethod->invoke($reviewService, $businessId, $page1['nextPage']);
    
    if ($page2 && isset($page2['items'])) {
        echo "Success! Got " . count($page2['items']) . " more reviews\n";
        
        foreach ($page2['items'] as $review) {
            if (isset($review['rating'])) {
                $rating = (int)$review['rating'];
                if ($rating >= 1 && $rating <= 5) {
                    $ratings[$rating]++;
                    $total++;
                }
            }
        }
    }
}

echo "\nTotal ratings after 2 pages:\n";
foreach ($ratings as $stars => $count) {
    if ($count > 0) {
        echo "  $stars stars: $count\n";
    }
}
echo "Total reviews: $total\n";

$avgRating = 0;
foreach ($ratings as $stars => $count) {
    $avgRating += $stars * $count;
}
$avgRating = $total > 0 ? round($avgRating / $total, 2) : 0;
echo "Average rating: $avgRating\n";

echo "\nReviewService is working correctly!\n";