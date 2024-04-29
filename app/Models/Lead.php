<?php

namespace App\Models;

use App\Enums\LeadStatusEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
        'customer_id',
        'name',
        'address',
        'phone',
        'link',
        'status'
    ];

    /**
     * The Customer relationship of the Lead model
     *
     * @return BelongsTo
     */
    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * The Notes polymorphic relationship of Lead to Note
     *
     * @return MorphMany
     */
    public function notes() : MorphMany
    {
        return $this->morphMany(Note::class, 'noteable')->latest();
    }
}
