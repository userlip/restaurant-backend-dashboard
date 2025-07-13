<?php

namespace App\Jobs;

use App\Enums\LeadStatusEnums;
use App\Models\Lead;
use App\Models\User;
use App\Service\LeadService;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchPotentialLeadsFromAPIUsingQuery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $query,
        private User $user,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = app(LeadService::class);
        $data = $service->fetchLeads($this->query);


        foreach ($data['items'] as $restaurant) {
            // If Website is null or contains "facebook"
            if ($restaurant['website'] == null || strpos($restaurant['website'], 'facebook') !== false) {
                // Save it to the file
                $name = $restaurant['name'];
                $address = $restaurant['full_address'];
                $phone = isset($restaurant['phone_numbers'][0]) ? $restaurant['phone_numbers'][0] : null;
                $link = 'https://www.google.com/maps/place/?q=place_id:' . $restaurant['place_id'];

                if (! Lead::where('name', $name)->exists()) {
                    Lead::create([
                        'name' => $name,
                        'address' => $address,
                        'phone' => $phone,
                        'link' => $link,
                        'google_business_id' => $restaurant['business_id'] ?? null,
                        'search_term' => $this->query,
                        'status' => LeadStatusEnums::NEW,
                    ]);
                }
            }
        }

        Notification::make()
            ->title('Successfully fetched and saved new leads')
            ->body("Successfully fetched and saved new leads with the search term of: '{$this->query}'")
            ->actions([
                Action::make('Go to Leads')
                    ->url(route('filament.admin.resources.leads.index'))
            ])
            ->success()
            ->sendToDatabase($this->user);
    }
}
