<?php

namespace App\Filament\Resources\WebsiteDomainSetupResource\Pages;

use App\Filament\Resources\WebsiteDomainSetupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebsiteDomainSetup extends ViewRecord
{
    protected static string $resource = WebsiteDomainSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
