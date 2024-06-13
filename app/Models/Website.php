<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    use HasFactory;

    public const PORKBUN_QUERY_WEBSITE = 'https://porkbun.com/checkout/search?q=';

    protected $fillable = [
        'uuid',
        'customer_id',
        'theme',
        'domain',
        'seo_title',
        'seo_description',
        'favicon',
        'logo',
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
}
