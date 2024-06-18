<?php

namespace App\Utils;

use App\Filament\Auth\Login;
use App\Models\Customer;
use App\Models\User;
use App\Models\Website;
use Cassandra\Custom;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Namecheap\Domain\Domains;

class Namecheap
{
    private const URL = 'https://api.sandbox.namecheap.com/xml.response';

//    public static function buyDomain(string $domain, Customer $customer)
    public static function buyDomain()
    {
        // Dummy User
        $adminUser = [
            'first_name' => 'Alice TESTING',
            'last_name' => 'Smith TESTING',
            'address' => 'Heinrich Heine Platz 88, Weißensee,  Freistaat Thüringen',
            'city' => 'Weißensee',
            'state' => 'Freistaat Thüringen',
            'postal_code' => '99630',
            'country' => 'Germany',
            'phone' => "+49.03636836080",
            'email' => 'alice_smith_testing_admin@mailinator.com',
        ];

        // Dummy Data
        $customer = Customer::make([
            'name' => 'John Doe',
            'address' => 'Oldesloer Strasse 78, Rohr, Freistaat Bayern',
            'city' => 'Rohr',
            'state' => 'Freistaat Bayern',
            'postal_code' => '93352',
            'country' => 'Germany',
            'phone' => '+49.15510686794',
            'email' => 'john_doe_testing@mailinator.com',
        ]);

        // Dummy Data
        $website = Website::make([
            'uuid' => Str::uuid(),
            'domain' => 'random-domain-free-testing-test'. Str::random(5) . '.com'
        ]);

        $apiUser = config('namecheap.namecheap.api_user');
        $apiKey = config('namecheap.namecheap.api_key');
        $clientIp = config('namecheap.namecheap.client_id');
        $userName = config('namecheap.namecheap.user_name');

        $ncDomains = new Domains($apiUser, $apiKey, $userName, $clientIp, 'json');
        $ncDomains->enableSandbox();
        $result = $ncDomains->create(self::buildDomain($website), self::buildContactInfo($customer, $adminUser));

        Log::info(__CLASS__, [
            $result
        ]);

        return $result;
    }

    public static function buildContactInfo(Customer $customer, array $user): array
    {
        return [
            ...self::buildRegistrant($customer),
            ...self::buildAdmin($user),
            ...self::buildTechUser($user),
        ];
    }

    public static function buildDomain(Website $website, int $year = 2): array
    {
        return [
            "domainName" => $website->domain,
            "years" => $year,
        ];
    }

    public static function buildRegistrant(Customer $customer): array
    {
        return [
            "registrantFirstName" => $customer->first_name,
            "registrantLastName" => $customer->last_name,
            "registrantAddress1" => $customer->address,
            "registrantCity" => $customer->city,
            "registrantStateProvince" => $customer->state,
            "registrantPostalCode" => $customer->postal_code,
            "registrantCountry" => $customer->country,
            "registrantPhone" => $customer->phone,
            "registrantEmailAddress" => $customer->email,
        ];
    }

    public static function buildTechUser(array $user): array
    {
        return [
            "techFirstName" => $user['first_name'],
            "techLastName" => $user['last_name'],
            "techAddress" => $user['address'],
            "techCity" => $user['city'],
            "techStateProvince" => $user['state'],
            "techPostalCode" => $user['postal_code'],
            "techCountry" => $user['country'],
            "techPhone" => $user['phone'],
            "techEmailAddress" => $user['email'],
        ];
    }

    public static function buildAdmin(array $user): array
    {
        return [
            "adminFirstName" => $user['first_name'],
            "adminLastName" => $user['last_name'],
            "adminAddress" => $user['address'],
            "adminCity" => $user['city'],
            "adminStateProvince" => $user['state'],
            "adminPostalCode" => $user['postal_code'],
            "adminCountry" => $user['country'],
            "adminPhone" => $user['phone'],
            "adminEmailAddress" => $user['email'],
        ];
    }

    public static function buildAuxBilling(Customer|User $customer): array
    {
        return [
            "auxBillingFirstName" => $customer->first_name,
            "auxBillingLastName" => $customer->last_name,
            "auxBillingAddress" => $customer->address,
            "auxBillingCity" => $customer->city,
            "auxBillingStateProvince" => $customer->state,
            "auxBillingPostalCode" => $customer->postal_code,
            "auxBillingCountry" => $customer->country,
            "auxBillingPhone" => $customer->phone,
            "auxBillingEmailAddress" => $customer->email,
        ];
    }

    public static function buildBilling(Customer|User $customer): array
    {
        return [
            "billingFirstName" => $customer->first_name,
            "billingLastName" => $customer->last_name,
            "billingAddress" => $customer->address,
            "billingCity" => $customer->city,
            "billingStateProvince" => $customer->state,
            "billingPostalCode" => $customer->postal_code,
            "billingCountry" => $customer->country,
            "billingPhone" => $customer->phone,
            "billingEmailAddress" => $customer->email,
        ];
    }

    public static function getAuthorizationHeader(): array
    {
        return [
            "ApiUser" => config('namecheap.namecheap.api_user'),
            "ApiKey" => config('namecheap.namecheap.api_key'),
            "UserName" => config('namecheap.namecheap.user_name'),
            "Command" => config('namecheap.namecheap.command'),
            "ClientIp" => config('namecheap.namecheap.client_id'),
        ];
    }

    public static function formatNumber(string $areaCode, string $phoneNumber): string
    {
        return "{$areaCode}.{$phoneNumber}";
    }
}
