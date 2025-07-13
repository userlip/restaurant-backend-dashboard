<?php

require_once __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Lead;
use App\Service\ReviewService;

echo "Minimal Review Count Test\n";
echo "=========================\n\n";

// Create a mock lead object without database
$lead = new Lead();
$lead->id = 1;
$lead->name = 'Test Restaurant';
$lead->google_business_id = '0x47a84e21b8b0f545:0xf2637b649ae01e0';

// Don't save to DB, just set attributes
$lead->one_star_count = 999;
$lead->two_star_count = 999;
$lead->three_star_count = 999;
$lead->four_star_count = 999;
$lead->five_star_count = 999;

echo "Initial values:\n";
echo "1-star: {$lead->one_star_count}\n";
echo "2-star: {$lead->two_star_count}\n";
echo "3-star: {$lead->three_star_count}\n\n";

// Now test manual update
$updateData = [
    'one_star_count' => 1,
    'two_star_count' => 2,
    'three_star_count' => 3,
    'four_star_count' => 4,
    'five_star_count' => 5,
];

// Use fill instead of update to avoid DB
$lead->fill($updateData);

echo "After fill():\n";
echo "1-star: {$lead->one_star_count}\n";
echo "2-star: {$lead->two_star_count}\n";
echo "3-star: {$lead->three_star_count}\n\n";

// Check if there's an accessor issue
echo "Direct attribute access:\n";
echo "getAttribute('one_star_count'): " . $lead->getAttribute('one_star_count') . "\n";
echo "getAttribute('two_star_count'): " . $lead->getAttribute('two_star_count') . "\n";
echo "getAttribute('three_star_count'): " . $lead->getAttribute('three_star_count') . "\n\n";

// Test the ReviewService directly
$reviewService = new ReviewService();

// Override the update method to see what's being passed
class TestLead extends Lead {
    public $lastUpdateData = [];
    
    public function update(array $attributes = [], array $options = []) {
        $this->lastUpdateData = $attributes;
        $this->fill($attributes);
        return true;
    }
}

$testLead = new TestLead();
$testLead->id = 1;
$testLead->name = 'Test Restaurant';
$testLead->google_business_id = '0x47a84e21b8b0f545:0xf2637b649ae01e0';

echo "Running ReviewService with TestLead...\n";
$result = $reviewService->fetchAndUpdateReviews($testLead);

if ($result) {
    echo "\nUpdate data passed to model:\n";
    print_r($testLead->lastUpdateData);
    
    echo "\nFinal values on model:\n";
    echo "1-star: {$testLead->one_star_count}\n";
    echo "2-star: {$testLead->two_star_count}\n";
    echo "3-star: {$testLead->three_star_count}\n";
}