<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use App\Livewire\GetLeadsComponent;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('toSearchLeads')
                ->color(Color::Orange)
                ->icon('heroicon-c-magnifying-glass')
                ->label('Search Leads')
                ->action(function () {
                    return redirect(route('filament.admin.resources.leads.search-leads'));
                }),
            Actions\CreateAction::make(),
        ];
    }
}
