<?php

// Mock console output class
class MockOutput {
    public function info($message) {
        echo "\033[0;32m[INFO]\033[0m $message\n";
    }
    
    public function warning($message) {
        echo "\033[0;33m[WARNING]\033[0m $message\n";
    }
    
    public function error($message) {
        echo "\033[0;31m[ERROR]\033[0m $message\n";
    }
    
    public function success($message) {
        echo "\033[0;32m[SUCCESS]\033[0m $message\n";
    }
    
    public function line($message = '') {
        echo "$message\n";
    }
    
    public function writeln($message) {
        echo "$message\n";
    }
}

// Simulate the improved review counting output
$output = new MockOutput();

echo "\n==== IMPROVED REVIEW COUNTING PROGRESS ====\n\n";

// Simulate lead processing
$leadId = 123;
$leadName = "Joe's Pizza Restaurant";

$output->info("Lead $leadId ($leadName): Processing reviews...");

// Simulate multiple pages of reviews
$pages = [
    ['count' => 20, 'ratings' => [1 => 1, 2 => 2, 3 => 3, 4 => 6, 5 => 8]],
    ['count' => 20, 'ratings' => [1 => 0, 2 => 1, 3 => 4, 4 => 7, 5 => 8]],
    ['count' => 15, 'ratings' => [1 => 1, 2 => 0, 3 => 2, 4 => 5, 5 => 7]],
    ['count' => 10, 'ratings' => [1 => 0, 2 => 1, 3 => 1, 4 => 3, 5 => 5]],
];

$totalReviews = 0;
$totalCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

foreach ($pages as $pageNum => $page) {
    $pageReviews = $page['count'];
    $pageRatings = $page['ratings'];
    
    // Update totals
    foreach ($pageRatings as $stars => $count) {
        $totalCounts[$stars] += $count;
    }
    $totalReviews += $pageReviews;
    
    // Show page progress
    $pageCountsStr = implode(', ', array_map(
        fn($stars) => "{$stars}★: {$pageRatings[$stars]}",
        [1, 2, 3, 4, 5]
    ));
    
    $output->info("  Page " . ($pageNum + 1) . ": Found $pageReviews reviews ($pageCountsStr)");
    $output->info("  Running total: $totalReviews reviews");
}

// Calculate average
$totalRating = 0;
foreach ($totalCounts as $stars => $count) {
    $totalRating += $stars * $count;
}
$averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 2) : null;

// Final summary
$output->success("Lead $leadId ($leadName): Update complete!");
$finalCountsStr = implode(', ', array_map(
    fn($stars) => "{$stars}★: {$totalCounts[$stars]}",
    [1, 2, 3, 4, 5]
));
$output->info("  Final counts: $finalCountsStr");
$output->info("  Total reviews: $totalReviews");
$output->info("  Average rating: " . ($averageRating ?? 'N/A'));
$output->info("  Pages processed: " . count($pages));
$output->line();

echo "\n==== FEATURES DEMONSTRATED ====\n";
echo "1. Per-page breakdown showing reviews found and their star ratings\n";
echo "2. Running total after each page\n";
echo "3. Final summary with complete breakdown\n";
echo "4. Clear visual feedback with color-coded messages\n";
echo "5. Better tracking of review counting accuracy\n";