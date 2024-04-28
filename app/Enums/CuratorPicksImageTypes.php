<?php

namespace App\Enums;

class CuratorPicksImageTypes
{

    /**
     * Returns an array of image mime types
     *
     * @return string[]
     */
    public static function getImageMimeTypes(): array
    {
        return [
            'image/jpeg',
            'image/png',
            'image/webp',
            'image/avif',
        ];
    }
}
