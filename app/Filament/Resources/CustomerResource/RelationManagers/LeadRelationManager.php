<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Enums\LeadStatusEnums;
use App\Models\Lead;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;

class LeadRelationManager extends RelationManager
{
    protected static string $relationship = 'lead';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
                //
            ])
            ->headerActions([

            ])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->openUrlInNewTab()
                    ->url(fn (Lead $record) => route('filament.admin.resources.leads.edit', ['record' => $record->id]))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
