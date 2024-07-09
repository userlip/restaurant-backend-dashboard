<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Helper\CountryHelper;
use App\Models\Customer;
use App\Trait\ResourceModelCountNavigationBadge;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\ValidationException;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
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
                self::getFormSchema()
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
            ->defaultSort('id', 'DESC')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->limit(20)
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

                Tables\Columns\CheckboxColumn::make('is_converted_lead')
                    ->label('Converted')
                    ->alignCenter()
                    ->disabled()
                    ->getStateUsing(fn (Customer $record) => $record?->lead !== null)
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
            RelationManagers\LeadRelationManager::class,
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


    /**
     * Returns the form schema of the Customer Resource
     *
     * @return Grid
     */
    public static function getFormSchema(): Grid
    {
        return Grid::make()
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

                        Forms\Components\Section::make('Address')
                            ->columns(2)
                            ->description('Make sure that the address is a valid address, as buying the domain will not work.')
                            ->schema([
                                Forms\Components\TextInput::make('address')
                                    ->required()
                                    ->placeholder('Enter the customer address')
                                    ->columnSpanFull()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('city')
                                    ->required()
                                    ->placeholder('Enter the city')
                                    ->columns(2)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('state')
                                    ->required()
                                    ->placeholder('Enter the state')
                                    ->columns(2)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('postal_code')
                                    ->required()
                                    ->numeric()
                                    ->placeholder('Enter the postal_code')
                                    ->columns(2)
                                    ->maxLength(255),

                                Forms\Components\Select::make('country')
                                    ->options(CountryHelper::getAllCountries())
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Contact')
                            ->columns()
                            ->schema([
                                Forms\Components\TextInput::make('area_code')
                                    ->required()
                                    ->live(),

                                PhoneInput::make('phone')
                                    ->autoInsertDialCode()
                                    ->countryStatePath('phone_country')
                                    ->required()
                                    ->placeholder("Enter the customer phone")
                                    ->defaultCountry('DE')
                                    ->live()
                                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                                        if (
                                            ($countryCode = $get('phone_country')) &&
                                            $phoneNumber = $get('phone')
                                        ) {
                                            try {
                                                $phoneUtil = PhoneNumberUtil::getInstance();
                                                $number = $phoneUtil->parse($phoneNumber, $countryCode);

                                                $set('area_code', '+' . $number->getCountryCode());
                                            } catch (NumberParseException $exception) {
                                                throw ValidationException::withMessages([
                                                    'data.phone' => $exception->getMessage(),
                                                ]);
                                            }
                                        }
                                    }),

                                PhoneInput::make('whatsapp_number')
                                    ->required()
                                    ->placeholder("Enter the customer whatsapp"),

                                Forms\Components\TextInput::make('contact_person')
                                    ->required()
                                    ->placeholder("Enter the customer contact person")
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Section::make('Invoice')
                            ->columns()
                            ->schema([
                                Forms\Components\Toggle::make('is_invoice')
                                    ->columnSpanFull()
                                    ->required(),

                                Forms\Components\DatePicker::make('next_payment_date')
                                    ->required()
                                    ->columnSpanFull()
                                    ->default(now()),

                                MoneyInput::make('agreed_price')
                                    ->required()
                                    ->columnSpan(1)
                                    ->minValue(0),
                            ]),

                        Forms\Components\Textarea::make('impressum')
                            ->columnSpanFull()
                            ->placeholder('Enter the impressum')
                            ->required(),
                    ]),
            ]);
    }
}
