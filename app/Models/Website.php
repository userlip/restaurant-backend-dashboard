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
        'cloudflare_response',
        'nameserver_transfer',
    ];

    protected $casts = [
        'theme_data' => 'array',
        'cloudflare_response' => 'array',
        'nameserver_transfer' => 'array',
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
}
