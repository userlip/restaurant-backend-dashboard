<?php

// Simple test to check Scrappa API response format

require_once __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$apiKey = config('services.scrappa.api_key');

if (!$apiKey) {
    echo "ERROR: SCRAPPA_API_KEY not configured in .env\n";
    exit(1);
}

// Test with the business ID you provided
$businessId = '0x479e7a4b857d313f:0x420cb24f794c84da';

echo "Testing Scrappa API\n";
echo "===================\n";
echo "API Key length: " . strlen($apiKey) . "\n";
echo "Business ID: $businessId\n\n";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://app.scrappa.co/api/maps/reviews?business_id=" . urlencode($businessId) . "&sort=1&page=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-rapidapi-key: $apiKey",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Status Code: $httpCode\n";

if ($error) {
    echo "cURL Error: $error\n";
    exit(1);
}

echo "\nRaw Response (first 500 chars):\n";
echo substr($response, 0, 500) . "...\n\n";

$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Parse Error: " . json_last_error_msg() . "\n";
    exit(1);
}

if ($data) {
    echo "Response structure:\n";
    echo "  Top-level keys: " . implode(', ', array_keys($data)) . "\n";
    
    if (isset($data['error'])) {
        echo "\nERROR from API:\n";
        echo json_encode($data['error'], JSON_PRETTY_PRINT) . "\n";
    }
    
    if (isset($data['data']) && is_array($data['data'])) {
        echo "\nFound " . count($data['data']) . " reviews\n";
        
        if (!empty($data['data'])) {
            echo "\nFirst review fields:\n";
            $first = $data['data'][0];
            foreach ($first as $key => $value) {
                $displayValue = is_string($value) ? '"' . substr($value, 0, 40) . '..."' : json_encode($value);
                echo "  $key: $displayValue\n";
            }
        }
    }
    
    // Check for pagination
    if (isset($data['has_more'])) {
        echo "\nPagination: has_more = " . json_encode($data['has_more']) . "\n";
    }
}

// Test rating extraction
if (isset($data['data'][0])) {
    $review = $data['data'][0];
    echo "\nRating field detection:\n";
    
    $possibleRatingFields = ['rating', 'star_rating', 'stars', 'score', 'user_rating'];
    foreach ($possibleRatingFields as $field) {
        if (isset($review[$field])) {
            echo "  Found '$field': " . $review[$field] . "\n";
        }
    }
}