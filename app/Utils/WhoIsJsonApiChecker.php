<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;

/**
 * For the REGEX_PATTERN constant although not a solid pattern, it does the job fine of validating domain
 * compare to using filter_var FILTER_VALIDATION_DOMAIN or laravel's url validation rule
 *
 * @see https://stackoverflow.com/questions/69640312/regex-validating-domain-name-with-regex
 */
class WhoIsJsonApiChecker
{
    private string $url = 'https://whoisjsonapi.com/v1/';

    private ?string $accessKey;

    public const REGEX_PATTERN = '/^[A-Za-z0-9]{1,63}(?:-[A-Za-z0-9]{1,63})*(?:-(?!\.[A-Za-z0-9]{1,63}$))?(?:\.[A-Za-z0-9]{1,63})+$/i';

    public function __construct()
    {
        $this->accessKey = config('app.who_is_json_access_key');
    }

    /**
     * Uses the whoisjsonapi to check the availability of the domain
     * This checks if the response of the api is error code is 'code' => "DOMAIN_NOT_FOUND"
     *
     * For the other response
     * @see https://whoisjsonapi.com/page/documentation#response
     *
     * @param string $domain
     * @return true
     */
    public function checkDomain(string $domain) : bool
    {
        $validator = \Validator::make([
            'domain' => $domain,
        ], [
            'domain' => ['required', 'regex:' . self::REGEX_PATTERN]
        ]);

        if ($validator->fails()) {
            return false;
        }

        $response = Http::acceptJson()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->accessKey,
            ])
            ->get($this->url . $domain);

        $response = $response->body();

        return data_get($response, 'code') === "DOMAIN_NOT_FOUND";
    }
}
