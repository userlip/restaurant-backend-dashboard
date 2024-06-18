<?php

namespace App\Filament\Resources\TemplateOneMediaPickerResource\Pages;

use App\Filament\Resources\TemplateOneMediaPickerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemplateOneMediaPickers extends ListRecords
{
    protected static string $resource = TemplateOneMediaPickerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
