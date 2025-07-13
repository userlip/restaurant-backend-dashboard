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
                'status' => LeadStatusEnums::WON,
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
        $apiKey = env('SCRAPPA_API_KEY');
        $url = "https://app.scrappa.co/api/maps/advance-search?zoom=13&query=" . $query;

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-api-key: " . $apiKey
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($err) {
            \Log::error('Scrappa API cURL Error', [
                'error' => $err,
                'query' => $searchTerm
            ]);
            throw new \Exception("cURL Error #:" . $err);
        }

        // Log raw response for debugging
        \Log::info('Scrappa API Raw Response', [
            'query' => $searchTerm,
            'http_code' => $httpCode,
            'response_length' => strlen($response),
            'response_preview' => substr($response, 0, 500)
        ]);

        $data = json_decode($response, true);

        if ($data === null) {
            \Log::error('Scrappa API JSON Decode Error', [
                'query' => $searchTerm,
                'response' => $response,
                'json_error' => json_last_error_msg()
            ]);
            throw new \Exception("Failed to decode API response: " . json_last_error_msg());
        }

        // Check for error responses
        if ($httpCode !== 200) {
            \Log::error('Scrappa API Error Response', [
                'query' => $searchTerm,
                'http_code' => $httpCode,
                'response' => $data
            ]);
            
            $errorMessage = isset($data['message']) ? $data['message'] : 'Unknown API error';
            throw new \Exception("Scrappa API Error (HTTP $httpCode): $errorMessage");
        }

        // Validate response structure
        if (!isset($data['items'])) {
            \Log::error('Scrappa API Invalid Response Structure', [
                'query' => $searchTerm,
                'response_keys' => array_keys($data),
                'response' => $data
            ]);
            throw new \Exception("Invalid Scrappa API response structure - missing 'items' key");
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
