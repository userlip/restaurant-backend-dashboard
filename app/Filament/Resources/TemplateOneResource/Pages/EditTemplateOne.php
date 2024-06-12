<?php

namespace App\Filament\Resources\TemplateOneResource\Pages;

use App\Filament\Resources\TemplateOneResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplateOne extends EditRecord
{
    protected static string $resource = TemplateOneResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
