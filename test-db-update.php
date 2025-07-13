<?php

require_once __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Testing Database Update\n";
echo "=======================\n\n";

// Test data
$testData = [
    'one_star_count' => 5,
    'two_star_count' => 3,
    'three_star_count' => 10,
    'four_star_count' => 2,
    'five_star_count' => 1,
    'total_reviews' => 21,
    'average_rating' => 2.5,
    'reviews_last_updated_at' => now(),
];

echo "Test data to update:\n";
print_r($testData);

try {
    // Try a raw query to see if it's a model issue
    $result = DB::table('leads')
        ->where('id', 1)
        ->update($testData);
    
    echo "\nRaw DB update result: " . ($result ? 'SUCCESS' : 'FAILED') . "\n";
    
    // Now check what was actually saved
    $lead = DB::table('leads')
        ->where('id', 1)
        ->select('one_star_count', 'two_star_count', 'three_star_count', 'four_star_count', 'five_star_count', 'total_reviews')
        ->first();
    
    if ($lead) {
        echo "\nData in database after update:\n";
        echo "1-star: {$lead->one_star_count}\n";
        echo "2-star: {$lead->two_star_count}\n";
        echo "3-star: {$lead->three_star_count}\n";
        echo "4-star: {$lead->four_star_count}\n";
        echo "5-star: {$lead->five_star_count}\n";
        echo "Total: {$lead->total_reviews}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}