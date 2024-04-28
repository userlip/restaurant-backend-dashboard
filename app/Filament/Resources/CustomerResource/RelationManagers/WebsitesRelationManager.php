<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Enums\CuratorPicksImageTypes;
use App\Enums\WebsiteThemesEnums;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebsitesRelationManager extends RelationManager
{
    /**
     * The relation manager relationship
     *
     * @var string
     */
    protected static string $relationship = 'websites';

    /**
     * The record title attribute for the relation manager
     *
     * @var string|null
     */
    protected static ?string $recordTitleAttribute = "seo_title";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->required()
                            ->autofocus()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('seo_description')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('theme')
                            ->required()
                            ->options(WebsiteThemesEnums::getKeyValuePairs()),

                        CuratorPicker::make('logo')
                            ->acceptedFileTypes(CuratorPicksImageTypes::getImageMimeTypes())
                            ->constrained()
                            ->required(),

                        CuratorPicker::make('favicon')
                            ->acceptedFileTypes(CuratorPicksImageTypes::getImageMimeTypes())
                            ->constrained()
                            ->required(),
                    ])
            ]);
    }

    /**
     * The table of the relation manager
     *
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('seo_title')
            ->columns([
                CuratorColumn::make('logo')
                    ->height(50),

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

                CuratorColumn::make('favicon')
                    ->height(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
