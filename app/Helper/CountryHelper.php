<?php

namespace App\Helper;

use Monarobase\CountryList\CountryList;

class CountryHelper
{
    public static function getAllCountries()
    {
        return collect((new CountryList)->getList())
            ->mapWithKeys(fn(string $country) => [
                $country => $country
            ]);
    }
}
