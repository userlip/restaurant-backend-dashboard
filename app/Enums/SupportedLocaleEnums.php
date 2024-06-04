<?php

namespace App\Enums;

enum SupportedLocaleEnums : string
{
    case en = "ENG";
    case de = "DUE";
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
