<?php

namespace App\Helper;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ThemeHelper
{
    public static function templateOneBuilderBlocks(): array
    {
        return [
            Block::make('header')
                ->schema([
                    Section::make('Header')
                        ->collapsible()
                        ->schema([
                            FileUpload::make('header_logo')
                                ->directory('template-1')
                                ->image(),

                            Section::make('Call Us')
                                ->schema([
                                    TextInput::make('call_us_label')
                                        ->default('Call Us')
                                        ->maxLength(255),

                                    TextInput::make('call_us_contact_number')
                                        ->default('+1 232 222 4445 777')
                                        ->maxLength(255),

                                    RichEditor::make('call_us_operating_hours')
                                        ->default('Mon - Fri, 09:00 - 18:00')
                                        ->maxLength(255),
                                ]),

                            Section::make('Visit Us')
                                ->schema([
                                    TextInput::make('visit_us_label')
                                        ->default('Call Us')
                                        ->maxLength(255),

                                    TextInput::make('visit_us_contact_number')
                                        ->default('+1 232 222 4445 777')
                                        ->maxLength(255),

                                    RichEditor::make('visit_us_operating_hours')
                                        ->default('Mon - Fri, 09:00 - 18:00')
                                        ->maxLength(255),
                                ]),

                            Repeater::make('nav_links')
                                ->schema([
                                    TextInput::make('label'),
                                    TextInput::make('url'),
                                ]),

                            Toggle::make('is_search_visible')
                                ->default(true)
                        ]),
                ]),

            Block::make('hero_section')
                ->schema([
                    Toggle::make('is_visible')
                        ->label('Visible')
                        ->hint('If then section is visible')
                        ->default(true),

                    Section::make('Background Image')
                        ->collapsible()
                        ->schema([
                            Toggle::make('is_bg_image_visible')
                                ->label('Visible')
                                ->hint('If then background image is visible')
                                ->default(true),

                            FileUpload::make('background_image')
                                ->directory('template-1')
                                ->image(),
                        ]),

                    Section::make('Text Content')
                        ->schema([
                            TextInput::make('greeting')
                                ->placeholder('Welcome to')
                                ->default('Welcome to')
                                ->autofocus()
                                ->maxLength(255),

                            TextInput::make('header')
                                ->placeholder('Restaurant Name')
                                ->default('Restaurant Name')
                                ->autofocus()
                                ->maxLength(255),

                            RichEditor::make('subtext')
                                ->default('Lorem ipsum dolor sit amet consectetur. \n Felis enim dictumst mauris volutpat in risus enim.'),

                            Section::make('Contact Us')
                                ->schema([
                                    Toggle::make('is_contact_us_visible'),
                                    TextInput::make('contact_us_title'),
                                    TextInput::make('contact_us_link'),
                                ])
                        ]),

                    Section::make('We Opened')
                        ->schema([
                            TextInput::make('we_opened_text')
                                ->default('We Opened'),

                            Repeater::make('we_opened_schedule')
                                ->maxItems(7)
                                ->schema([
                                    TextInput::make('day')
                                        ->label('Day of the Week')
                                        ->hint('Monday, Tuesday, Wednesday ...'),

                                    TextInput::make('operating_hours')
                                        ->default('12 : 00 - 22 : 30')
                                ]),

                            Section::make('Weekdays Operations')
                                ->label('This is for the mobile responsive version of the restaurant operations')
                                ->schema([
                                    TextInput::make('weekdays_mobile_day')
                                        ->label('Day of the Week')
                                        ->hint('Monday, Tuesday, Wednesday ...'),

                                    TextInput::make('weekdays_mobile_operating_hours')
                                        ->default('12 : 00 - 22 : 30')
                                ]),

                            Section::make('Weekends Operations')
                                ->label('This is for the mobile responsive version of the restaurant operations')
                                ->schema([
                                    TextInput::make('weekends_mobile_day')
                                        ->label('Day of the Week')
                                        ->hint('Saturday, Sunday, Saturday - Sunday'),

                                    TextInput::make('weekends_mobile_operating_hours')
                                        ->default('12 : 00 - 22 : 30')
                                ]),
                        ])
                ]),

            Block::make('about_us_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Left Section')
                        ->schema([
                            Toggle::make('is_left_section_visible')
                                ->default(true),

                            FileUpload::make('left_image')
                                ->directory('template-1')
                                ->hint('9:16 images')
                                ->image(),

                            FileUpload::make('right_image')
                                ->directory('template-1')
                                ->hint('9:16 images')
                                ->image(),
                        ]),

                    Section::make('Right Section')
                        ->schema([
                            Toggle::make('is_right_section_visible')
                                ->default(true),

                            TextInput::make('section_title')
                                ->default('About Us')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('About Us')
                                ->maxLength(255),

                            RichEditor::make('subtext')
                                ->maxLength(1000),

                            Section::make('Contact Us')
                                ->schema([
                                    Toggle::make('is_contact_us_visible'),
                                    TextInput::make('contact_us_title'),
                                    TextInput::make('contact_us_link'),
                                ]),

                            Section::make('Learn More')
                                ->schema([
                                    Toggle::make('is_learn_more_visible'),
                                    TextInput::make('learn_more_title'),
                                    TextInput::make('learn_more_link'),
                                ])
                        ]),
                ]),

            Block::make('menu_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Left Section')
                        ->schema([
                            Toggle::make('is_left_section_visible')
                                ->default(true),

                            TextInput::make('section_title')
                                ->default('Menu')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('Lorem ipsum dolor')
                                ->maxLength(255),

                            RichEditor::make('subtext')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
                                ->maxLength(1000),

                            Section::make('Menu PDF')
                                ->schema([
                                    Toggle::make('is_menu_pdf_visible')
                                        ->default(true),

                                    TextInput::make('menu_pdf_title')
                                        ->default("Menu .PDF"),

                                    FileUpload::make('menu_pdf')
                                        ->directory('template-1')
                                        ->hint("File must be a PDF file")
                                        ->acceptedFileTypes([
                                            'application/pdf'
                                        ]),
                                ]),
                        ]),

                    Section::make('Right Section')
                        ->schema([
                            Toggle::make('is_right_section_visible')
                                ->default(true),

                            TextInput::make('menu_text')
                                ->default("Menu"),

                            FileUpload::make('menu_picture')
                                ->directory('template-1')
                                ->image()
                        ])
                ]),

            Block::make('gallery_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Top Section')
                        ->schema([
                            Toggle::make('is_top_section_visible')
                                ->default(true),

                            TextInput::make('section_title')
                                ->default('Menu')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('Lorem ipsum dolor')
                                ->maxLength(255),

                            RichEditor::make('subtext')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
                                ->maxLength(1000),
                        ]),

                    Section::make('Gallery/Bottom Section')
                        ->schema([
                            Toggle::make('is_top_section_visible')
                                ->default(true),

                            TextInput::make('section_title')
                                ->default('Gallery')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('Lorem ipsum dolor.')
                                ->maxLength(255),

                            RichEditor::make('subtext')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.')
                                ->maxLength(1000),

                            FileUpload::make('gallery')
                                ->directory('template-1')
                                ->multiple()
                                ->image(),
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
                                ->default('Menu')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('Lorem ipsum dolor')
                                ->maxLength(255),
                        ]),
                ]),

//                                Block::make('google_maps_section')
//                                    ->schema([
//                                        Toggle::make('is_section_visible')
//                                            ->default(true),
//
//                                        Section::make()
//                                            ->schema([
//                                                FileUpload::make('map_image')
//                                                    ->directory('template-1')
//                                                    ->live()
//                                                    ->image(),
//
//                                                TextInput::make('address')
//                                                    ->default('10408 Madison Street, Fort Lilly 19797-5951')
//                                                    ->maxLength(255),
//
//                                                RichEditor::make('weekday_operating_hours')
//                                                    ->default('Mon. - Fri. : 09:00 - 23:00')
//                                                    ->maxLength(255),
//
//                                                RichEditor::make('weekend_operating_hours')
//                                                    ->default('Weekend : 09:00 - 23:00')
//                                                    ->maxLength(255),
//                                            ])
//                                    ]),

            Block::make('footer_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Left Section')
                        ->schema([
                            Toggle::make('is_left_section_visible')
                                ->default(true),

                            FileUpload::make('logo')
                                ->directory('template-1')
                                ->image(),

                            RichEditor::make('subtext')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate.')
                                ->maxLength(255),

                            Repeater::make('links')
                                ->schema([
                                    TextInput::make('label')
                                        ->maxLength(255)
                                        ->required(),

                                    TextInput::make('link')
                                        ->maxLength(255)
                                        ->required(),
                                ])
                        ]),

                    Section::make('Right Section')
                        ->schema([
                            Toggle::make('is_right_section_visible')
                                ->default(true),

                            TextInput::make('call_us')
                                ->default('Call us'),

                            TextInput::make('phone_number')
                                ->default('+1 232 222 4445 777'),

                            RichEditor::make('operation_hours')
                                ->default('Mon. - Fri. : 09:00 - 23:00'),

                            Section::make('Socials')
                                ->schema([
                                    TextInput::make('facebook')
                                        ->hint('Make this empty to make this social icon invisible')
                                        ->url()
                                        ->default('www.facebook.com'),

                                    TextInput::make('twitter')
                                        ->hint('Make this empty to make this social icon invisible')
                                        ->url()
                                        ->default('www.x.com'),

                                    TextInput::make('instagram')
                                        ->hint('Make this empty to make this social icon invisible')
                                        ->url()
                                        ->default('www.instagram.com'),

                                    TextInput::make('linkedin')
                                        ->hint('Make this empty to make this social icon invisible')
                                        ->url()
                                        ->default('www.instagram.com'),
                                ])
                        ]),
                ]),
        ];
    }

    public static function templateTwoBuilderBlocks()
    {
        return [
            Block::make('header')
                ->schema([
                    Section::make('Header')
                        ->collapsible()
                        ->schema([
                            Toggle::make('is_header_visible')
                                ->default(true),

                            FileUpload::make('header_logo')
                                ->directory('template-2')
                                ->image(),

                            TextInput::make('restaurant_name')
                                ->default(config('app.name')),

                            Repeater::make('nav_links')
                                ->maxItems(5)
                                ->schema([
                                    TextInput::make('label'),
                                    TextInput::make('url'),
                                ]),

                            Section::make('Call Us')
                                ->schema([
                                    TextInput::make('call_us_address')
                                        ->default('10408 Madison Street, Fort Lilly 19797-5951')
                                        ->maxLength(255),

                                    TextInput::make('call_us_contact_number')
                                        ->default('+1 232 222 4445 777')
                                        ->maxLength(255),

                                    RichEditor::make('call_us_operating_hours')
                                        ->default('Mon - Fri, 09:00 - 18:00')
                                        ->maxLength(255),
                                ]),

                            Section::make('Operating Hours')
                                ->schema([
                                    TextInput::make('weekday_operating_days')
                                        ->default('Mon - Fri')
                                        ->maxLength(255),

                                    RichEditor::make('weekday_operating_hours')
                                        ->default('10:00 - 23:00')
                                        ->maxLength(255),

                                    TextInput::make('weekend_operating_days')
                                        ->default('Weekend')
                                        ->maxLength(255),

                                    RichEditor::make('weekend_operating_hours')
                                        ->default('10:00 - 23:00')
                                        ->maxLength(255),
                                ]),

                            Section::make('Call to Action')
                                ->schema([
                                    TextInput::make('cta_label')
                                        ->maxLength(255)
                                        ->default("Book a Table"),

                                    TextInput::make('cta_link')
                                        ->default("#"),
                                ])
                        ]),
                ]),

            Block::make('hero_section')
                ->schema([
                    Toggle::make('is_visible')
                        ->label('Visible')
                        ->hint('If then section is visible')
                        ->default(true),

                    Section::make('Text Content')
                        ->schema([
                            TextInput::make('section_title')
                                ->placeholder('Best Food For You')
                                ->default('Best Food For You')
                                ->autofocus()
                                ->maxLength(255),

                            TextInput::make('header')
                                ->placeholder('Restaurant Name')
                                ->default(config('app.name'))
                                ->autofocus()
                                ->maxLength(255),

                            RichEditor::make('subtext')
                                ->default('Lorem ipsum dolor sit amet consectetur. Felis enim dictumst mauris volutpat in risus enim.'),

                            Section::make('Our Menu')
                                ->schema([
                                    Toggle::make('is_our_menu_visible')
                                        ->default(true),
                                    TextInput::make('our_menu_title')
                                        ->default("Our Menu"),
                                    TextInput::make('our_menu_link')
                                        ->default("#menu"),
                                ]),

                            Section::make('Socials')
                                ->schema([
                                    TextInput::make('facebook')
                                        ->hint("If you want it to be invisible, leave it as blank")
                                        ->url()
                                        ->default("https://www.facebook.com"),

                                    TextInput::make('x')
                                        ->hint("If you want it to be invisible, leave it as blank")
                                        ->label("X/Twitter")
                                        ->url()
                                        ->default("https://www.x.com"),

                                    TextInput::make('instagram')
                                        ->hint("If you want it to be invisible, leave it as blank")
                                        ->url()
                                        ->default("https://www.instagram.com"),

                                    TextInput::make('linkedin')
                                        ->hint("If you want it to be invisible, leave it as blank")
                                        ->url()
                                        ->default("https://www.linkedin.com"),
                                ])
                        ]),
                ]),

            Block::make('about_us_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Left Section')
                        ->schema([
                            Toggle::make('is_left_section_visible')
                                ->default(true),

                            TextInput::make('section_title')
                                ->default('About Us')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('Welcome To')
                                ->maxLength(255),

                            TextInput::make('header_red_text')
                                ->default(config('app.name'))
                                ->maxLength(255),

                            Textarea::make('subtext_left')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                ->maxLength(1000),

                            Textarea::make('subtext_right')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                ->maxLength(1000),

                            Section::make('Our Menu')
                                ->schema([
                                    Toggle::make('is_our_menu_visible')
                                        ->default(true),
                                    TextInput::make('our_menu_title')
                                        ->default("Our Menu"),
                                    TextInput::make('our_menu_link')
                                        ->default("#menu"),
                                ]),
                        ]),

                    Section::make('Right Section')
                        ->schema([
                            Toggle::make('is_right_section_visible')
                                ->default(true),

                            FileUpload::make('background_image')
                                ->directory('template-2')
                                ->image(),
                        ]),
                ]),

            Block::make('our_story_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Left Section')
                        ->schema([
                            Toggle::make('is_left_section_visible')
                                ->default(true),

                            FileUpload::make('background_image')
                                ->directory('template-2')
                                ->image(),
                        ]),

                    Section::make('Right Section')
                        ->schema([
                            Toggle::make('is_right_section_visible')
                                ->default(true),

                            TextInput::make('section_title')
                                ->default('About Us')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('OUR STORY')
                                ->maxLength(255),

                            Textarea::make('subtext_left')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                ->maxLength(1000),

                            Textarea::make('subtext_right')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat. Sed dui vestibulum posuere massa vulputate. Enim volutpat amet enim venenatis pharetra. Eget accumsan massa amet faucibus.')
                                ->maxLength(1000),

                            Section::make('Book a Table')
                                ->schema([
                                    Toggle::make('is_book_a_table_visible')
                                        ->default(true),
                                    TextInput::make('book_a_table_title')
                                        ->default("Book a Table"),
                                    TextInput::make('book_a_table_link')
                                        ->default("#"),
                                ]),

                            Section::make('Learn More')
                                ->schema([
                                    Toggle::make('is_learn_more_visible')
                                        ->default(true),
                                    TextInput::make('learn_more_title')
                                        ->default("Learn More"),
                                    TextInput::make('learn_more_link')
                                        ->default("#"),
                                ]),
                        ]),
                ]),

            Block::make('our_menu_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Content')
                        ->schema([
                            TextInput::make('section_title')
                                ->default('Explore')
                                ->maxLength(255),

                            TextInput::make('header')
                                ->default('OUR STORY')
                                ->maxLength(255),

                            FileUpload::make('menu_picture')
                                ->image()
                                ->imageEditor()
                                ->directory('template-2'),

                            Section::make('Download Menu')
                                ->schema([
                                    TextInput::make('download_menu_label')
                                        ->default("Download Menu (PDF)"),

                                    FileUpload::make('menu_file'),
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

                            Textarea::make('subtext')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.'),

                            TextInput::make('sent_button_label')
                                ->default('Sent')
                                ->maxLength(255),

                            Textarea::make('bottom_text')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.'),
                        ]),
                ]),

            Block::make('footer_section')
                ->schema([
                    Toggle::make('is_section_visible')
                        ->default(true),

                    Section::make('Call Us')
                        ->schema([
                            TextInput::make('call_us_contact_number')
                                ->default('+1 232 222 4445 777')
                                ->maxLength(255),

                            RichEditor::make('call_us_operating_hours')
                                ->default('Mon - Fri, 09:00 - 18:00')
                                ->maxLength(255),
                        ]),

                    Section::make('Call Us')
                        ->schema([
                            FileUpload::make('footer_logo')
                                ->directory('template-2')
                                ->image()
                                ->imageEditor(),

                            TextInput::make('restaurant_name')
                                ->default(config('app.name'))
                                ->maxLength(255),

                            Repeater::make('nav_links')
                                ->maxItems(5)
                                ->schema([
                                    TextInput::make('label'),
                                    TextInput::make('url'),
                                ]),

                            Textarea::make('bottom_text')
                                ->default('Lorem ipsum dolor sit amet consectetur. Gravida accumsan accumsan et lectus ipsum nulla erat.'),
                        ]),

                    Section::make('Socials')
                        ->schema([
                            TextInput::make('facebook')
                                ->hint("If you want it to be invisible, leave it as blank")
                                ->url()
                                ->default("https://www.facebook.com"),

                            TextInput::make('x')
                                ->hint("If you want it to be invisible, leave it as blank")
                                ->label("X/Twitter")
                                ->url()
                                ->default("https://www.x.com"),

                            TextInput::make('instagram')
                                ->hint("If you want it to be invisible, leave it as blank")
                                ->url()
                                ->default("https://www.instagram.com"),

                            TextInput::make('linkedin')
                                ->hint("If you want it to be invisible, leave it as blank")
                                ->url()
                                ->default("https://www.linkedin.com"),
                        ])
                ]),
        ];
    }
}
