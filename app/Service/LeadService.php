<?php

namespace App\Service;

use App\Enums\LeadStatusEnums;
use App\Models\Customer;
use App\Models\Lead;

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
}
