<?php

namespace App\Helper;

use Awcodes\Curator\Models\Media;

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

    /**
     * A function that will return the path of the asset from the storage
     * In addition, to determine if an asset is a FileUpload or a Media asset
     * You need to check if the value is string or an int.
     *
     * FileUpload : string = 'public/path/path.jpg'
     * Media : int = 1 (Media::find(1)->url)
     *
     * @param string|int|null $asset
     * @return string|null
     */
    public static function getAssetPath(string | int | null $asset) : string | null
    {
        // Return null early if asset is null
        if ($asset === null) {
            return null;
        }

        // Checks if the asset has '/storage/' in its path as all assets
        // including uploaded ones must be in the storage folder
        if (! preg_match('/\\/storage\\//', $asset)) {
            $asset = "/storage/" . $asset;
        }

        return is_string($asset)
            ? asset($asset)
            : Media::find($asset)
                ?->url;
    }
}
