<?php

namespace App\Service;

use App\Models\Website;
use App\Utils\Namecheap;

class WebsiteService
{
    private Namecheap $namecheap;

    public function __construct()
    {
        $this->namecheap = new Namecheap;
    }

    /**
     * Only use this function only if the website's domain is available.
     *
     * @param Website $website
     * @return void
     * @throws \JsonException
     */
    public function setupWebsiteDomain(Website $website)
    {
        $namecheap = $this->namecheap;

        $namecheap->buyDomain($website);

    }
}
