<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactUsMessageResource\Pages;
use App\Filament\Resources\ContactUsMessageResource\RelationManagers;
use App\Models\ContactUsMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\View;

class ContactUsMessageResource extends Resource
{
    protected static ?string $model = ContactUsMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('full_name'),
                        Forms\Components\TextInput::make('phone_number'),
                        Forms\Components\Textarea::make('message'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListContactUsMessages::route('/'),
            'create' => Pages\CreateContactUsMessage::route('/create'),
            'edit' => Pages\EditContactUsMessage::route('/{record}/edit'),
        ];
    }
}
