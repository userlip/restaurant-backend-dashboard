<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TemplateTwoResource\Pages;
use App\Filament\Resources\TemplateTwoResource\RelationManagers;
use App\Models\TemplateTwo;
use App\Models\Theme;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TemplateTwoResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    protected static bool $shouldRegisterNavigation = false;

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

                                Forms\Components\Builder\Block::make('our_story_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Left Section')
                                            ->schema([
                                                Forms\Components\Toggle::make('is_left_section_visible')
                                                    ->default(true),

                                                Forms\Components\FileUpload::make('background_image')
                                                    ->directory('template-2')
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
                                                    ->default('OUR STORY')
                                                    ->maxLength(255),

                                                Forms\Components\Textarea::make('subtext_left')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                                    ->maxLength(1000),

                                                Forms\Components\Textarea::make('subtext_right')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                                    ->maxLength(1000),

                                                Forms\Components\Section::make('Book a Table')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_book_a_table_visible')
                                                            ->default(true),
                                                        Forms\Components\TextInput::make('book_a_table_title')
                                                            ->default("Book a Table"),
                                                        Forms\Components\TextInput::make('book_a_table_link')
                                                            ->default("#"),
                                                    ]),

                                                Forms\Components\Section::make('Learn More')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_learn_more_visible')
                                                            ->default(true),
                                                        Forms\Components\TextInput::make('learn_more_title')
                                                            ->default("Learn More"),
                                                        Forms\Components\TextInput::make('learn_more_link')
                                                            ->default("#"),
                                                    ]),
                                            ]),
                                    ]),

                                Forms\Components\Builder\Block::make('our_menu_section')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Content')
                                            ->schema([
                                                Forms\Components\TextInput::make('section_title')
                                                    ->default('Explore')
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make('header')
                                                    ->default('OUR STORY')
                                                    ->maxLength(255),

                                                Forms\Components\FileUpload::make('menu_picture')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->directory('template-2'),

                                                Forms\Components\Section::make('Download Menu')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('download_menu_label')
                                                            ->default("Download Menu (PDF)"),

                                                        Forms\Components\FileUpload::make('menu_file'),
                                                    ])
                                            ]),
                                    ]),

                                Block::make('contact_us_section')
                                    ->schema([
                                        Toggle::make('is_section_visible')
                                            ->default(true),

                                        Section::make('Top Section')
                                            ->schema([
                                                Toggle::make('is_top_section_visible')
                                                    ->default(true),

                                                TextInput::make('section_title')
                                                    ->default('Contacts')
                                                    ->maxLength(255),

                                                TextInput::make('contact_us')
                                                    ->default('Lorem ipsum dolor')
                                                    ->maxLength(255),

                                                Forms\Components\Textarea::make('subtext')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.'),

                                                TextInput::make('sent_button_label')
                                                    ->default('Sent')
                                                    ->maxLength(255),

                                                Forms\Components\Textarea::make('bottom_text')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.'),
                                            ]),
                                    ]),

                                Block::make('footer_section')
                                    ->schema([
                                        Toggle::make('is_section_visible')
                                            ->default(true),

                                        Forms\Components\Section::make('Call Us')
                                            ->schema([
                                                Forms\Components\TextInput::make('call_us_contact_number')
                                                    ->default('+1 232 222 4445 777')
                                                    ->maxLength(255),

                                                Forms\Components\RichEditor::make('call_us_operating_hours')
                                                    ->default('Mon - Fri, 09:00 - 18:00')
                                                    ->maxLength(255),
                                            ]),

                                        Forms\Components\Section::make('Call Us')
                                            ->schema([
                                                Forms\Components\FileUpload::make('footer_logo')
                                                    ->directory('template-2')
                                                    ->image()
                                                    ->imageEditor(),

                                                Forms\Components\TextInput::make('restaurant_name')
                                                    ->default(config('app.name'))
                                                    ->maxLength(255),

                                                Forms\Components\Repeater::make('nav_links')
                                                    ->maxItems(5)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('label'),
                                                        Forms\Components\TextInput::make('url'),
                                                    ]),

                                                Forms\Components\Textarea::make('bottom_text')
                                                    ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.'),
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
            'index' => Pages\ListTemplateTwos::route('/'),
            'create' => Pages\CreateTemplateTwo::route('/create'),
            'edit' => Pages\EditTemplateTwo::route('/{record}/edit'),
        ];
    }
}
