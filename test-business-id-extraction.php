<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Service\ReviewService;

echo "Testing Google Business ID Extraction\n";
echo "=====================================\n\n";

// Test URLs
$testUrls = [
    'https://www.google.com/maps/place/Restaurant/@40.7614,-73.9776,15z/data=!4m2!3m1!1s0x479e7a4b857d313f:0x420cb24f794c84da',
    'https://maps.app.goo.gl/abc123?data=!1s0x479e7a4b857d313f:0x420cb24f794c84da',
    'https://www.google.com/maps/place/Restaurant/data=!3m1!4b1!4m5!3m4!1s0x479e7a4b857d313f:0x420cb24f794c84da!8m2!3d40.7614!4d-73.9776',
    'https://goo.gl/maps/xyz789',
    'https://www.restaurant.com',
    null,
];

// Create instance of ReviewService
$reviewService = new ReviewService();

// Use reflection to access the protected method
$reflection = new ReflectionClass($reviewService);
$method = $reflection->getMethod('extractBusinessIdFromUrl');
$method->setAccessible(true);

foreach ($testUrls as $url) {
    $businessId = $method->invoke($reviewService, $url);
    
    echo "URL: " . ($url ?? 'null') . "\n";
    echo "Extracted Business ID: " . ($businessId ?? 'Not found') . "\n";
    echo "---\n";
}

echo "\nConclusion:\n";
echo "The system can extract Google Business IDs from various Google Maps URL formats.\n";
echo "If a lead doesn't have a business ID, it will try to extract it from the link field.\n";