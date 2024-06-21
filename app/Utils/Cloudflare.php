<?php

namespace App\Utils;

use App\Models\Website;
use Illuminate\Support\Facades\Http;
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

    public static function createDnsRecords(Website $website): void
    {
        $zoneId = data_get($website->cloudflare_response, 'result.id');

        if ($zoneId === null) {
            throw new \RuntimeException("Missing Zone ID data");
        }

        $url = self::ZONE_URL . "/{$zoneId}" . "/dns_records";

        // Creates the A record DNS
        $aRecordDns = self::buildADnsRecord(
            $zoneId,
            config('ploi.api.host_ip_address'),
            "@",
            type: "A",
        );

        // Creates HTTPS record DNS
        $httpsDnsRecord = self::buildHttpsDnsRecord(
            config('ploi.api.host_url'),
            $zoneId,
        );

        $aRecordDnsResponse = Http::acceptJson()
            ->withHeaders(self::getHeaders())
            ->post(
                $url,
                $aRecordDns
            );

        $httpsDnsRecordResponse = Http::acceptJson()
            ->withHeaders(self::getHeaders())
            ->post(
                $url,
                $httpsDnsRecord
            );

        $website->update([
            "type_a_dns_record" => $aRecordDnsResponse->json(),
            'type_https_dns_record' => $httpsDnsRecordResponse->json()
        ]);
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

    public static function buildADnsRecord(
        string $id,
        string $content,
        string $name,
        string $type,
        bool $proxied = true,
        string $comment = "",
        int $ttl = 1,
    ): array
    {
        return [
            "content" => $content,
            "name" => $name,
            "proxied" => $proxied,
            "type" => $type,
            "comment" => $comment,
            "id" => $id,
            "ttl" => $ttl,
        ];
    }

    public static function buildHttpsDnsRecord(
        string $target,
        string $id,
        string $value = "",
        string $name = "@",
        string $comment = "",
        int $ttl = 1,
    ): array
    {
        return [
            "data" => [
                "priority" => 1,
                "target" => $target,
                "value" => $value,
            ],
            "name" => $name,
            "type" => "HTTPS",
            "comment" => $comment,
            "id" => $id,
            "ttl" => $ttl,
        ];
    }
}
