<?php

namespace App\Utils;

use App\Models\Website;
use GuzzleHttp\Promise\Promise;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Cloudflare
{
    public const ZONE_URL = "https://api.cloudflare.com/client/v4/zones";

    /**
     * After adding the website into the cloudflare, proceed to change the dns servers
     *
     * @param Website $website
     * @return Website
     */
    public static function createNewDnsZone(Website $website): Website
    {
        $response = \Http::acceptJson()
            ->withHeaders(self::getHeaders())
            ->post(
                self::ZONE_URL,
                self::buildNewDnsPayload($website->domain)
            );

        if ($response->status() !== Response::HTTP_OK) {
            \Log::error(__CLASS__ . "::" . __FUNCTION__, [
                $website,
                $response->body(),
            ]);
        }

        $response = $response->json();

        $newDns = data_get($response, 'result.name_servers');

        if ($newDns !== null) {
            $website->update([
                'cloudflare_response' => $response
            ]);
        }

        return $website;
    }

    public static function getHeaders(): array
    {
        $token = config('cloudflare.api.api_token');
        $email = config('cloudflare.api.email');

        return [
            "X-Auth-Email" => $email,
            "Authorization" => "Bearer {$token}",
        ];
    }

    public static function buildNewDnsPayload(string $domain): array
    {
        $account = config('cloudflare.api.account_id');

        return [
            "account" => [
                "id" => $account,
            ],
            "name" => $domain,
            "type" => "full",
        ];
    }
}
