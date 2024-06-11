<?php

namespace App\Filament\Resources\TemplateTwoResource\Pages;

use App\Filament\Resources\TemplateTwoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemplateTwos extends ListRecords
{
    protected static string $resource = TemplateTwoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
