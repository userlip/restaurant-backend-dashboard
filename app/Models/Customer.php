<?php

namespace App\Models;

use App\Observers\CustomerObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy(CustomerObserver::class)]
class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'area_code',
        'city',
        'state',
        'postal_code',
        'country',
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
     * The Notes polymorphic relationship of the Customer model
     *
     * @return HasMany
     */
    public function notes() : MorphMany
    {
        return $this->morphMany(Note::class, 'noteable')->latest();
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

    public function getFirstNameAttribute() : string
    {
        $fullName = explode(" ", $this->name);

        if (count($fullName) === 3) {
            return $fullName[1];
        }

        return $fullName[0];
    }

    public function getLastNameAttribute() : string
    {
        $fullName = explode(" ", $this->name);

        if (count($fullName) === 3) {
            return $fullName[2];
        }

        return $fullName[1];
    }

    /**
     * Namecheap accepted phone number format
     *
     * @return string
     */
    public function getNamecheapFriendlyPhoneNumberAttribute(): string
    {
        return "{$this->area_code}.{$this->phone}";
    }
}
