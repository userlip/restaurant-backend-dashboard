<?php

namespace App\Console\Commands;

use App\Service\ReviewService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateLeadReviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leads:update-reviews 
                            {--lead= : Update reviews for a specific lead ID}
                            {--force : Force update even if recently updated}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update Google reviews for all active leads';

    /**
     * Execute the console command.
     */
    public function handle(ReviewService $reviewService)
    {
        $this->info('Starting lead reviews update...');
        
        try {
            $leadId = $this->option('lead');
            
            if ($leadId) {
                // Update specific lead
                $lead = \App\Models\Lead::find($leadId);
                
                if (!$lead) {
                    $this->error("Lead with ID {$leadId} not found.");
                    return Command::FAILURE;
                }
                
                $this->info("Updating reviews for lead: {$lead->name}");
                
                if ($reviewService->fetchAndUpdateReviews($lead, $this->output)) {
                    $this->info("Successfully updated reviews for {$lead->name}");
                    $this->table(
                        ['Rating', 'Count'],
                        [
                            ['1 Star', $lead->fresh()->one_star_count],
                            ['2 Stars', $lead->fresh()->two_star_count],
                            ['3 Stars', $lead->fresh()->three_star_count],
                            ['4 Stars', $lead->fresh()->four_star_count],
                            ['5 Stars', $lead->fresh()->five_star_count],
                            ['Total', $lead->fresh()->total_reviews],
                            ['Average', $lead->fresh()->average_rating ?? 'N/A'],
                        ]
                    );
                } else {
                    $this->error("Failed to update reviews for {$lead->name}");
                }
            } else {
                // Update all active leads
                $force = $this->option('force');
                
                if (!$force) {
                    // Get leads that haven't been updated in the last 24 hours
                    $leads = \App\Models\Lead::whereIn('status', ['new', 'contacted'])
                        ->whereNotNull('link')
                        ->where(function($query) {
                            $query->whereNull('reviews_last_updated_at')
                                ->orWhere('reviews_last_updated_at', '<', now()->subDay());
                        })
                        ->get();
                } else {
                    $leads = \App\Models\Lead::whereIn('status', ['new', 'contacted'])
                        ->whereNotNull('link')
                        ->get();
                }
                
                $this->info("Found {$leads->count()} leads to update");
                
                $progressBar = $this->output->createProgressBar($leads->count());
                $progressBar->start();
                
                $successCount = 0;
                $failCount = 0;
                
                foreach ($leads as $lead) {
                    if ($reviewService->fetchAndUpdateReviews($lead, $this->output)) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                    
                    $progressBar->advance();
                }
                
                $progressBar->finish();
                $this->newLine();
                
                $this->info("Review update completed!");
                $this->info("Success: {$successCount}");
                $this->info("Failed: {$failCount}");
            }
            
            Log::info('Lead reviews update command completed successfully');
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('Error updating lead reviews: ' . $e->getMessage());
            Log::error('Lead reviews update command failed: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
