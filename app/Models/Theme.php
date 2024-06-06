<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'template',
        'data',
        'preview_data',
        'is_active',
    ];

    protected $casts = [
        'data' => 'array',
        'preview_data' => 'array',
    ];
}
