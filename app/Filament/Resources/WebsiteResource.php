<?php

namespace App\Filament\Resources;

use App\Enums\CuratorPicksImageTypes;
use App\Enums\WebsiteThemesEnums;
use App\Filament\Resources\WebsiteResource\Pages;
use App\Filament\Resources\WebsiteResource\RelationManagers;
use App\Forms\Components\FillWithGpt;
use App\Models\Theme;
use App\Models\Website;
use App\Trait\ResourceModelCountNavigationBadge;
use App\Utils\WhoIsJsonApiChecker;
use dacoto\DomainValidator\Validator\Domain;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Component;

class WebsiteResource extends Resource
{
    use ResourceModelCountNavigationBadge;

    /**
     * The resource model
     *
     * @var string|null
     */
    protected static ?string $model = Website::class;

    /**
     * The resource navigation icon
     *
     * @var string|null
     */
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

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
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->placeholder('Select a Customer')
                            ->preload()
                            ->live()
                            ->searchable('name')
                            ->required(),

                        Forms\Components\TextInput::make('domain')
                            ->required()
                            ->live(debounce: 750)
                            ->placeholder('Enter the domain')
                            ->hintActions([
                                Forms\Components\Actions\Action::make('purchase_or_check_domain')
                                    ->label('Purchase/Check Domain')
                                    ->icon('heroicon-o-link')
                                    ->requiresConfirmation()
                                    ->modalHeading("You'll be redirected to porkbun's website")
                                    ->openUrlInNewTab()
                                    ->url(function (Forms\Get $get) {
                                        $domain = str_replace(' ', '-', strtolower(trim($get('domain'))));

                                        if (! self::validateDomain($domain)) {
                                            return null;
                                        }

                                        return Website::PORKBUN_QUERY_WEBSITE . $domain;
                                    })
                                    ->visible(function (Forms\Get $get) {
                                        $domain = str_replace(' ', '-', strtolower(trim($get('domain'))));

                                        return self::validateDomain($domain);
                                    })
                            ])
                            ->maxLength(255),

                        Forms\Components\TextInput::make('seo_title')
                            ->required()
                            ->autofocus()
                            ->placeholder('Enter the seo title')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('seo_description')
                            ->required()
                            ->placeholder('Enter the seo description')
                            ->maxLength(255)
                            ->hintActions([
                                Forms\Components\Actions\Action::make('fill_with_gpt')
                                    ->visible(fn (Forms\Get $get) => $get('customer_id'))
                                    ->view('components.fill-with-gpt', [
                                        'field' => 'seo_description',
                                    ]),
                            ]),

                        Forms\Components\Select::make('theme')
                            ->relationship('theme', 'name')
                            ->required()
                            ->placeholder('Select a theme')
                            ->relationship('theme', 'name'),

                        Forms\Components\FileUpload::make('logo')
                            ->acceptedFileTypes(CuratorPicksImageTypes::getImageMimeTypes())
                            ->required(),

                        Forms\Components\FileUpload::make('favicon')
                            ->acceptedFileTypes(CuratorPicksImageTypes::getImageMimeTypes())
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->width(125)
                    ->height('auto'),

                Tables\Columns\TextColumn::make('customer.name')
                    ->badge()
                    ->limit(20)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('domain')
                    ->badge()
                    ->limit(20)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('seo_title')
                    ->limit(20)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('theme.name')
                    ->badge()
                    ->limit(20)
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make('Edit Theme')
                    ->label("Edit Theme")
                    ->disabled(fn (Website $record) => $record->theme === null)
                    ->color(Color::Orange)
                    ->url(function (Website $record) {
                        $theme = $record->theme;

                        if (! $theme) {
                            return null;
                        }

                        $route = match ($record?->theme->template) {
                            "template_1" => "filament.admin.resources.template-ones.edit",
                            "template_2" => "filament.admin.resources.template-twos.edit",
                        };

                        return route(
                            $route,
                            ['record' => $record->id]
                        );
                    }, true),

                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebsites::route('/'),
            'create' => Pages\CreateWebsite::route('/create'),
            'edit' => Pages\EditWebsite::route('/{record}/edit'),
        ];
    }

    /**
     * Validates if the domain provided matches the regex pattern
     *
     * @param string $domain
     * @return bool
     */
    public static function validateDomain(?string $domain) : bool
    {
        if ($domain === "") {
            return false;
        }

        return \Validator::make([
            'domain' => $domain,
        ], [
            'domain' => ['string', 'required', 'regex:' . WhoIsJsonApiChecker::REGEX_PATTERN]
        ])->passes();
    }
}
