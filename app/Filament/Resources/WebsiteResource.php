<?php

namespace App\Filament\Resources;

use App\Enums\CuratorPicksImageTypes;
use App\Enums\WebsiteThemesEnums;
use App\Filament\Resources\WebsiteResource\Pages;
use App\Filament\Resources\WebsiteResource\RelationManagers;
use App\Models\Website;
use App\Trait\ResourceModelCountNavigationBadge;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                            ->searchable('name')
                            ->required(),

                        Forms\Components\TextInput::make('seo_title')
                            ->required()
                            ->autofocus()
                            ->placeholder('Enter the seo title')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('seo_description')
                            ->required()
                            ->placeholder('Enter the seo description')
                            ->maxLength(255),

                        Forms\Components\Select::make('theme')
                            ->required()
                            ->placeholder('Select a theme')
                            ->options(WebsiteThemesEnums::getKeyValuePairs()),

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
            ->query(static::getModel()::latest('id'))
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->height(50),

                Tables\Columns\TextColumn::make('customer.name')
                    ->badge()
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('seo_title')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('seo_description')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('theme')
                    ->badge()
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('favicon')
                    ->height(50),
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
}
