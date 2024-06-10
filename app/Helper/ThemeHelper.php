<?php

namespace App\Helper;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ThemeHelper
{
    public static function templateOneForm()
    {
        return Builder::make('data')
            ->required()
            ->blocks([
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
            ]);
    }
}
