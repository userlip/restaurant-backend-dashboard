<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'note',
    ];

    /**
     * The polymorphic note relationship for Customer and Lead
     *
     * @return MorphTo
     */
    public function noteable() : MorphTo
    {
        return $this->morphTo();
    }
}
