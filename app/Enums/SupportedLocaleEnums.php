<?php

namespace App\Enums;

enum SupportedLocaleEnums : string
{
    case en = "ENG";
    case de = "DEU";
    case tr = "TÜR";
    case ar = "عربي";

    public static function getOptions(): array
    {
        return [
            self::en->name,
            self::de->name,
            self::tr->name,
            self::ar->name,
        ];
    }
}
