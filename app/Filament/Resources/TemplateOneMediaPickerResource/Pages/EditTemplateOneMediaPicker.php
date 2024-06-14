<?php

namespace App\Filament\Resources\TemplateOneMediaPickerResource\Pages;

use App\Filament\Resources\TemplateOneMediaPickerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplateOneMediaPicker extends EditRecord
{
    protected static string $resource = TemplateOneMediaPickerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
