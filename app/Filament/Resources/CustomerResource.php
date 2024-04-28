<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Trait\ResourceModelCountNavigationBadge;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class CustomerResource extends Resource
{
    use ResourceModelCountNavigationBadge;

    /**
     * The resource Model
     */
    protected static ?string $model = Customer::class;

    /**
     * The resource navigation icon.
     */
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
    protected static ?int $navigationSort = 0;

    /**
     * The resource form.
     *
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\Section::make()
                            ->columnSpan(3)
                            ->columns()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->columnSpanFull()
                                    ->placeholder("Enter the customer name")
                                    ->autofocus()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->required()
                                    ->columnSpanFull()
                                    ->email()
                                    ->placeholder("Enter the customer email")
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('address')
                                    ->required()
                                    ->placeholder('Enter the customer address')
                                    ->columnSpanFull()
                                    ->maxLength(255),

                                PhoneInput::make('phone')
                                    ->required()
                                    ->placeholder("Enter the customer phone")
                                    ->defaultCountry('DE'),

                                PhoneInput::make('whatsapp_number')
                                    ->required()
                                    ->placeholder("Enter the customer whatsapp"),

                                Forms\Components\TextInput::make('contact_person')
                                    ->required()
                                    ->columnSpanFull()
                                    ->placeholder("Enter the customer contact person")
                                    ->maxLength(255),

                                Forms\Components\Toggle::make('is_invoice')
                                    ->columnSpanFull()
                                    ->required(),

                                Forms\Components\DatePicker::make('next_payment_date')
                                    ->required()
                                    ->columnSpanFull()
                                    ->default(now()),

                                Forms\Components\TextInput::make('agreed_price')
                                    ->required()
                                    ->numeric()
                                    ->default(0.00)
                                    ->columnSpan(1)
                                    ->placeholder("Enter the customer contact person number")
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('impressum')
                                    ->columnSpanFull()
                                    ->placeholder('Enter the impressum')
                                    ->required(),
                            ]),
                    ]),

            ]);
    }

    /**
     * The resource table
     *
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->query(static::getModel()::latest('id'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('contact_person')
                    ->limit(20)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * The resource's registered relation managers
     *
     * @return string[]
     */
    public static function getRelations(): array
    {
        return [
            RelationManagers\NotesRelationManager::class,
            RelationManagers\WebsitesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
