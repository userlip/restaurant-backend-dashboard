<?php

namespace App\Enums;

class WebsiteThemesEnums
{
    public const THEME_1 = 'Theme 1';
    public const THEME_2 = 'Theme 2';

    /**
     * Method to return an associative array of the themes
     *
     * @return array
     */
    public static function getKeyValuePairs() : array
        {
        return [
            self::THEME_1 => self::THEME_1,
            self::THEME_2 => self::THEME_2,
        ];
    }
}
