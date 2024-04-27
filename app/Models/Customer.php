<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function notes() : HasMany
    {
        return $this->hasMany(Note::class)->latest();
    }
}
