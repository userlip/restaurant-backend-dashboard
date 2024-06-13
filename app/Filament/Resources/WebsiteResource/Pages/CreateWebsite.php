<?php

namespace App\Filament\Resources\WebsiteResource\Pages;

use App\Filament\Resources\WebsiteResource;
use App\Models\Theme;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateWebsite extends CreateRecord
{
    protected static string $resource = WebsiteResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['uuid'] = \Str::uuid();

        $website =  parent::handleRecordCreation($data);

        if ($theme = Theme::find(data_get($data, 'theme'))) {
            $website->update([
                'theme_id' => $theme->id,
                'theme_data' => $theme->data,
            ]);
        }

        return $website;
    }
}
