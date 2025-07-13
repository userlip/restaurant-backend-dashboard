<?php

namespace App\Enums;

use phpDocumentor\Reflection\Types\Self_;

class LeadStatusEnums
{
    public const NEW = "new";
    public const CONTACTED = "contacted";
    public const CANCELLED = "cancelled";
    public const WON = "won";


    /**
     * Returns an associative array of the enum fields
     *
     * @return string[]
     */
    public static function getKeyValuePairs(): array
    {
        return [
            self::NEW => 'Neu',
            self::CONTACTED => 'Kontakt aufgenommen',
            self::CANCELLED => 'Abgesagt',
            self::WON => 'Gewonnen',
        ];
    }
}
