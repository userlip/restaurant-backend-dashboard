<?php

namespace App\Utils;

use App\Models\Customer;
use App\Models\User;
use App\Models\Website;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Log;
use Namecheap\Domain\Domains;
use Namecheap\Domain\DomainsDns;

class Namecheap
{
    private const URL = 'https://api.sandbox.namecheap.com/xml.response';

    private Domains $domains;
    private DomainsDns $domainsDns;

    public function __construct()
    {
        $apiUser = config('namecheap.namecheap.api_user');
        $apiKey = config('namecheap.namecheap.api_key');
        $clientIp = config('namecheap.namecheap.client_id');
        $userName = config('namecheap.namecheap.user_name');

        // Domain DNS
        $this->domainsDns = new DomainsDns($apiUser, $apiKey, $userName, $clientIp, 'json');
        $this->domainsDns->enableSandbox();

        // Domains
        $this->domains = new Domains($apiUser, $apiKey, $userName, $clientIp, 'json');
        $this->domains->enableSandbox();
    }

    /**
     * @throws \JsonException
     */
    public function buyDomain(Website $website)
    {
        $ncDomains = $this->domains;

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
        $customer = $website->customer;

        $result = $ncDomains->create(self::buildDomain($website), self::buildContactInfo($customer, $adminUser));

        $website->update([
            'domain_purchase_response' => json_decode($result, true, 512, JSON_THROW_ON_ERROR),
        ]);

        Log::info(__CLASS__ . "::" . __FUNCTION__, [
            $result
        ]);

        return $result;
    }

    /**
     * @throws \Exception
     */
    public function changeNameserver(Website $website)
    {
        $namecheap = $this->domainsDns;
        $domain = explode(".", $website->domain);
        $sld = data_get($domain, 0);
        $tld = data_get($domain, 1);
        $nameServers = $website->new_nameservers;
        $nameServers = implode(",", $nameServers);

        if ($sld === null || $tld === null || $nameServers === null) {
            throw new \RuntimeException("Missing domain, or cloudflare response data");
        }

        $response = $namecheap->setCustom($sld, $tld, $nameServers);
        $status = data_get($response, 'ApiResponse._STATUS');

        $website->update([
            'nameserver_transfer' => json_decode($response, true, 512, JSON_THROW_ON_ERROR),
        ]);

        Log::info(__CLASS__ . "::" . __FUNCTION__ . " TIMESTAMP: " . now() , [
            $response
        ]);

        if ($status === "ERROR") {
            throw new RuntimeException($response);
        }

        return $response;
    }

    public function setHost(Website $website)
    {
        $domainDns = $this->domainsDns;
        $domain = explode(".", $website->domain);
        $sld = data_get($domain, 0);
        $tld = data_get($domain, 1);
        $address = config('ploi.api.host_url');

        $response = $domainDns->setHosts($sld, $tld, ['www'], ['A'], [$address], []);

        $status = data_get($response, 'ApiResponse._STATUS');

        Log::info(__CLASS__ . "::" . __FUNCTION__ . " TIMESTAMP: " . now() , [
            $response
        ]);

        if ($status === "ERROR") {
            throw new RuntimeException($response);
        }

        return $response;
    }

    /**
     * @throws \JsonException
     */
    public function checkDomainAvailability(string $domain): bool
    {
        $namecheap = $this->domains;
        $result = $namecheap->check($domain);
        $response = json_decode($result, true, 512, JSON_THROW_ON_ERROR);

        if ($website = Website::where('domain', $domain)->first()) {
            $website->update([
                'domain_availability' => $response
            ]);
        }

        return data_get($response, 'ApiResponse.CommandResponse.DomainCheckResult._Available') === "true";
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
            "registrantPhone" => $customer->namecheap_friendly_phone_number,
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
