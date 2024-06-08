<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeTemplateOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \JsonException
     */
    public function run(): void
    {
        $assetPath = database_path('data/template-1/assets');
        $templateStoragePath = public_path('storage/template-1');

        if (! file_exists($templateStoragePath)) {
            \File::makeDirectory($templateStoragePath, 0777, true, true);
        }

        $assets = glob($assetPath .'/*');

        foreach ($assets as $asset) {
            $file_name = basename($asset);
            \File::copy($asset, $templateStoragePath . "/{$file_name}");
        }

        $data = json_decode(file_get_contents(
            database_path('data/template-1/template-data.json')
        ), true, 512, JSON_THROW_ON_ERROR);

        Theme::create([
            'name' => 'Theme #1',
            'template' => 'template_1',
            'data' => $data,
            'preview_data' => null,
            'is_active' => true,
        ]);
    }
}
