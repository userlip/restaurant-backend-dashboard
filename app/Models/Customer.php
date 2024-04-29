<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'contact_person',
        'next_payment_date',
        'is_invoice',
        'agreed_price',
        'impressum',
        'whatsapp_number',
    ];

    protected $casts = [
        'next_payment_date' => 'date'
    ];

    /**
     * The Notes relationship of the Customer model
     *
     * @return HasMany
     */
    public function notes() : HasMany
    {
        return $this->hasMany(Note::class)->latest();
    }

    /**
     * The Website relationship of the Customer model
     *
     * @return HasMany
     */
    public function websites() : HasMany
    {
        return $this->hasMany(Website::class);
    }

    /**
     * The Lead relationship of the Customer it was converted on
     *
     * @return HasOne
     */
    public function lead() : HasOne
    {
        return $this->hasOne(Lead::class);
    }
}
