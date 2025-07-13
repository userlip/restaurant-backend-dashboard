<?php

namespace App\Models;

use App\Enums\LeadStatusEnums;
use App\Observers\LeadObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy(LeadObserver::class)]
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
        'sales_person_id',
        'name',
        'address',
        'phone',
        'link',
        'google_business_id',
        'search_term',
        'status',
        'one_star_count',
        'two_star_count',
        'three_star_count',
        'four_star_count',
        'five_star_count',
        'total_reviews',
        'average_rating',
        'reviews_last_updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reviews_last_updated_at' => 'datetime',
        'average_rating' => 'float',
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
     * The Sales Person relationship of the Lead model
     *
     * @return BelongsTo
     */
    public function salesPerson() : BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_person_id');
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
