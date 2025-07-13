<?php

require_once __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Lead;
use App\Service\ReviewService;

echo "FIXING REVIEW SYSTEM\n";
echo "====================\n\n";

// 1. First, let's see what URLs leads actually have
echo "1. Checking Lead URLs\n";
$sampleLeads = Lead::whereNotNull('link')
    ->whereIn('status', ['new', 'contacted'])
    ->limit(10)
    ->get(['id', 'name', 'link', 'google_business_id']);

$hasGoogleMaps = 0;
$hasBusinessId = 0;

foreach ($sampleLeads as $lead) {
    echo "\nLead {$lead->id}: {$lead->name}\n";
    echo "URL: " . substr($lead->link, 0, 80) . "...\n";
    echo "Has Business ID: " . ($lead->google_business_id ? 'YES' : 'NO') . "\n";
    
    if (strpos($lead->link, 'google.com/maps') !== false || strpos($lead->link, 'maps.app.goo.gl') !== false || strpos($lead->link, 'g.page') !== false) {
        $hasGoogleMaps++;
    }
    
    if ($lead->google_business_id) {
        $hasBusinessId++;
    }
}

echo "\nSummary:\n";
echo "Total active leads with links: " . Lead::whereNotNull('link')->whereIn('status', ['new', 'contacted'])->count() . "\n";
echo "Sample with Google Maps URLs: $hasGoogleMaps/10\n";
echo "Sample with Business IDs: $hasBusinessId/10\n";

// 2. Test extraction on actual lead URLs
echo "\n\n2. Testing Business ID Extraction\n";
$reviewService = new ReviewService();
$reflection = new ReflectionClass($reviewService);
$extractMethod = $reflection->getMethod('extractBusinessIdFromUrl');
$extractMethod->setAccessible(true);

$testLead = Lead::whereNotNull('link')
    ->where('link', 'like', '%google.com/maps%')
    ->first();

if ($testLead) {
    echo "\nTesting with real lead URL:\n";
    echo "Lead: {$testLead->name}\n";
    echo "URL: {$testLead->link}\n";
    
    $extractedId = $extractMethod->invoke($reviewService, $testLead->link);
    echo "Extracted ID: " . ($extractedId ?: 'NONE') . "\n";
    
    if (!$extractedId) {
        // Show the URL structure
        echo "\nURL Analysis:\n";
        $parsed = parse_url($testLead->link);
        echo "Host: " . ($parsed['host'] ?? 'none') . "\n";
        echo "Path: " . ($parsed['path'] ?? 'none') . "\n";
        echo "Query: " . ($parsed['query'] ?? 'none') . "\n";
        echo "Fragment: " . ($parsed['fragment'] ?? 'none') . "\n";
        
        // Look for patterns
        if (preg_match_all('/0x[a-f0-9]+/i', $testLead->link, $hexMatches)) {
            echo "\nFound hex patterns: " . implode(', ', $hexMatches[0]) . "\n";
        }
    }
}

// 3. Create a command to extract and save business IDs
echo "\n\n3. Extracting Business IDs for all leads\n";

$leads = Lead::whereNotNull('link')
    ->whereNull('google_business_id')
    ->where(function($q) {
        $q->where('link', 'like', '%google.com/maps%')
          ->orWhere('link', 'like', '%maps.app.goo.gl%')
          ->orWhere('link', 'like', '%g.page%')
          ->orWhere('link', 'like', '%maps.google%');
    })
    ->get();

echo "Found {$leads->count()} leads with Google Maps URLs but no business ID\n";

$extracted = 0;
$failed = [];

foreach ($leads as $lead) {
    $businessId = $extractMethod->invoke($reviewService, $lead->link);
    if ($businessId) {
        $lead->google_business_id = $businessId;
        $lead->save();
        $extracted++;
        echo ".";
    } else {
        $failed[] = $lead;
        echo "F";
    }
    
    if (($extracted + count($failed)) % 50 == 0) {
        echo " " . ($extracted + count($failed)) . "\n";
    }
}

echo "\n\nExtraction complete!\n";
echo "Successfully extracted: $extracted\n";
echo "Failed: " . count($failed) . "\n";

if (count($failed) > 0 && count($failed) <= 5) {
    echo "\nFailed URLs:\n";
    foreach ($failed as $lead) {
        echo "- {$lead->name}: {$lead->link}\n";
    }
}

// 4. Now test the review fetching
if ($extracted > 0 || Lead::whereNotNull('google_business_id')->exists()) {
    echo "\n\n4. Testing Review Fetching\n";
    
    $testLead = Lead::whereNotNull('google_business_id')->first();
    if ($testLead) {
        echo "Testing with lead: {$testLead->name}\n";
        echo "Business ID: {$testLead->google_business_id}\n";
        
        $result = $reviewService->fetchAndUpdateReviews($testLead);
        
        if ($result) {
            $testLead->refresh();
            echo "\nSuccess! Reviews updated:\n";
            echo "1-star: {$testLead->one_star_count}\n";
            echo "2-star: {$testLead->two_star_count}\n";
            echo "3-star: {$testLead->three_star_count}\n";
            echo "4-star: {$testLead->four_star_count}\n";
            echo "5-star: {$testLead->five_star_count}\n";
            echo "Total: {$testLead->total_reviews}\n";
            echo "Average: " . ($testLead->average_rating ?? 'N/A') . "\n";
        } else {
            echo "\nFailed to fetch reviews\n";
        }
    }
}

echo "\n\nDONE! Now run: php artisan leads:update-reviews\n";