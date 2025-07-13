<?php

namespace App\Console\Commands;

use App\Models\Lead;
use App\Service\ReviewService;
use Illuminate\Console\Command;

class ExtractBusinessIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leads:extract-business-ids 
                            {--dry-run : Show what would be extracted without saving}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract Google Business IDs from lead URLs';

    /**
     * Execute the console command.
     */
    public function handle(ReviewService $reviewService)
    {
        $this->info('Extracting Google Business IDs from lead URLs...');
        
        $dryRun = $this->option('dry-run');
        
        // Get leads with Google Maps URLs but no business ID
        $leads = Lead::whereNotNull('link')
            ->whereNull('google_business_id')
            ->where(function($q) {
                $q->where('link', 'like', '%google.com/maps%')
                  ->orWhere('link', 'like', '%maps.app.goo.gl%')
                  ->orWhere('link', 'like', '%g.page%')
                  ->orWhere('link', 'like', '%maps.google%')
                  ->orWhere('link', 'like', '%goo.gl/maps%');
            })
            ->get();
        
        $this->info("Found {$leads->count()} leads with Google Maps URLs but no business ID");
        
        if ($leads->count() === 0) {
            $this->info('No leads to process.');
            return Command::SUCCESS;
        }
        
        $progressBar = $this->output->createProgressBar($leads->count());
        $progressBar->start();
        
        $extracted = 0;
        $failed = [];
        
        // Use reflection to access the protected method
        $reflection = new \ReflectionClass($reviewService);
        $extractMethod = $reflection->getMethod('extractBusinessIdFromUrl');
        $extractMethod->setAccessible(true);
        
        foreach ($leads as $lead) {
            $businessId = $extractMethod->invoke($reviewService, $lead->link);
            
            if ($businessId) {
                if (!$dryRun) {
                    $lead->google_business_id = $businessId;
                    $lead->save();
                }
                $extracted++;
            } else {
                $failed[] = [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'url' => $lead->link
                ];
            }
            
            $progressBar->advance();
        }
        
        $progressBar->finish();
        $this->newLine(2);
        
        $this->info("Extraction complete!");
        $this->info("Successfully extracted: $extracted");
        $this->info("Failed: " . count($failed));
        
        if ($dryRun) {
            $this->warn('DRY RUN - No changes were saved');
        }
        
        if (count($failed) > 0) {
            $this->newLine();
            $this->warn('Failed to extract business IDs from:');
            
            $showCount = min(10, count($failed));
            for ($i = 0; $i < $showCount; $i++) {
                $this->line("- [{$failed[$i]['id']}] {$failed[$i]['name']}");
                $this->line("  URL: " . substr($failed[$i]['url'], 0, 100) . "...");
            }
            
            if (count($failed) > 10) {
                $this->line("... and " . (count($failed) - 10) . " more");
            }
        }
        
        return Command::SUCCESS;
    }
}