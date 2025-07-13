<?php

namespace App\Service;

use App\Enums\LeadStatusEnums;
use App\Models\Customer;
use App\Models\Lead;
use Illuminate\Support\Facades\Cache;

class LeadService
{

    /**
     * Converts the Lead into a customer by creating a new Customer record
     * Then associating the customer record to the lead
     *
     * @param Lead $lead
     * @param array $formData
     * @return bool|mixed
     */
    public function convertToCustomer(Lead $lead, array $formData): mixed
    {
        return \DB::transaction(function () use ($lead, $formData) {
            $customer = Customer::create($formData);

            $isLeadUpdateSuccess = $lead->update([
                'customer_id' => $customer->id,
                'status' => LeadStatusEnums::PROCESSED,
            ]);

            return $isLeadUpdateSuccess && $customer !== null;
        });
    }

    /**
     * Fetches the leads using the API and makes a database notification for the sales operator to get notified at
     *
     * @return mixed
     */
    public function fetchLeads(string $searchTerm): mixed
    {
        $curl = curl_init();

        $query = urlencode($searchTerm);

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://app.scrappa.co/api/maps/advance-search?zoom=13&query=" . $query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-api-key: " . env('SCRAPPA_API_KEY')
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("cURL Error #:" . $err);
        }

        $data = json_decode($response, true);

        if ($data === null) {
            throw new \Exception("Failed to decode API response");
        }

        return $data;
    }

    /**
     * Returns the search terms used in the Leads table
     *
     * @return array
     */
    public function getLeadSearchTerms(bool $isKeyValueArray = false): array
    {
        $query = Lead::select('search_term')
            ->whereNotNull('search_term')
            ->distinct();

        return $isKeyValueArray
            ? $query->pluck('search_term', 'search_term')->toArray()
            : $query->pluck('search_term')->toArray();
    }

    /**
     * Checks if the search term exists in the Leads table
     *
     * @param string $query
     * @return bool
     */
    public function checkSearchTermExists(?string $searchTerm): bool
    {
        return !empty($searchTerm) && Lead::where('search_term', $searchTerm)->exists();
    }
}
