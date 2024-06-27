<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Website extends Model
{
    use HasFactory;

    public const PORKBUN_QUERY_WEBSITE = 'https://porkbun.com/checkout/search?q=';

    protected $fillable = [
        'uuid',
        'customer_id',
        'theme_id',
        'theme_data',
        'domain',
        'seo_title',
        'seo_description',
        'favicon',
        'logo',
        'domain_availability',
        'domain_purchase_response',
        'cloudflare_response',
        'nameserver_transfer',
        'type_a_dns_record',
        'type_https_dns_record',
        'tenant_create_response',
        'tenant_ssl_request_response',
    ];

    protected $casts = [
        'theme_data' => 'array',
        'domain_availability' => 'array',
        'domain_purchase_response' => 'array',
        'cloudflare_response' => 'array',
        'nameserver_transfer' => 'array',
        'type_a_dns_record' => 'array',
        'type_https_dns_record' => 'array',
        'tenant_create_response' => 'array',
        'tenant_ssl_request_response' => 'array',
    ];

    /**
     * The customer relationship of the website model
     *
     * @return BelongsTo
     */
    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function theme() : BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function contactUsMessages() : HasMany
    {
        return $this->hasMany(ContactUsMessage::class);
    }

    public function getDomainPurchaseResponseStatusResultAttribute() : bool | null
    {
        $response = data_get($this, 'domain_purchase_response.ApiResponse._Status');

        if ($response === null) {
            return null;
        }

        return $response === "OK";
    }

    public function getCloudflareResponseStatusResultAttribute() : bool | null
    {
        return data_get($this, 'cloudflare_response.success');
    }

    public function getNameserverTransferStatusResultAttribute() : bool | null
    {
        $response = data_get($this, 'nameserver_transfer.ApiResponse._Status');

        if ($response === null) {
            return null;
        }

        return $response === "OK";
    }

    public function getNewNameserversAttribute() : array | null
    {
        return data_get($this, 'cloudflare_response.result.name_servers');
    }

    public function getDomainAvailabilityResultAttribute() : bool
    {
        return data_get($this->domain_availabilitys, 'ApiResponse.CommandResponse.DomainCheckResult._Available') === "true";
    }
}
