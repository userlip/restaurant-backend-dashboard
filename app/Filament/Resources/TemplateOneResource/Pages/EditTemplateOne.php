<?php

namespace App\Filament\Resources\TemplateOneResource\Pages;

use App\Filament\Resources\TemplateOneResource;
use App\Trait\TemplatePreviewActionTrait;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplateOne extends EditRecord
{
    use TemplatePreviewActionTrait;

    protected static string $resource = TemplateOneResource::class;
}
