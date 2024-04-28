<?php

namespace App\Jobs;

use App\Models\Lead;
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
        private string $query
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $curl = curl_init();

        $query = urlencode($this->query);

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://maps-data.p.rapidapi.com/searchmaps.php?query=" . $query . "&limit=500&country=de&lang=de&zoom=13",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: maps-data.p.rapidapi.com",
                "X-RapidAPI-Key: aff74e61b2msh5bbea73eadf04e4p1f2d78jsn83ceea7b1158"
            ],
        ]);

        $response = curl_exec($curl);

        $data = json_decode($response, true);

        foreach ($data['data'] as $restaurant) {
            // If Website is null or contains "facebook"
            if ($restaurant['website'] == null || strpos($restaurant['website'], 'facebook') !== false) {
                // Save it to the file
                $name = $restaurant['name'];
                $address = $restaurant['full_address'];
                $phone = $restaurant['phone_number'];
                $link = $restaurant['place_link'];

                if (! Lead::where('name', $name)->exists()) {
                    Lead::create([
                        'name' => $name,
                        'address' => $address,
                        'phone' => $phone,
                        'link' => $link
                    ]);
                }
            }
        }
    }
}
