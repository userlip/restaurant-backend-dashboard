<?php

namespace App\Filament\Resources\TemplateOneMediaPickerResource\Pages;

use App\Filament\Resources\TemplateOneMediaPickerResource;
use App\Filament\Resources\TemplateOneResource;
use App\Models\Website;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Colors\Color;

class EditTemplateOneMediaPicker extends EditRecord
{
    protected static string $resource = TemplateOneMediaPickerResource::class;

    protected function getHeaderActions(): array
    {
        return [
             Action::make('use_file_upload')
                ->color(Color::Emerald)
                ->disabled(function () {
                    return \Route::getCurrentRoute()->getName() === 'filament.admin.resources.template-ones.edit';
                })
                ->url(function (Website $record) {
                    return TemplateOneResource::getUrl('edit', ['record' => $record->id]);
                })
        ];
    }
}
