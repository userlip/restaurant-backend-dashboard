<?php

namespace App\Filament\Resources\WebsiteDomainSetupResource\Pages;

use App\Filament\Resources\WebsiteDomainSetupResource;
use App\Models\Website;
use App\Service\WebsiteService;
use App\Utils\Ploi;
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

                    $this->refreshPage();
                }),

            Actions\Action::make('create_dns_zone')
                ->label("Create DNS Zone")
                ->requiresConfirmation()
                ->color(function (Website $record) {
                    $status = data_get($record, 'cloudflare_response.success');

                    if ($status === true) {
                        return "success";
                    }

                    if ($status === false) {
                        return "danger";
                    }
                })
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

                    $this->refreshPage();
                }),

            Actions\Action::make('change_nameserver')
                ->label("Change Nameserver")
                ->requiresConfirmation()
                ->color(function (Website $record) {
                    $status = data_get($record, 'nameserver_transfer.ApiResponse._Status');

                    if ($status === "OK") {
                        return "success";
                    }

                    if ($status === "ERROR") {
                        return "danger";
                    }
                })
                ->disabled(function (Website $record) {
                    $cloudflareResponse = $record->cloudflare_response_status_result;
                    $status = $record->nameserver_transfer_status_result;

                    if ($status === false) {
                        return false;
                    }

                    if ($cloudflareResponse === true && $cloudflareResponse === true && $status === null) {
                        return false;
                    }

                    return true;
                })
                ->action(function (Website $record) use ($service) {
                    $service->changeNameservers($record);

                    $this->refreshPage();
                }),

            Actions\Action::make('create_dns_record')
                ->label("Create DNS record")
                ->requiresConfirmation()
                ->color(function (Website $record) {
                    $typeADnsRecordStatus = data_get($record, 'type_a_dns_record.success');
                    $httpsDnsRecordStatus = data_get($record, 'type_https_dns_record.success');

                    if ($typeADnsRecordStatus === true || $httpsDnsRecordStatus === true ) {
                        return "success";
                    }

                    if ($typeADnsRecordStatus === false || $httpsDnsRecordStatus === false ) {
                        return "danger";
                    }
                })
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

                    $this->refreshPage();
                }),

            Actions\Action::make('create_ploi_tenant')
                ->label("Create Ploi Tenant")
                ->requiresConfirmation()
                ->color(function (Website $record) {
                    $isResponseDataExists = data_get($record, 'tenant_create_response.data');

                    if (is_array($isResponseDataExists) === true) {
                        return "success";
                    }

                    if ($isResponseDataExists === null) {
                        return ;
                    }

                    if (is_array($isResponseDataExists) === false) {
                        return "danger";
                    }
                })
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

                    $this->refreshPage();
                }),

            Actions\Action::make('tenant_request_certificate')
                ->label("Request SSL Certificate")
                ->requiresConfirmation()
                ->color(function (Website $record) {
                    $isResponseDataExists = data_get($record, 'tenant_ssl_request_response.message');

                    if ($isResponseDataExists === null) {
                        return ;
                    }

                    if ($isResponseDataExists === "Let's Encrypt certificate request has been issued") {
                        return "success";
                    } else {
                        return "danger";
                    }
                })
                ->disabled(function (Website $record) {
                    $tenantResponse = data_get($record, 'tenant_ssl_request_response.message');

                    if ($tenantResponse === null) {
                        return false;
                    }

                    if ($tenantResponse === "Let's Encrypt certificate request has been issued") {
                        return true;
                    } else {
                        return false;
                    }
                })
                ->action(function (Website $record) use ($service) {
                    Ploi::requestCertificate($record);

                    $this->refreshPage();
                }),
        ];
    }

    public function refreshPage(): void
    {
        $this->js('window.location.reload()');
    }
}
