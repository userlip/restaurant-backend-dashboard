<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThemeResource\Pages;
use App\Filament\Resources\ThemeResource\RelationManagers;
use App\Models\Theme;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                            ->blocks([
                                Forms\Components\Builder\Block::make('header')
                                    ->schema([
                                        Forms\Components\Section::make('Header')
                                            ->collapsible()
                                            ->schema([
                                                Forms\Components\FileUpload::make('header_logo')
                                                    ->directory('template-1')
                                                    ->image(),

                                                Forms\Components\TextInput::make('contact_number')
                                                    ->default('+1 232 222 4445 777')
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('operating_hours')
                                                    ->default('Mon - Fri, 09:00 - 18:00')
                                                    ->maxLength(255),

                                                Forms\Components\Repeater::make('nav_links')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('label'),
                                                        Forms\Components\TextInput::make('url'),
                                                    ]),

                                                Forms\Components\Toggle::make('is_search_visible')
                                                    ->default(true)
                                            ]),
                                    ]),

                                Forms\Components\Builder\Block::make('hero_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_visible')
                                            ->label('Visible')
                                            ->hint('If then section is visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Background Image')
                                            ->collapsible()
                                            ->schema([
                                                Forms\Components\Toggle::make('is_bg_image_visible')
                                                    ->label('Visible')
                                                    ->hint('If then background image is visible')
                                                    ->default(true),

                                                Forms\Components\FileUpload::make('background_image')
                                                    ->directory('template-1')
                                                    ->image(),
                                            ]),

                                        Forms\Components\Section::make('Text Content')
                                            ->schema([
                                                Forms\Components\TextInput::make('greeting')
                                                    ->placeholder('Welcome to')
                                                    ->default('Welcome to')
                                                    ->autofocus()
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->placeholder('Restaurant Name')
                                                    ->default('Restaurant Name')
                                                    ->autofocus()
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('subtext')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. \n Felis enim dictumst mauris volutpat in risus enim.'),

                                                Forms\Components\Section::make('Contact Us')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_contact_us_visible'),
                                                        Forms\Components\TextInput::make('contact_us_title'),
                                                        Forms\Components\TextInput::make('contact_us_link'),
                                                    ])
                                            ]),

                                        Forms\Components\Section::make('We Opened')
                                            ->schema([
                                                Forms\Components\TextInput::make('we_opened_text')
                                                    ->default('We Opened'),

                                                Forms\Components\Repeater::make('we_opened_schedule')
                                                    ->maxItems(7)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('day')
                                                            ->label('Day of the Week')
                                                            ->hint('Monday, Tuesday, Wednesday ...'),

                                                        Forms\Components\TextInput::make('operating_hours')
                                                            ->default('12 : 00 - 22 : 30')
                                                    ]),

                                                Forms\Components\Section::make('Weekdays Operations')
                                                    ->label('This is for the mobile responsive version of the restaurant operations')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('weekdays_mobile_day')
                                                            ->label('Day of the Week')
                                                            ->hint('Monday, Tuesday, Wednesday ...'),

                                                        Forms\Components\TextInput::make('weekdays_mobile_operating_hours')
                                                            ->default('12 : 00 - 22 : 30')
                                                    ]),

                                                Forms\Components\Section::make('Weekends Operations')
                                                    ->label('This is for the mobile responsive version of the restaurant operations')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('weekends_mobile_day')
                                                            ->label('Day of the Week')
                                                            ->hint('Saturday, Sunday, Saturday - Sunday'),

                                                        Forms\Components\TextInput::make('weekends_mobile_operating_hours')
                                                            ->default('12 : 00 - 22 : 30')
                                                    ]),
                                            ])
                                    ]),

                                Forms\Components\Builder\Block::make('about_us_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Left Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_left_section_visible')
                                                    ->default(true),

                                                Forms\Components\FileUpload::make('left_image')
                                                    ->hint('9:16 images')
                                                    ->image(),

                                                Forms\Components\FileUpload::make('right_image')
                                                    ->hint('9:16 images')
                                                    ->image(),
                                            ]),

                                        Forms\Components\Section::make('Right Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_right_section_visible')
                                                    ->default(true),

                                                Forms\Components\TextInput::make('section_title')
                                                    ->default('About Us')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->default('About Us')
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('subtext')
                                                    ->maxLength(1000),

                                                Forms\Components\Section::make('Contact Us')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_contact_us_visible'),
                                                        Forms\Components\TextInput::make('contact_us_title'),
                                                        Forms\Components\TextInput::make('contact_us_link'),
                                                    ]),

                                                Forms\Components\Section::make('Learn More')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_learn_more_visible'),
                                                        Forms\Components\TextInput::make('learn_more_title'),
                                                        Forms\Components\TextInput::make('learn_more_link'),
                                                    ])
                                            ]),
                                    ]),

                                Forms\Components\Builder\Block::make('menu_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Left Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_left_section_visible')
                                                    ->default(true),

                                                Forms\Components\TextInput::make('section_title')
                                                    ->default('Menu')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->default('Lorem ipsum dolor')
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('subtext')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
                                                    ->maxLength(1000),

                                                Forms\Components\Section::make('Menu PDF')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_menu_pdf_visible')
                                                            ->default(true),

                                                        Forms\Components\TextInput::make('menu_pdf_title')
                                                            ->default("Menu .PDF"),

                                                        Forms\Components\FileUpload::make('menu_pdf')
                                                            ->hint("File must be a PDF file")
                                                            ->acceptedFileTypes([
                                                                'application/pdf'
                                                            ]),
                                                    ]),
                                            ]),

                                        Forms\Components\Section::make('Right Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_right_section_visible')
                                                    ->default(true),

                                                Forms\Components\TextInput::make('menu_text')
                                                    ->default("Menu"),

                                                Forms\Components\FileUpload::make('menu_picture')
                                                    ->image()
                                            ])
                                    ]),

                                Forms\Components\Builder\Block::make('gallery_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Top Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_top_section_visible')
                                                    ->default(true),

                                                Forms\Components\TextInput::make('section_title')
                                                    ->default('Menu')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->default('Lorem ipsum dolor')
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('subtext')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
                                                    ->maxLength(1000),
                                            ]),

                                        Forms\Components\Section::make('Gallery/Bottom Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_top_section_visible')
                                                    ->default(true),

                                                Forms\Components\TextInput::make('section_title')
                                                    ->default('Gallery')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->default('Lorem ipsum dolor.')
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('subtext')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
                                                    ->maxLength(1000),

                                                Forms\Components\FileUpload::make('gallery')
                                                    ->multiple()
                                                    ->image(),
                                            ]),
                                    ]),

                                Forms\Components\Builder\Block::make('contact_us_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Top Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_top_section_visible')
                                                    ->default(true),

                                                Forms\Components\TextInput::make('section_title')
                                                    ->default('Menu')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->default('Lorem ipsum dolor')
                                                    ->maxLength(255),
                                            ]),
                                    ]),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListThemes::route('/'),
            'create' => Pages\CreateTheme::route('/create'),
            'edit' => Pages\EditTheme::route('/{record}/edit'),
        ];
    }
}
