<?php

require_once __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Lead;
use App\Service\ReviewService;

echo "Checking Lead Data\n";
echo "==================\n\n";

// Get some sample leads
$leads = Lead::whereIn('status', ['new', 'contacted'])
    ->whereNotNull('link')
    ->limit(5)
    ->get();

echo "Found " . Lead::count() . " total leads\n";
echo "Active leads with links: " . Lead::whereIn('status', ['new', 'contacted'])->whereNotNull('link')->count() . "\n\n";

echo "Sample leads:\n";
foreach ($leads as $lead) {
    echo "\nLead ID: {$lead->id}\n";
    echo "Name: {$lead->name}\n";
    echo "Link: " . substr($lead->link, 0, 100) . "...\n";
    echo "Google Business ID: " . ($lead->google_business_id ?: 'NULL') . "\n";
    
    // Try to extract business ID
    $reviewService = new ReviewService();
    $reflection = new ReflectionClass($reviewService);
    $method = $reflection->getMethod('extractBusinessIdFromUrl');
    $method->setAccessible(true);
    
    $extractedId = $method->invoke($reviewService, $lead->link);
    echo "Extracted Business ID: " . ($extractedId ?: 'NONE') . "\n";
    
    if ($extractedId && !$lead->google_business_id) {
        echo ">>> This lead needs google_business_id updated!\n";
    }
}

// Check lead structure
echo "\n\nLead Table Columns:\n";
$lead = Lead::first();
if ($lead) {
    $attributes = $lead->getAttributes();
    foreach (array_keys($attributes) as $column) {
        echo "- $column\n";
    }
}

// Test with a specific Google Maps URL
echo "\n\nTesting URL extraction patterns:\n";
$testUrls = [
    'https://www.google.com/maps/place/Restaurant/@40.7614,-73.9776,15z/data=!4m2!3m1!1s0x479e7a4b857d313f:0x420cb24f794c84da',
    'https://maps.app.goo.gl/abc123',
    'https://g.page/restaurant-name?share',
    'https://www.google.com/maps/place/Restaurant/data=!3m1!4b1!4m5!3m4!1s0x479e7a4b857d313f:0x420cb24f794c84da!8m2!3d40.7614!4d-73.9776',
];

foreach ($testUrls as $url) {
    $extractedId = $method->invoke($reviewService, $url);
    echo "\nURL: " . substr($url, 0, 80) . "...\n";
    echo "Extracted: " . ($extractedId ?: 'NONE') . "\n";
}