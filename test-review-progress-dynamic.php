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
    
    public function write($message) {
        echo $message;
    }
}

// Simulate the improved review counting output with dynamic updates
$output = new MockOutput();

echo "\n==== DYNAMIC REVIEW COUNTING PROGRESS ====\n\n";

// Simulate lead processing
$leadId = 123;
$leadName = "Joe's Pizza Restaurant";

$output->info("Lead $leadId ($leadName): Processing reviews...");

// Simulate multiple pages of reviews with delays
$pages = [
    ['count' => 20, 'ratings' => [1 => 1, 2 => 2, 3 => 3, 4 => 6, 5 => 8]],
    ['count' => 20, 'ratings' => [1 => 0, 2 => 1, 3 => 4, 4 => 7, 5 => 8]],
    ['count' => 15, 'ratings' => [1 => 1, 2 => 0, 3 => 2, 4 => 5, 5 => 7]],
    ['count' => 10, 'ratings' => [1 => 0, 2 => 1, 3 => 1, 4 => 3, 5 => 5]],
    ['count' => 18, 'ratings' => [1 => 2, 2 => 1, 3 => 3, 4 => 5, 5 => 7]],
    ['count' => 12, 'ratings' => [1 => 0, 2 => 0, 3 => 2, 4 => 4, 5 => 6]],
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
    
    // Show cumulative counts on a single updating line
    $cumulativeCountsStr = implode(', ', array_map(
        fn($stars) => "{$stars}★: {$totalCounts[$stars]}",
        [1, 2, 3, 4, 5]
    ));
    
    // Clear line and update
    $output->write("\033[2K\r");
    $output->write("  \033[0;32m[INFO]\033[0m Page " . ($pageNum + 1) . ": Processing... Total: $totalReviews reviews ($cumulativeCountsStr)");
    
    // Simulate processing time
    usleep(500000); // 0.5 seconds
}

// Calculate average
$totalRating = 0;
foreach ($totalCounts as $stars => $count) {
    $totalRating += $stars * $count;
}
$averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 2) : null;

// Clear the updating line and move to a new line
$output->write("\033[2K\r");
$output->writeln('');

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

echo "\n==== BENEFITS OF DYNAMIC UPDATE ====\n";
echo "1. Single updating line instead of multiple lines\n";
echo "2. Cleaner output, especially with many pages\n";
echo "3. Real-time progress without cluttering the console\n";
echo "4. Still shows all important information\n";
echo "5. Final summary remains detailed and clear\n";