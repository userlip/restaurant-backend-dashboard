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
                ->color(function (Website $record) {
                    $status = data_get($record, 'domain_purchase_response.ApiResponse._Status');

                    if ($status === "OK") {
                        return "success";
                    }

                    if ($status === "ERROR") {
                        return "danger";
                    }
                })
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
                    $domainPurchase = $record->domain_purchase_response_status_result;
                    $status = data_get($record, 'cloudflare_response.success');

                    if ($domainPurchase === null) {
                        return true;
                    }

                    return $domainPurchase && $status;
                })
                ->action(function (Website $record) use ($service) {
                    $service->createCloudflareDnsZone($record);
                }),

            Actions\Action::make('change_nameserver')
                ->label("Change Nameserver")
                ->requiresConfirmation()
                ->disabled(function (Website $record) {
                    $cloudflareResponse = $record->cloudflare_response_status_result;
                    $status = $record->nameserver_transfer_status_result;

                    if ($cloudflareResponse === true && $cloudflareResponse === true && $status === null) {
                        return false;
                    }

                    return true;
                })
                ->action(function (Website $record) use ($service) {
                    $service->changeNameservers($record);
                }),

            Actions\Action::make('create_dns_record')
                ->label("Create DNS record")
                ->requiresConfirmation()
                ->disabled(function (Website $record) {
                    $cloudflareResponse = $record->cloudflare_response_status_result;
                    $nameserverTransferStatus = $record->nameserver_transfer_status_result;
                    $typeADnsRecordStatus = data_get($record, 'type_a_dns_record.success');
                    $typeHttpsDnsRecordStatus = data_get($record, 'type_https_dns_record.success');

                    if ($cloudflareResponse && $nameserverTransferStatus && ($typeADnsRecordStatus === null || $typeHttpsDnsRecordStatus === null)) {
                        return false;
                    }

                    return true;
                })
                ->action(function (Website $record) use ($service) {
                    $service->createDnsRecords($record);
                }),

            Actions\Action::make('create_ploi_tenant')
                ->label("Create Ploi Tenant")
                ->requiresConfirmation()
                ->disabled(function (Website $record) {
                    $domainPurchase = $record->domain_purchase_response_status_result;
                    $tenantRecord = $record->tenant_create_response;

                    if ($domainPurchase === true && $tenantRecord === null) {
                        return false;
                    }

                    return true;
                })
                ->action(function (Website $record) use ($service) {
                    $service->createTenant($record);
                }),
        ];
    }
}
