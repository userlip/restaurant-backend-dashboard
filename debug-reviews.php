<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Lead;
use App\Service\ReviewService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Debug Review Fetching\n";
echo "====================\n\n";

// Get API key
$apiKey = config('services.scrappa.api_key');
echo "API Key configured: " . ($apiKey ? 'Yes (length: ' . strlen($apiKey) . ')' : 'No') . "\n\n";

// Get a lead with google_business_id
$lead = Lead::whereNotNull('google_business_id')->first();

if (!$lead) {
    echo "No leads found with google_business_id\n";
    
    // Try to find a lead with a Google Maps link
    $lead = Lead::whereNotNull('link')
        ->where('link', 'like', '%google.com/maps%')
        ->first();
    
    if ($lead) {
        echo "Found lead with Google Maps link:\n";
        echo "ID: {$lead->id}\n";
        echo "Name: {$lead->name}\n";
        echo "Link: {$lead->link}\n\n";
        
        // Try to extract business ID
        $reviewService = new ReviewService();
        $reflection = new ReflectionClass($reviewService);
        $method = $reflection->getMethod('extractBusinessIdFromUrl');
        $method->setAccessible(true);
        
        $businessId = $method->invoke($reviewService, $lead->link);
        echo "Extracted Business ID: " . ($businessId ?: 'None') . "\n\n";
        
        if ($businessId) {
            $lead->update(['google_business_id' => $businessId]);
        }
    } else {
        echo "No leads found with Google Maps links\n";
        exit(1);
    }
}

if ($lead && $lead->google_business_id) {
    echo "Testing with lead:\n";
    echo "ID: {$lead->id}\n";
    echo "Name: {$lead->name}\n";
    echo "Business ID: {$lead->google_business_id}\n\n";
    
    // Make a direct API call
    echo "Making direct API call...\n";
    
    try {
        $response = Http::withHeaders([
            'x-rapidapi-key' => $apiKey,
        ])->get('https://app.scrappa.co/api/maps/reviews', [
            'business_id' => $lead->google_business_id,
            'sort' => 1,
            'page' => 1,
        ]);
        
        echo "Response Status: " . $response->status() . "\n";
        echo "Response Headers:\n";
        foreach ($response->headers() as $key => $values) {
            echo "  $key: " . implode(', ', $values) . "\n";
        }
        echo "\n";
        
        $data = $response->json();
        
        if ($response->successful()) {
            echo "Response successful!\n";
            echo "Response structure:\n";
            
            if (is_array($data)) {
                echo "  Keys: " . implode(', ', array_keys($data)) . "\n";
                
                if (isset($data['data'])) {
                    echo "  Number of reviews: " . count($data['data']) . "\n";
                    
                    if (!empty($data['data'])) {
                        echo "\nFirst review structure:\n";
                        $firstReview = $data['data'][0];
                        foreach ($firstReview as $key => $value) {
                            echo "    $key: " . (is_string($value) ? substr($value, 0, 50) : json_encode($value)) . "\n";
                        }
                        
                        // Check rating field names
                        echo "\nRating field check:\n";
                        echo "  rating: " . ($firstReview['rating'] ?? 'not found') . "\n";
                        echo "  star_rating: " . ($firstReview['star_rating'] ?? 'not found') . "\n";
                        echo "  stars: " . ($firstReview['stars'] ?? 'not found') . "\n";
                        echo "  score: " . ($firstReview['score'] ?? 'not found') . "\n";
                    }
                } else {
                    echo "  No 'data' key found in response\n";
                    echo "  Full response: " . json_encode($data, JSON_PRETTY_PRINT) . "\n";
                }
                
                echo "\nPagination info:\n";
                echo "  has_more: " . json_encode($data['has_more'] ?? 'not found') . "\n";
                echo "  page: " . ($data['page'] ?? 'not found') . "\n";
                echo "  total: " . ($data['total'] ?? 'not found') . "\n";
            } else {
                echo "Response is not an array\n";
            }
        } else {
            echo "Response failed!\n";
            echo "Error body: " . $response->body() . "\n";
        }
        
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage() . "\n";
        echo "Trace: " . $e->getTraceAsString() . "\n";
    }
}

echo "\n\nChecking logs for recent errors...\n";
$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $lines = explode("\n", shell_exec("tail -50 " . escapeshellarg($logFile)));
    $relevantLines = array_filter($lines, function($line) {
        return stripos($line, 'review') !== false || stripos($line, 'scrappa') !== false;
    });
    
    if (!empty($relevantLines)) {
        echo "Recent review-related log entries:\n";
        foreach (array_slice($relevantLines, -10) as $line) {
            echo "  " . $line . "\n";
        }
    }
}