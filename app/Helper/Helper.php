<?php

namespace App\Helper;

class Helper
{
    public static function getLanguageThreeLetterCode(string $lang)
    {
        return match ($lang) {
            "en" => "ENG",
            "de" => "DUE",
            "tr" => "TÜR",
            "ar" => "عربي",
        };
    }
}
