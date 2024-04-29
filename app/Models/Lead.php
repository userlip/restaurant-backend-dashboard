<?php

namespace App\Models;

use App\Enums\LeadStatusEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * For the status field values
     * @see LeadStatusEnums
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'link',
        'status'
    ];
}
