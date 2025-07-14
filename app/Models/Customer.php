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
        'city',
        'postal_code',
        'country',
        'vat_id',
        'contact_person',
        'next_payment_date',
        'is_invoice',
        'agreed_price',
        'impressum',
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
        $phone = str_replace(
            [
                "-",
                '.',
                ' ',
                '(',
                ')',
            ],
            "",
            $this->phone
        );

        // Extract country code from the phone number if it starts with +
        if (str_starts_with($phone, '+')) {
            // Most common country codes are 1-4 digits after the +
            // This is a simple approach - you might need to adjust based on your needs
            return $phone;
        }

        // Default to German country code if no country code is present
        return "+49.{$phone}";
    }
}
