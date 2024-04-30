<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use App\Jobs\FetchPotentialLeadsFromAPIUsingQuery;
use App\Service\LeadService;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class SearchLeadsPage extends Page implements HasForms, HasInfolists
{
    use InteractsWithForms, InteractsWithInfolists;

    public ?array $data = [];

    protected static string $resource = LeadResource::class;

    protected ?string $heading = "Search Leads";

    protected static string $view = 'filament.resources.lead-resource.pages.search-leads-page';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $service = app(LeadService::class);
        $datalist = $service->getLeadSearchTerms();

        return $form
            ->schema([
                TextInput::make('query')
                    ->label('Search for')
                    ->placeholder('Restaurants in Berlin, Germany')
                    ->live()
                    ->hintAction(
                        \Filament\Forms\Components\Actions\Action::make('view_leads')
                            ->label('View Leads')
                            ->icon('heroicon-o-eye')
                            ->visible(function (Get $get) use ($service) {
                                return $service->checkSearchTermExists($get('query'));
                            })
                            ->url(function (Get $get) {
                                return route('filament.admin.resources.leads.index', [
                                    'tableFilters' => [
                                        'search_term' => [
                                            'value' => $get('query')
                                        ]
                                    ]
                                ]);
                            })

                    )
                    ->datalist($datalist)
                    ->required(),
            ])
            ->statePath('data');
    }


    public function getLeads()
    {
        $query = data_get($this->form->getState(), 'query');

        FetchPotentialLeadsFromAPIUsingQuery::dispatch($query, \Auth::user());

        Notification::make()
            ->title('Now fetching the leads...')
            ->body('It may take some time to fetch and save the leads.')
            ->actions([
                Action::make('Go to Leads')
                    ->url(route('filament.admin.resources.leads.index'))
            ])
            ->success()
            ->send();
    }

}
