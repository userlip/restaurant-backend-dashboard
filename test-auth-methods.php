<?php

// Test different authentication methods for Scrappa API

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

$businessId = '0x479e7a4b857d313f:0x420cb24f794c84da';
$url = "https://app.scrappa.co/api/maps/reviews?business_id=" . urlencode($businessId) . "&sort=1&page=1";

echo "Testing Scrappa API Authentication Methods\n";
echo "=========================================\n";
echo "API Key length: " . strlen($apiKey) . "\n";
echo "First 10 chars: " . substr($apiKey, 0, 10) . "...\n";
echo "Business ID: $businessId\n\n";

// Test 1: x-rapidapi-key header (current method)
echo "Test 1: x-rapidapi-key header\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-rapidapi-key: $apiKey"
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "  Status: $httpCode\n";
echo "  Response: " . substr($response, 0, 100) . "\n\n";

// Test 2: Authorization Bearer header
echo "Test 2: Authorization Bearer header\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $apiKey"
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "  Status: $httpCode\n";
echo "  Response: " . substr($response, 0, 100) . "\n\n";

// Test 3: X-API-Key header
echo "Test 3: X-API-Key header\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-API-Key: $apiKey"
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "  Status: $httpCode\n";
echo "  Response: " . substr($response, 0, 100) . "\n\n";

// Test 4: api_key query parameter
echo "Test 4: api_key query parameter\n";
$urlWithKey = $url . "&api_key=" . urlencode($apiKey);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlWithKey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "  Status: $httpCode\n";
echo "  Response: " . substr($response, 0, 100) . "\n\n";

// Test 5: Check if it's a RapidAPI endpoint
echo "Test 5: RapidAPI host header\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-rapidapi-key: $apiKey",
    "x-rapidapi-host: app.scrappa.co"
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "  Status: $httpCode\n";
echo "  Response: " . substr($response, 0, 100) . "\n\n";

// If any test was successful, parse and show the data
foreach ([1, 2, 3, 4, 5] as $testNum) {
    if ($httpCode == 200) {
        echo "\nTest $testNum was successful! Parsing response...\n";
        $data = json_decode($response, true);
        if (isset($data['data'])) {
            echo "Found " . count($data['data']) . " reviews\n";
            if (!empty($data['data'])) {
                echo "First review rating field: " . ($data['data'][0]['rating'] ?? 'not found') . "\n";
            }
        }
        break;
    }
}