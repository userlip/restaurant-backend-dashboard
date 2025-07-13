<?php

namespace App\Console\Commands;

use App\Models\Lead;
use App\Service\ReviewService;
use Illuminate\Console\Command;

class DiagnoseReviewCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leads:diagnose-reviews 
                            {lead : The lead ID to diagnose}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnose review count issues for a specific lead';

    /**
     * Execute the console command.
     */
    public function handle(ReviewService $reviewService)
    {
        $leadId = $this->argument('lead');
        $lead = Lead::find($leadId);
        
        if (!$lead) {
            $this->error("Lead with ID {$leadId} not found.");
            return Command::FAILURE;
        }
        
        $this->info("Diagnosing lead: {$lead->name}");
        $this->info("Business ID: " . ($lead->google_business_id ?: 'MISSING'));
        
        if (!$lead->google_business_id) {
            // Try to extract from URL
            $reflection = new \ReflectionClass($reviewService);
            $extractMethod = $reflection->getMethod('extractBusinessIdFromUrl');
            $extractMethod->setAccessible(true);
            
            $extractedId = $extractMethod->invoke($reviewService, $lead->link);
            if ($extractedId) {
                $this->info("Extracted Business ID from URL: {$extractedId}");
                $lead->google_business_id = $extractedId;
                $lead->save();
            } else {
                $this->error("Could not extract Business ID from URL: {$lead->link}");
                return Command::FAILURE;
            }
        }
        
        $this->newLine();
        $this->info("Current review counts:");
        $this->table(
            ['Star Rating', 'Count'],
            [
                ['1 Star', $lead->one_star_count],
                ['2 Stars', $lead->two_star_count],
                ['3 Stars', $lead->three_star_count],
                ['4 Stars', $lead->four_star_count],
                ['5 Stars', $lead->five_star_count],
                ['Total', $lead->total_reviews],
                ['Average', $lead->average_rating ?? 'N/A'],
            ]
        );
        
        $this->newLine();
        $this->info("Fetching first page of reviews to diagnose...");
        
        // Fetch first page manually
        $fetchMethod = $reflection->getMethod('fetchReviewsPage');
        $fetchMethod->setAccessible(true);
        
        $response = $fetchMethod->invoke($reviewService, $lead->google_business_id, null);
        
        if (!$response) {
            $this->error("Failed to fetch reviews from API");
            return Command::FAILURE;
        }
        
        $reviews = $response['items'] ?? [];
        $this->info("Got " . count($reviews) . " reviews from API");
        
        if (count($reviews) > 0) {
            $this->newLine();
            $this->info("First 5 reviews:");
            
            $headers = ['#', 'Author', 'Rating', 'Text Preview'];
            $rows = [];
            
            foreach (array_slice($reviews, 0, 5) as $idx => $review) {
                $rows[] = [
                    $idx + 1,
                    substr($review['author_name'] ?? 'Unknown', 0, 20),
                    $review['rating'] ?? 'N/A',
                    substr($review['review_text'][0] ?? 'No text', 0, 40) . '...'
                ];
            }
            
            $this->table($headers, $rows);
            
            // Count ratings
            $counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
            foreach ($reviews as $review) {
                $rating = isset($review['rating']) ? (int)$review['rating'] : null;
                if ($rating >= 1 && $rating <= 5) {
                    $counts[$rating]++;
                }
            }
            
            $this->newLine();
            $this->info("Rating distribution on first page:");
            foreach ($counts as $stars => $count) {
                if ($count > 0) {
                    $this->line("  {$stars} stars: {$count}");
                }
            }
        }
        
        $this->newLine();
        $this->info("Running full update...");
        
        $result = $reviewService->fetchAndUpdateReviews($lead);
        
        if ($result) {
            $lead->refresh();
            
            $this->newLine();
            $this->info("Updated review counts:");
            $this->table(
                ['Star Rating', 'Count'],
                [
                    ['1 Star', $lead->one_star_count],
                    ['2 Stars', $lead->two_star_count],
                    ['3 Stars', $lead->three_star_count],
                    ['4 Stars', $lead->four_star_count],
                    ['5 Stars', $lead->five_star_count],
                    ['Total', $lead->total_reviews],
                    ['Average', $lead->average_rating ?? 'N/A'],
                ]
            );
        } else {
            $this->error("Update failed");
        }
        
        return Command::SUCCESS;
    }
}