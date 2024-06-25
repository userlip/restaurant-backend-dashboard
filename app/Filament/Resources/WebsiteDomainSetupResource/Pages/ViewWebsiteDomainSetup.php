<?php

namespace App\Filament\Resources\WebsiteDomainSetupResource\Pages;

use App\Filament\Resources\WebsiteDomainSetupResource;
use App\Models\Website;
use App\Service\WebsiteService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebsiteDomainSetup extends ViewRecord
{
    protected static string $resource = WebsiteDomainSetupResource::class;

    protected function getHeaderActions(): array
    {
        $service = new WebsiteService;

        return [
            Actions\Action::make('purchase domain')
                ->requiresConfirmation()
                ->disabled(function (Website $record) {
                    $status = data_get($record, 'domain_purchase_response.ApiResponse._Status');
                    return $status === "OK";
                })
                ->action(function (Website $record) use ($service) {
                    $service->buyDomain($record);
                }),

            Actions\Action::make('create_dns_zone')
                ->label("Create DNS Zone")
                ->requiresConfirmation()
                ->disabled(function (Website $record) {
                    $domainPurchase = $record->domain_purchase_response;
                    $status = data_get($record, 'cloudflare_response');

                    return $domainPurchase !== null && $status;
                })
                ->action(function (Website $record) use ($service) {
                    $service->createCloudflareDnsZone($record);
                }),
        ];
    }
}
