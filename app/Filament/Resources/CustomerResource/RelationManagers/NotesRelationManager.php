<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotesRelationManager extends RelationManager
{
    /**
     * The relation manager's relationship
     *
     * @var string
     */
    protected static string $relationship = 'notes';

    /**
     * The resource record title attribute
     *
     * @var string|null
     */
    protected static ?string $recordTitleAttribute = 'title';

    /**
     * The relation manager form
     *
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->placeholder("Enter the title")
                            ->required(),

                        Forms\Components\RichEditor::make('note')
                            ->required()
                            ->placeholder("Enter the Note"),
                    ])
            ]);
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('note')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(40)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('note')
                    ->html()
                    ->limit(40)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->recordTitleAttribute('title'),
                Tables\Actions\DeleteAction::make()->recordTitleAttribute('title'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
