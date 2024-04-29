<?php

namespace App\Enums;

use phpDocumentor\Reflection\Types\Self_;

class LeadStatusEnums
{
    public const NEW = "new";
    public const PROCESSED = "processed";


    /**
     * Returns an associative array of the enum fields
     *
     * @return string[]
     */
    public static function getKeyValuePairs(): array
    {
        return [
            self::NEW => ucfirst(self::NEW),
            self::PROCESSED => ucfirst(self::PROCESSED),
        ];
    }
}
