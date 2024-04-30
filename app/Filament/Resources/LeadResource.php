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

                        Forms\Components\Select::make('status')
                            ->options(LeadStatusEnums::getKeyValuePairs())
                            ->required()
                            ->default(LeadStatusEnums::NEW)
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
                        LeadStatusEnums::PROCESSED => Color::Green,
                        default => Color::Yellow,
                    })
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->sortable(),
            ])
            ->filters([
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
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
