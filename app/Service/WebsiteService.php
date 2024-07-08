<?php

namespace App\Service;

use App\Models\Website;
use App\Utils\Cloudflare;
use App\Utils\Namecheap;
use App\Utils\Ploi;

class WebsiteService
{
    private Namecheap $namecheap;
    private Cloudflare $cloudflare;
    private Ploi $ploi;

    public function __construct()
    {
        $this->namecheap = new Namecheap;
        $this->cloudflare = new Cloudflare;
        $this->ploi = new Ploi;
    }

    /**
     * Step 1:
     * Only use this function only if the website's domain is available.
     *
     * @param Website $website
     * @return bool
     * @throws \JsonException
     */
    public function buyDomain(Website $website) : bool
    {
        $namecheap = $this->namecheap;

        /**
         * Add the next steps for processing the connecting domain setup
         */
        return $namecheap->buyDomain($website);
    }

    /**
     * Step 2:
     *
     * @param Website $website
     * @return bool
     */
    public function createCloudflareDnsZone(Website $website) : bool
    {
        $cloudflare = $this->cloudflare;
        return $cloudflare::createNewDnsZone($website);
    }

    /**
     * Step 3:
     *
     * @param Website $website
     * @return false|void
     * @throws \Exception
     */
    public function changeNameservers(Website $website)
    {
        $namecheap = $this->namecheap;

        if ($website->new_nameservers === null) {
            \Log::error(__CLASS__ . "::" . __FUNCTION__ . " " . now(), [
                "Invalid Website Cloudflare response data, no new nameservers were found"
            ]);

            return false;
        }

        $namecheap->changeNameserver($website);
    }

    /**
     * Step 4: Create Type A DNS Records
     */
    public function createDnsRecords(Website $website): bool
    {
        $cloudflare = $this->cloudflare;
        return $cloudflare::createDnsRecords($website);
    }

    /**
     * Step 5: Create Ploi Tenant
     * @throws \Exception
     */
    public function createTenant(Website $website): bool
    {
        $ploi = $this->ploi;
        return $ploi::createTenant($website);
    }


    /**
     * This function covers all the process of purchasing, and other setup for the changing the domain dns and etc.
     * This function must only be used if the domain is available to use or else it will only stop at the 'buyDomain'
     * function.
     *
     * @throws \JsonException
     * @throws \Exception
     */
    public function connectingDomainProcess(Website $website): bool
    {
        $buyDomain = $this->buyDomain($website);

        if ($buyDomain === false) {
            return false;
        }

        $createDnsZone = $this->createCloudflareDnsZone($website);

        if ($createDnsZone === false) {
            return false;
        }

        $changeNameServers = $this->changeNameservers($website);

        if ($changeNameServers === false) {
            return false;
        }

        $createDnsRecords = $this->createDnsRecords($website);

        if ($createDnsRecords === false) {
            return false;
        }

        $createTenant = $this->createTenant($website);

        if ($createTenant === false) {
            return false;
        }

        return true;
    }
}
