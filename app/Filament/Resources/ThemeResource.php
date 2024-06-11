<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThemeResource\Pages;
use App\Filament\Resources\ThemeResource\RelationManagers;
use App\Helper\ThemeHelper;
use App\Models\Theme;
use Faker\Provider\Text;
use Filament\Enums\ThemeMode;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\SchemaOrg\SocialEvent;
use function Symfony\Component\Translation\t;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

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
                        Forms\Components\TextInput::make('name')
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Theme')
                            ->default(true),

                        Forms\Components\TextInput::make('template')
                            ->default('template_1')
                            ->required(),

                        Forms\Components\Builder::make('data')
                            ->required()
                            ->reorderable(false)
                            ->deletable(false)
                            ->addable(false)
                            ->blocks([]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('template')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(function (Theme $record) {
                        $route = match ($record->template) {
                            "template_1" => "filament.admin.resources.template-ones.edit",
                            "template_2" => "filament.admin.resources.template-twos.edit",
                        };

                        return route(
                            $route,
                            ['record' => $record->id]
                        );
                    }, true),

                Tables\Actions\Action::make('set_active')
                    ->color(Color::Orange)
                    ->icon('heroicon-o-check-circle')
                    ->disabled(fn (Theme $record) => $record->is_active)
                    ->action(function (Theme $record) {
                        Theme::whereNot('id', $record->id)->get()->each(function (Theme $theme) {
                            $theme->update([
                                "is_active" => false
                            ]);
                        });

                        $record->update([
                            'is_active' => true
                        ]);
                    })
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
            'index' => Pages\ListThemes::route('/'),
            'create' => Pages\CreateTheme::route('/create'),
            'edit' => Pages\EditTheme::route('/{record}/edit'),
        ];
    }
}
