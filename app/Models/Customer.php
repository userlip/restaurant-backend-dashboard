<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getNextPaymentDatePrettyAttribute() : Carbon | string
    {
        return $this->next_payment_date->format('F d Y');
    }

    public function getCreatedAtPrettyAttribute() : Carbon | string
    {
        return $this->created_at->format('F d Y');
    }

    public function getCreatedAtTimeAttribute() : Carbon | string
    {
        return $this->created_at->format('h:m a');
    }
}
