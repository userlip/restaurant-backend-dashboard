<?php

// Test script to check Scrappa API pagination for reviews

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Http;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['SCRAPPA_API_KEY'] ?? null;

if (!$apiKey) {
    echo "ERROR: SCRAPPA_API_KEY not found in .env file\n";
    exit(1);
}

// Test business ID (you can change this to test different businesses)
$businessId = '0x479e7a4b857d313f:0x420cb24f794c84da';
$baseUrl = 'https://app.scrappa.co/api/maps/reviews';

echo "Testing Scrappa Reviews API Pagination\n";
echo "=====================================\n";
echo "Business ID: $businessId\n\n";

$totalReviews = 0;
$page = 1;
$hasMore = true;
$reviewsByRating = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

while ($hasMore && $page <= 5) { // Limit to 5 pages for testing
    echo "Fetching page $page...\n";
    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $baseUrl . "?business_id=" . urlencode($businessId) . "&sort=1&page=$page",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-key: $apiKey"
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err . "\n";
        break;
    }
    
    echo "HTTP Response Code: $httpCode\n";
    
    $data = json_decode($response, true);
    
    if (!$data) {
        echo "Failed to parse JSON response\n";
        echo "Raw response: " . substr($response, 0, 200) . "...\n";
        break;
    }
    
    // Check response structure
    if (isset($data['data']) && is_array($data['data'])) {
        $pageReviews = count($data['data']);
        $totalReviews += $pageReviews;
        
        echo "Reviews on this page: $pageReviews\n";
        
        // Count reviews by rating
        foreach ($data['data'] as $review) {
            $rating = (int)($review['rating'] ?? 0);
            if ($rating >= 1 && $rating <= 5) {
                $reviewsByRating[$rating]++;
            }
        }
        
        // Check if there are more pages
        $hasMore = $data['has_more'] ?? false;
        echo "Has more pages: " . ($hasMore ? 'Yes' : 'No') . "\n";
        
        // Show pagination info if available
        if (isset($data['pagination'])) {
            echo "Pagination info: " . json_encode($data['pagination']) . "\n";
        }
        
    } else {
        echo "Unexpected response structure\n";
        echo "Response keys: " . implode(', ', array_keys($data)) . "\n";
        $hasMore = false;
    }
    
    echo "\n";
    $page++;
    
    // Small delay to avoid rate limiting
    sleep(1);
}

echo "=====================================\n";
echo "Summary:\n";
echo "Total reviews fetched: $totalReviews\n";
echo "Reviews by rating:\n";
foreach ($reviewsByRating as $rating => $count) {
    echo "  $rating stars: $count\n";
}

$totalRating = 0;
foreach ($reviewsByRating as $rating => $count) {
    $totalRating += $rating * $count;
}
$avgRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 2) : 0;
echo "Average rating: $avgRating\n";