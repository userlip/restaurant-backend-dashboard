<?php

namespace App\Filament\Resources\TemplateTwoResource\Pages;

use App\Filament\Resources\TemplateTwoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplateTwo extends EditRecord
{
    protected static string $resource = TemplateTwoResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
