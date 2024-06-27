<?php

namespace App\Filament\Resources\WebsiteResource\Pages;

use App\Filament\Resources\WebsiteDomainSetupResource;
use App\Filament\Resources\WebsiteResource;
use App\Models\Website;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditWebsite extends EditRecord
{
    protected static string $resource = WebsiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('domain_process')
                ->requiresConfirmation()
                ->modalHeading("You'll be redirected to the domain process setup")
                ->modalDescription("Please save you unsaved changes, if you have any")
                ->url(function (Website $website) {
                    return WebsiteDomainSetupResource::getUrl('view', [
                        'record' => $website->id
                    ]);
                }, true),
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $website = parent::handleRecordUpdate($record, $data);

        if (($theme = $website->theme) && $website->theme_data === null) {
            $website->update([
                'theme_data' => $theme->data,
            ]);
        }

        return $website;
    }
}
