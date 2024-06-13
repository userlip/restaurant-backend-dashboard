<?php

namespace App\Filament\Resources\TemplateTwoResource\Pages;

use App\Filament\Resources\TemplateTwoResource;
use App\Models\Website;
use App\Trait\TemplatePreviewActionTrait;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\View\View;

class EditTemplateTwo extends EditRecord
{
    use TemplatePreviewActionTrait;

    protected static string $resource = TemplateTwoResource::class;
}
