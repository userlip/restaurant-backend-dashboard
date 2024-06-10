<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThemeResource\Pages;
use App\Filament\Resources\ThemeResource\RelationManagers;
use App\Models\Theme;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\SchemaOrg\SocialEvent;

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
                                                Forms\Components\Toggle::make('is_header_visible')
                                                    ->default(true),

                                                Forms\Components\FileUpload::make('header_logo')
                                                    ->directory('template-2')
                                                    ->image(),

                                                Forms\Components\TextInput::make('restaurant_name')
                                                    ->default(config('app.name')),

                                                Forms\Components\Repeater::make('nav_links')
                                                    ->maxItems(5)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('label'),
                                                        Forms\Components\TextInput::make('url'),
                                                    ]),

                                                Forms\Components\Section::make('Call Us')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('call_us_address')
                                                            ->default('10408 Madison Street, Fort Lilly 19797-5951')
                                                            ->maxLength(255),

                                                        Forms\Components\TextInput::make('call_us_contact_number')
                                                            ->default('+1 232 222 4445 777')
                                                            ->maxLength(255),

                                                        Forms\Components\RichEditor::make('call_us_operating_hours')
                                                            ->default('Mon - Fri, 09:00 - 18:00')
                                                            ->maxLength(255),
                                                    ]),

                                                Forms\Components\Section::make('Operating Hours')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('weekday_operating_days')
                                                            ->default('Mon - Fri')
                                                            ->maxLength(255),

                                                        Forms\Components\RichEditor::make('weekday_operating_hours')
                                                            ->default('10:00 - 23:00')
                                                            ->maxLength(255),

                                                        Forms\Components\TextInput::make('weekend_operating_days')
                                                            ->default('Weekend')
                                                            ->maxLength(255),

                                                        Forms\Components\RichEditor::make('weekend_operating_hours')
                                                            ->default('10:00 - 23:00')
                                                            ->maxLength(255),
                                                    ]),

                                                Forms\Components\Section::make('Call to Action')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('cta_label')
                                                            ->maxLength(255)
                                                            ->default("Book a Table"),

                                                        Forms\Components\TextInput::make('cta_link')
                                                            ->default("#"),
                                                    ])
                                            ]),
                                    ]),

                                Forms\Components\Builder\Block::make('hero_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_visible')
                                            ->label('Visible')
                                            ->hint('If then section is visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Text Content')
                                            ->schema([
                                                Forms\Components\TextInput::make('section_title')
                                                    ->placeholder('Best Food For You')
                                                    ->default('Best Food For You')
                                                    ->autofocus()
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->placeholder('Restaurant Name')
                                                    ->default(config('app.name'))
                                                    ->autofocus()
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('subtext')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Felis enim dictumst mauris volutpat in risus enim.'),

                                                Forms\Components\Section::make('Our Menu')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_our_menu_visible')
                                                            ->default(true),
                                                        Forms\Components\TextInput::make('our_menu_title')
                                                            ->default("Our Menu"),
                                                        Forms\Components\TextInput::make('our_menu_link')
                                                            ->default("#menu"),
                                                    ]),

                                                Forms\Components\Section::make('Socials')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('facebook')
                                                            ->hint("If you want it to be invisible, leave it as blank")
                                                            ->url()
                                                            ->default("https://www.facebook.com"),

                                                        Forms\Components\TextInput::make('x')
                                                            ->hint("If you want it to be invisible, leave it as blank")
                                                            ->label("X/Twitter")
                                                            ->url()
                                                            ->default("https://www.x.com"),

                                                        Forms\Components\TextInput::make('instagram')
                                                            ->hint("If you want it to be invisible, leave it as blank")
                                                            ->url()
                                                            ->default("https://www.instagram.com"),

                                                        Forms\Components\TextInput::make('linkedin')
                                                            ->hint("If you want it to be invisible, leave it as blank")
                                                            ->url()
                                                            ->default("https://www.linkedin.com"),
                                                    ])
                                            ]),
                                    ]),

                                Forms\Components\Builder\Block::make('about_us_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Left Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_left_section_visible')
                                                    ->default(true),

                                                Forms\Components\TextInput::make('section_title')
                                                    ->default('About Us')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->default('Welcome To')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header_red_text')
                                                    ->default(config('app.name'))
                                                    ->maxLength(255),

                                                Forms\Components\Textarea::make('subtext_left')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                                    ->maxLength(1000),

                                                Forms\Components\Textarea::make('subtext_right')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                                    ->maxLength(1000),

                                                Forms\Components\Section::make('Our Menu')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_our_menu_visible')
                                                            ->default(true),
                                                        Forms\Components\TextInput::make('our_menu_title')
                                                            ->default("Our Menu"),
                                                        Forms\Components\TextInput::make('our_menu_link')
                                                            ->default("#menu"),
                                                    ]),
                                            ]),

                                        Forms\Components\Section::make('Right Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_right_section_visible')
                                                    ->default(true),

                                                Forms\Components\FileUpload::make('background_image')
                                                    ->directory('template-2')
                                                    ->image(),
                                            ]),
                                    ]),

//                                Forms\Components\Builder\Block::make('menu_section')
//                                    ->schema([
//                                        Forms\Components\Toggle::make('is_section_visible')
//                                            ->default(true),
//
//                                        Forms\Components\Section::make('Left Section')
//                                            ->schema([
//                                                Forms\Components\Toggle::make('is_left_section_visible')
//                                                    ->default(true),
//
//                                                Forms\Components\TextInput::make('section_title')
//                                                    ->default('Menu')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\TextInput::make('header')
//                                                    ->default('Lorem ipsum dolor')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\RichEditor::make('subtext')
//                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
//                                                    ->maxLength(1000),
//
//                                                Forms\Components\Section::make('Menu PDF')
//                                                    ->schema([
//                                                        Forms\Components\Toggle::make('is_menu_pdf_visible')
//                                                            ->default(true),
//
//                                                        Forms\Components\TextInput::make('menu_pdf_title')
//                                                            ->default("Menu .PDF"),
//
//                                                        Forms\Components\FileUpload::make('menu_pdf')
//                                                            ->directory('template-1')
//                                                            ->hint("File must be a PDF file")
//                                                            ->acceptedFileTypes([
//                                                                'application/pdf'
//                                                            ]),
//                                                    ]),
//                                            ]),
//
//                                        Forms\Components\Section::make('Right Section')
//                                            ->schema([
//                                                Forms\Components\Toggle::make('is_right_section_visible')
//                                                    ->default(true),
//
//                                                Forms\Components\TextInput::make('menu_text')
//                                                    ->default("Menu"),
//
//                                                Forms\Components\FileUpload::make('menu_picture')
//                                                    ->directory('template-1')
//                                                    ->image()
//                                            ])
//                                    ]),
//
//                                Forms\Components\Builder\Block::make('gallery_section')
//                                    ->schema([
//                                        Forms\Components\Toggle::make('is_section_visible')
//                                            ->default(true),
//
//                                        Forms\Components\Section::make('Top Section')
//                                            ->schema([
//                                                Forms\Components\Toggle::make('is_top_section_visible')
//                                                    ->default(true),
//
//                                                Forms\Components\TextInput::make('section_title')
//                                                    ->default('Menu')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\TextInput::make('header')
//                                                    ->default('Lorem ipsum dolor')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\RichEditor::make('subtext')
//                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
//                                                    ->maxLength(1000),
//                                            ]),
//
//                                        Forms\Components\Section::make('Gallery/Bottom Section')
//                                            ->schema([
//                                                Forms\Components\Toggle::make('is_top_section_visible')
//                                                    ->default(true),
//
//                                                Forms\Components\TextInput::make('section_title')
//                                                    ->default('Gallery')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\TextInput::make('header')
//                                                    ->default('Lorem ipsum dolor.')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\RichEditor::make('subtext')
//                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
//                                                    ->maxLength(1000),
//
//                                                Forms\Components\FileUpload::make('gallery')
//                                                    ->directory('template-1')
//                                                    ->multiple()
//                                                    ->image(),
//                                            ]),
//                                    ]),
//
//                                Forms\Components\Builder\Block::make('contact_us_section')
//                                    ->schema([
//                                        Forms\Components\Toggle::make('is_section_visible')
//                                            ->default(true),
//
//                                        Forms\Components\Section::make('Top Section')
//                                            ->schema([
//                                                Forms\Components\Toggle::make('is_top_section_visible')
//                                                    ->default(true),
//
//                                                Forms\Components\TextInput::make('section_title')
//                                                    ->default('Menu')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\TextInput::make('header')
//                                                    ->default('Lorem ipsum dolor')
//                                                    ->maxLength(255),
//                                            ]),
//                                    ]),
//
////                                Forms\Components\Builder\Block::make('google_maps_section')
////                                    ->schema([
////                                        Forms\Components\Toggle::make('is_section_visible')
////                                            ->default(true),
////
////                                        Forms\Components\Section::make()
////                                            ->schema([
////                                                Forms\Components\FileUpload::make('map_image')
////                                                    ->directory('template-1')
////                                                    ->live()
////                                                    ->image(),
////
////                                                Forms\Components\TextInput::make('address')
////                                                    ->default('10408 Madison Street, Fort Lilly 19797-5951')
////                                                    ->maxLength(255),
////
////                                                Forms\Components\RichEditor::make('weekday_operating_hours')
////                                                    ->default('Mon. - Fri. : 09:00 - 23:00')
////                                                    ->maxLength(255),
////
////                                                Forms\Components\RichEditor::make('weekend_operating_hours')
////                                                    ->default('Weekend : 09:00 - 23:00')
////                                                    ->maxLength(255),
////                                            ])
////                                    ]),
//
//                                Forms\Components\Builder\Block::make('footer_section')
//                                    ->schema([
//                                        Forms\Components\Toggle::make('is_section_visible')
//                                            ->default(true),
//
//                                        Forms\Components\Section::make('Left Section')
//                                            ->schema([
//                                                Forms\Components\Toggle::make('is_left_section_visible')
//                                                    ->default(true),
//
//                                                Forms\Components\FileUpload::make('logo')
//                                                    ->directory('template-1')
//                                                    ->image(),
//
//                                                Forms\Components\RichEditor::make('subtext')
//                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate.')
//                                                    ->maxLength(255),
//
//                                                Forms\Components\Repeater::make('links')
//                                                    ->schema([
//                                                        Forms\Components\TextInput::make('label')
//                                                            ->maxLength(255)
//                                                            ->required(),
//
//                                                        Forms\Components\TextInput::make('link')
//                                                            ->maxLength(255)
//                                                            ->required(),
//                                                    ])
//                                            ]),
//
//                                        Forms\Components\Section::make('Right Section')
//                                            ->schema([
//                                                Forms\Components\Toggle::make('is_right_section_visible')
//                                                    ->default(true),
//
//                                                Forms\Components\TextInput::make('call_us')
//                                                    ->default('Call us'),
//
//                                                Forms\Components\TextInput::make('phone_number')
//                                                    ->default('+1 232 222 4445 777'),
//
//                                                Forms\Components\RichEditor::make('operation_hours')
//                                                    ->default('Mon. - Fri. : 09:00 - 23:00'),
//
//                                                Forms\Components\Section::make('Socials')
//                                                    ->schema([
//                                                        Forms\Components\TextInput::make('facebook')
//                                                            ->hint('Make this empty to make this social icon invisible')
//                                                            ->url()
//                                                            ->default('www.facebook.com'),
//
//                                                        Forms\Components\TextInput::make('twitter')
//                                                            ->hint('Make this empty to make this social icon invisible')
//                                                            ->url()
//                                                            ->default('www.x.com'),
//
//                                                        Forms\Components\TextInput::make('instagram')
//                                                            ->hint('Make this empty to make this social icon invisible')
//                                                            ->url()
//                                                            ->default('www.instagram.com'),
//
//                                                        Forms\Components\TextInput::make('linkedin')
//                                                            ->hint('Make this empty to make this social icon invisible')
//                                                            ->url()
//                                                            ->default('www.instagram.com'),
//                                                    ])
//                                            ]),
//                                    ]),
                            ]),
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
