<?php

namespace App\Trait;

trait ResourceModelCountNavigationBadge
{
    /**
     * The resource navigation badge
     *
     * @return string|null
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }
}
