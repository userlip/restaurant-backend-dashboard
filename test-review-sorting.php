<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Service\ReviewService;

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$businessId = '0x47a84e21b8b0f545:0xf2637b649ae01e0';

echo "Testing Review Sorting (sort=4 - Lowest Rating First)\n";
echo "=====================================================\n\n";

// Test the fetchReviewsPage method directly
$reviewService = new ReviewService();
$reflection = new ReflectionClass($reviewService);
$fetchMethod = $reflection->getMethod('fetchReviewsPage');
$fetchMethod->setAccessible(true);

echo "Fetching first page with sort=4...\n";
$page1 = $fetchMethod->invoke($reviewService, $businessId, null);

if (!$page1) {
    echo "Failed to fetch first page\n";
    exit(1);
}

$reviews = $page1['items'] ?? [];
echo "Got " . count($reviews) . " reviews\n\n";

echo "First 10 reviews (should be lowest ratings first):\n";
echo "==================================================\n";

$foundFourStar = false;
$reviewCount = 0;

foreach ($reviews as $idx => $review) {
    if ($idx >= 10) break;
    
    $rating = $review['rating'] ?? 'N/A';
    $author = $review['author_name'] ?? 'Unknown';
    $text = isset($review['review_text'][0]) ? substr($review['review_text'][0], 0, 50) : 'No text';
    
    echo sprintf("%d. ★%d - %s: %s...\n", $idx + 1, $rating, $author, $text);
    
    if ($rating >= 4) {
        $foundFourStar = true;
        echo "\n>>> Found 4+ star review at position " . ($idx + 1) . " - would stop here!\n";
        break;
    }
    
    $reviewCount++;
}

echo "\nSimulating full fetch with stop condition:\n";
echo "==========================================\n";

$totalReviews = 0;
$ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
$nextPageToken = null;
$pageCount = 0;
$stopped = false;

do {
    $pageCount++;
    $response = $fetchMethod->invoke($reviewService, $businessId, $nextPageToken);
    
    if (!$response || empty($response['items'])) {
        break;
    }
    
    echo "Page $pageCount: " . count($response['items']) . " reviews\n";
    
    foreach ($response['items'] as $review) {
        $rating = isset($review['rating']) ? (int)$review['rating'] : null;
        
        if ($rating >= 1 && $rating <= 5) {
            $ratingCounts[$rating]++;
            $totalReviews++;
            
            if ($rating >= 4) {
                echo ">>> Stopped at review #$totalReviews (4+ stars)\n";
                $stopped = true;
                break;
            }
        }
    }
    
    if ($stopped) {
        break;
    }
    
    $nextPageToken = $response['nextPage'] ?? null;
    
    // Limit pages for testing
    if ($pageCount >= 5) {
        echo ">>> Stopped at page limit\n";
        break;
    }
    
} while ($nextPageToken);

echo "\nResults:\n";
echo "========\n";
echo "Total reviews processed: $totalReviews\n";
echo "Rating distribution:\n";
foreach ($ratingCounts as $stars => $count) {
    if ($count > 0) {
        echo "  $stars stars: $count\n";
    }
}

if ($totalReviews > 0) {
    $avgRating = 0;
    foreach ($ratingCounts as $stars => $count) {
        $avgRating += $stars * $count;
    }
    $avgRating = round($avgRating / $totalReviews, 2);
    echo "Average rating: $avgRating\n";
}

echo "\nThis approach fetches only low-rated reviews (1-3 stars) efficiently!\n";