<?php

namespace App\Filament\Resources;

use App\Enums\LeadStatusEnums;
use App\Filament\Resources\LeadResource\Pages;
use App\Filament\Resources\LeadResource\RelationManagers;
use App\Models\Lead;
use App\Service\LeadService;
use App\Trait\ResourceModelCountNavigationBadge;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class LeadResource extends Resource
{
    use ResourceModelCountNavigationBadge;

    /**
     * The resource Model
     */
    protected static ?string $model = Lead::class;

    /**
     * The resource navigation icon.
     */
    protected static ?string $navigationIcon = 'heroicon-s-presentation-chart-bar';

    /**
     * The resource navigation group
     *
     * @var string|null
     */
    protected static ?string $navigationGroup = 'Customers';

    /**
     * The resource navigation sort
     *
     * @var int|null
     */
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->autofocus()
                            ->placeholder('Enter the name')
                            ->unique()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('address')
                            ->placeholder('Enter the address')
                            ->maxLength(255),

                        PhoneInput::make('phone')
                            ->placeholder('Enter the phone'),

                        Forms\Components\TextInput::make('link')
                            ->placeholder('Enter the address')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('google_business_id')
                            ->label('Google Business ID')
                            ->placeholder('e.g., 0x3bae179ad3b6da99:0xd823b05add6a7fae')
                            ->helperText('This will be auto-extracted from the link if possible')
                            ->maxLength(255),

                        Forms\Components\Select::make('status')
                            ->options(LeadStatusEnums::getKeyValuePairs())
                            ->required()
                            ->default(LeadStatusEnums::NEW),

                        Forms\Components\Select::make('sales_person_id')
                            ->label('Sales Person')
                            ->relationship('salesPerson', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(static::getModel()::latest('id'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('address')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('link')
                    ->limit(20)
                    ->url(fn (Lead $record) => $record->link)
                    ->color(Color::Blue)
                    ->openUrlInNewTab()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match($state) {
                        LeadStatusEnums::NEW => Color::Yellow,
                        LeadStatusEnums::CONTACTED => Color::Blue,
                        LeadStatusEnums::CANCELLED => Color::Red,
                        LeadStatusEnums::WON => Color::Green,
                        default => Color::Gray,
                    })
                    ->formatStateUsing(fn (string $state) => LeadStatusEnums::getKeyValuePairs()[$state] ?? $state)
                    ->sortable(),

                Tables\Columns\TextColumn::make('one_star_count')
                    ->label('1★')
                    ->badge()
                    ->color(Color::Red)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('two_star_count')
                    ->label('2★')
                    ->badge()
                    ->color(Color::Orange)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('three_star_count')
                    ->label('3★')
                    ->badge()
                    ->color(Color::Yellow)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('four_star_count')
                    ->label('4★')
                    ->badge()
                    ->color(Color::Blue)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('five_star_count')
                    ->label('5★')
                    ->badge()
                    ->color(Color::Green)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total_reviews')
                    ->label('Total Reviews')
                    ->badge()
                    ->color(Color::Blue)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('average_rating')
                    ->label('Avg Rating')
                    ->badge()
                    ->color(fn (?float $state) => match(true) {
                        $state === null => Color::Gray,
                        $state >= 4.5 => Color::Green,
                        $state >= 4.0 => Color::Blue,
                        $state >= 3.0 => Color::Yellow,
                        $state >= 2.0 => Color::Orange,
                        default => Color::Red,
                    })
                    ->formatStateUsing(fn (?float $state) => $state ? number_format($state, 1) . '★' : '-')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('salesPerson.name')
                    ->label('Sales Person')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('notes_count')
                    ->label('Notes')
                    ->counts('notes')
                    ->badge()
                    ->color(fn (int $state) => $state > 0 ? Color::Blue : Color::Gray)
                    ->sortable(),

                Tables\Columns\TextColumn::make('latest_note')
                    ->label('Latest Note')
                    ->getStateUsing(function (Lead $record) {
                        $latestNote = $record->notes()->latest()->first();
                        return $latestNote ? $latestNote->note : '-';
                    })
                    ->limit(50)
                    ->tooltip(function (Lead $record) {
                        $latestNote = $record->notes()->latest()->first();
                        return $latestNote ? $latestNote->note : null;
                    })
                    ->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('search_term')
                    ->attribute('search_term')
                    ->options((app(LeadService::class))->getLeadSearchTerms(true)),

                Tables\Filters\SelectFilter::make('status')
                    ->options(LeadStatusEnums::getKeyValuePairs())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('convert_to_customer')
                    ->label('Convert')
                    ->icon('heroicon-o-arrow-uturn-right')
                    ->color(Color::Orange)
                    ->requiresConfirmation()
                    ->modalHeading('Do you want to convert this Lead into Customer?')
                    ->modalWidth(MaxWidth::ExtraLarge)
                    ->disabled(fn (Lead $record) => $record?->customer_id !== null)
                    ->fillForm(fn (Lead $record) => [
                        'name' => $record->name,
                        'address' => $record->address,
                        'phone' => $record->phone,
                        'whatsapp_number' => $record->phone,
                    ])
                    ->form([
                        CustomerResource::getFormSchema()
                    ])
                    ->action(function (Lead $record, array $data) {
                        $service = (app(LeadService::class))
                            ->convertToCustomer($record, $data);

                        if ($service) {
                            Notification::make()
                                ->title('Converted Successfully!')
                                ->actions([
                                    Action::make('Redirect me to Customer')
                                        ->url(route('filament.admin.resources.customers.index'))
                                ])
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Failed to Convert!')
                                ->body('Please try again')
                                ->warning()
                                ->send();
                        }
                    }),
                Tables\Actions\Action::make('update_reviews')
                    ->label('Update Reviews')
                    ->icon('heroicon-o-star')
                    ->color(Color::Blue)
                    ->requiresConfirmation()
                    ->modalHeading('Update Reviews')
                    ->modalDescription('This will fetch the latest reviews from Google for this lead.')
                    ->modalWidth(MaxWidth::Small)
                    ->action(function (Lead $record) {
                        $reviewService = app(\App\Service\ReviewService::class);
                        
                        if ($reviewService->fetchAndUpdateReviews($record)) {
                            $record->refresh();
                            
                            Notification::make()
                                ->title('Reviews Updated Successfully!')
                                ->body("Total Reviews: {$record->total_reviews}, Average Rating: " . ($record->average_rating ?? 'N/A'))
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Failed to Update Reviews')
                                ->body('Please check the logs for more information.')
                                ->danger()
                                ->send();
                        }
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('bulk_update_reviews')
                        ->label('Update Reviews')
                        ->icon('heroicon-o-star')
                        ->color(Color::Blue)
                        ->requiresConfirmation()
                        ->modalHeading('Update Reviews for Selected Leads')
                        ->modalDescription('This will fetch the latest reviews from Google for all selected leads. This may take some time.')
                        ->deselectRecordsAfterCompletion()
                        ->action(function ($records) {
                            $reviewService = app(\App\Service\ReviewService::class);
                            $successCount = 0;
                            $failCount = 0;
                            
                            foreach ($records as $record) {
                                if ($reviewService->fetchAndUpdateReviews($record)) {
                                    $successCount++;
                                } else {
                                    $failCount++;
                                }
                                // Small delay to avoid rate limiting
                                sleep(1);
                            }
                            
                            Notification::make()
                                ->title('Reviews Update Complete')
                                ->body("Success: {$successCount}, Failed: {$failCount}")
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CustomerRelationManager::class,
            RelationManagers\NotesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
            'search-leads' => Pages\SearchLeadsPage::route('/search'),
        ];
    }
}
