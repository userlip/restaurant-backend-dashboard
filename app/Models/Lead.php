<?php

namespace App\Models;

use App\Enums\LeadStatusEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
