<?php

namespace Database\Seeders;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Seeder;

class TemplateTwoMediaPickerAssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assetPath = database_path('data/template-2/assets');
        $templateStoragePath = public_path('storage/media/template-2');

        if (! file_exists($templateStoragePath)) {
            \File::makeDirectory($templateStoragePath, 0777, true, true);
        }

        $assets = glob($assetPath .'/*');

        foreach ($assets as $asset) {
            $file_name = basename($asset);
            $target_file_path = $templateStoragePath . "/{$file_name}";

            if (! \File::exists($target_file_path)) {
                \File::copy($asset, $target_file_path);
            }

            $storage_directory = 'media/template-2';
            $storage_file_path = $storage_directory . "/{$file_name}";

            Media::create([
                'disk' => 'public',
                'directory' => $storage_directory,
                'visibility' => 'public',
                'name' => pathinfo($target_file_path, PATHINFO_FILENAME),
                'path' => $storage_file_path,
                'width' => data_get(getimagesize($target_file_path), 0),
                'height' => data_get(getimagesize($target_file_path), 1),
                'size' => \File::size($target_file_path),
                'type' => \File::mimeType($target_file_path),
                'ext' => pathinfo($target_file_path, PATHINFO_EXTENSION),
                'alt' => '',
            ]);
        }
    }
}
