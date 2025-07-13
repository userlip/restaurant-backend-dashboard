<?php

// Simple test of the rating counting logic

echo "Testing Rating Count Logic\n";
echo "==========================\n\n";

// Simulate the ReviewService logic
$reviewCounts = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
];

// Test data similar to what we saw in the API
$testReviews = [
    ['rating' => 1, 'author' => 'Person 1'],
    ['rating' => 3, 'author' => 'Person 2'],
    ['rating' => 3, 'author' => 'Person 3'],
    ['rating' => 3, 'author' => 'Person 4'],
    ['rating' => 3, 'author' => 'Person 5'],
    ['rating' => 2, 'author' => 'Person 6'],
];

echo "Processing test reviews:\n";
foreach ($testReviews as $idx => $review) {
    $rating = isset($review['rating']) ? (int)$review['rating'] : null;
    
    echo "Review " . ($idx + 1) . ": rating = $rating\n";
    
    if ($rating >= 1 && $rating <= 5) {
        $reviewCounts[$rating]++;
        echo "  -> Incremented count for $rating stars\n";
    }
}

echo "\nFinal counts:\n";
foreach ($reviewCounts as $stars => $count) {
    echo "  {$stars} stars: $count\n";
}

// Now test the database update mapping
echo "\n\nDatabase field mapping:\n";
echo "=======================\n";

$dbUpdate = [
    'one_star_count' => $reviewCounts[1],
    'two_star_count' => $reviewCounts[2],
    'three_star_count' => $reviewCounts[3],
    'four_star_count' => $reviewCounts[4],
    'five_star_count' => $reviewCounts[5],
];

foreach ($dbUpdate as $field => $value) {
    echo "$field => $value\n";
}

// Check if there's an issue with the array indexing
echo "\n\nChecking array key types:\n";
echo "=========================\n";

foreach ($reviewCounts as $key => $value) {
    echo "Key: $key (type: " . gettype($key) . "), Value: $value\n";
}

// Test what happens with string keys
echo "\n\nTesting with string keys:\n";
$testCounts = [];
$testCounts["1"] = 5;
$testCounts["2"] = 3;
$testCounts["3"] = 10;

echo "String key access:\n";
echo "testCounts[1] = " . ($testCounts[1] ?? 'undefined') . "\n";
echo "testCounts['1'] = " . ($testCounts['1'] ?? 'undefined') . "\n";