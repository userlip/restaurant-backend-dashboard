<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteDomainSetupResource\Pages;
use App\Filament\Resources\WebsiteDomainSetupResource\RelationManagers;
use App\Models\Website;
use App\Models\WebsiteDomainSetup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Novadaemon\FilamentPrettyJson\PrettyJson;

class WebsiteDomainSetupResource extends Resource
{
    protected static ?string $model = Website::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = "Website Domain Setup";

    protected static ?string $label = "Website Domain Setup";

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Domain Purchase from Namecheap')
                    ->collapsible()
                    ->schema([
                        PrettyJson::make('domain_purchase_response'),
                    ]),

                Forms\Components\Section::make('Create DNS Zone in Cloudflare')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        PrettyJson::make('cloudflare_response'),
                    ]),

                Forms\Components\Section::make('Change Nameservers')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        PrettyJson::make('nameserver_transfer'),
                    ]),

                Forms\Components\Section::make('Create DNS record')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        PrettyJson::make('type_a_dns_record'),
                    ]),

                Forms\Components\Section::make('Create Ploi Tenant')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        PrettyJson::make('tenant_create_response'),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'DESC')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('seo_title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('logo')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('theme.name')
                    ->sortable()
                    ->searchable()
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebsiteDomainSetups::route('/'),
            'create' => Pages\CreateWebsiteDomainSetup::route('/create'),
            'view' => Pages\ViewWebsiteDomainSetup::route('/{record}/'),
            'edit' => Pages\EditWebsiteDomainSetup::route('/{record}/edit'),
        ];
    }
}
