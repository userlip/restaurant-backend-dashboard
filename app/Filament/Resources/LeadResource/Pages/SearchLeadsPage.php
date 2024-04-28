<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use App\Jobs\FetchPotentialLeadsFromAPIUsingQuery;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\Page;

class SearchLeadsPage extends Page implements HasForms, HasInfolists
{
    use InteractsWithForms, InteractsWithInfolists;

    public ?array $data = [];

    protected static string $resource = LeadResource::class;

    protected ?string $heading = "Search Leads";

    protected static string $view = 'filament.resources.lead-resource.pages.search-leads-page';

    public string $loadingText = "";

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns()
            ->schema([
                TextInput::make('baseQuery')
                    ->label('Search for')
                    ->placeholder('Restaurants in Berlin')
                    ->required(),

                TextInput::make('country')
                    ->placeholder("Germany")
                    ->required(),
            ])
            ->statePath('data');
    }


    public function getLeads()
    {
        $baseQuery = data_get($this->form->getState(), 'baseQuery');
        $country = data_get($this->form->getState(), 'country');

        FetchPotentialLeadsFromAPIUsingQuery::dispatch($baseQuery . ', ' . $country);
    }

}
