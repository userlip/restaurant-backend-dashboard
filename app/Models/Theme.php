<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function websites() : HasMany
    {
        return $this->hasMany(Website::class);
    }
}
