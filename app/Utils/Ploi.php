<?php

namespace App\Utils;

use App\Models\Website;
use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class Ploi
{
    /**
     * @throws Exception
     */
    public static function createTenant(Website $website)
    {
        $domain = $website->domain;
        $accessToken = config('ploi.api.access_token');
        $server = config('ploi.api.server');
        $site = config('ploi.api.site');

        $response = Http::acceptJson()
            ->withToken($accessToken)
            ->post("https://ploi.io/api/servers/{$server}/sites/{$site}/tenants", [
                "tenants" => [$domain]
            ]);

        if ($response->status() !== Response::HTTP_OK) {
            throw new \RuntimeException("Failed to create tenant for website {$website->id}");
        }

        return $response->status() === Response::HTTP_OK;
    }
}
