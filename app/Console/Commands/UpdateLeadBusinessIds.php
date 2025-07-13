<?php

namespace App\Console\Commands;

use App\Models\Lead;
use App\Service\LeadService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateLeadBusinessIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leads:update-business-ids 
                            {--limit=50 : Number of leads to update per batch}
                            {--dry-run : Show what would be updated without saving}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing leads with business IDs from Scrappa API';

    /**
     * Execute the console command.
     */
    public function handle(LeadService $leadService)
    {
        $this->info('Updating lead business IDs from Scrappa API...');
        
        $dryRun = $this->option('dry-run');
        $limit = (int) $this->option('limit');
        
        // Get unique search terms
        $searchTerms = Lead::whereNull('google_business_id')
            ->whereNotNull('search_term')
            ->distinct()
            ->pluck('search_term');
        
        if ($searchTerms->isEmpty()) {
            $this->info('No search terms found for leads without business IDs.');
            return Command::SUCCESS;
        }
        
        $this->info("Found {$searchTerms->count()} unique search terms to process");
        
        $totalUpdated = 0;
        $totalFailed = 0;
        
        foreach ($searchTerms as $searchTerm) {
            $this->info("\nProcessing search term: {$searchTerm}");
            
            try {
                // Fetch data from API
                $data = $leadService->fetchLeads($searchTerm);
                
                if (!isset($data['items']) || empty($data['items'])) {
                    $this->warn("No items found for search term: {$searchTerm}");
                    continue;
                }
                
                // Create a map of place_id to business_id
                $businessIdMap = [];
                foreach ($data['items'] as $item) {
                    if (isset($item['place_id']) && isset($item['business_id'])) {
                        $businessIdMap[$item['place_id']] = $item['business_id'];
                    }
                }
                
                // Update leads that match
                $leads = Lead::whereNull('google_business_id')
                    ->where('search_term', $searchTerm)
                    ->whereNotNull('link')
                    ->limit($limit)
                    ->get();
                
                $batchUpdated = 0;
                $batchFailed = 0;
                
                foreach ($leads as $lead) {
                    // Try to match by place_id in the link
                    $placeId = null;
                    if (preg_match('/place_id:([^&\s]+)/', $lead->link, $matches)) {
                        $placeId = $matches[1];
                    }
                    
                    if ($placeId && isset($businessIdMap[$placeId])) {
                        if (!$dryRun) {
                            $lead->google_business_id = $businessIdMap[$placeId];
                            $lead->save();
                        }
                        $batchUpdated++;
                        $this->line("✓ Updated: {$lead->name} -> {$businessIdMap[$placeId]}");
                    } else {
                        // Try to match by name
                        $matched = false;
                        foreach ($data['items'] as $item) {
                            if (isset($item['name']) && isset($item['business_id'])) {
                                // Simple name matching (could be improved)
                                if (strcasecmp($item['name'], $lead->name) === 0 ||
                                    stripos($item['name'], $lead->name) !== false ||
                                    stripos($lead->name, $item['name']) !== false) {
                                    
                                    if (!$dryRun) {
                                        $lead->google_business_id = $item['business_id'];
                                        $lead->save();
                                    }
                                    $batchUpdated++;
                                    $this->line("✓ Updated by name match: {$lead->name} -> {$item['business_id']}");
                                    $matched = true;
                                    break;
                                }
                            }
                        }
                        
                        if (!$matched) {
                            $batchFailed++;
                            if ($this->output->isVerbose()) {
                                $this->line("✗ No match found: {$lead->name}");
                            }
                        }
                    }
                }
                
                $totalUpdated += $batchUpdated;
                $totalFailed += $batchFailed;
                
                $this->info("Batch complete: Updated {$batchUpdated}, Failed {$batchFailed}");
                
                // Rate limiting
                sleep(2);
                
            } catch (\Exception $e) {
                $this->error("Error processing search term '{$searchTerm}': " . $e->getMessage());
                Log::error("UpdateLeadBusinessIds error for term '{$searchTerm}'", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
        
        $this->newLine();
        $this->info("Update complete!");
        $this->info("Total updated: {$totalUpdated}");
        $this->info("Total failed: {$totalFailed}");
        
        if ($dryRun) {
            $this->warn('DRY RUN - No changes were saved');
        }
        
        return Command::SUCCESS;
    }
}