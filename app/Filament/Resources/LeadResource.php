<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Filament\Resources\LeadResource\RelationManagers;
use App\Models\Lead;
use App\Trait\ResourceModelCountNavigationBadge;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->limit(30)
                    ->url(fn (Lead $record) => $record->link)
                    ->color(Color::Blue)
                    ->openUrlInNewTab()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
            'search-leads' => Pages\SearchLeadsPage::route('/search'),
        ];
    }
}
