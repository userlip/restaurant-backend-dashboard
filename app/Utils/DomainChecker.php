<?php

namespace App\Utils;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DomainChecker
{
    private const URL = "https://domaination.p.rapidapi.com/domains/";
    private const HEADER_HOST = "domaination.p.rapidapi.com";

    public static function getDomainAvailability(string $domain, int $retry = 0)
    {
        $validator = \Validator::make([
            'domain' => $domain,
        ], [
            'domain' => ['required', 'regex:' . WhoIsJsonApiChecker::REGEX_PATTERN]
        ]);

        if ($validator->fails()) {
            return false;
        }

        $response = \Http::acceptJson()
            ->withHeaders(self::getHeaders())
            ->get(self::URL . $domain);

        Log::info(__CLASS__ . "::" . __FUNCTION__ , [
            "domain" => $domain,
            "response" => $response->json()
        ]);

        return $response->json('domain.isAvailable');
    }

    public static function getHeaders(): array
    {
        return [
            "x-rapidapi-host" => self::HEADER_HOST,
            "x-rapidapi-key" => config('rapid-api.domain-checker.domain_checker_api')
        ];
    }
}
