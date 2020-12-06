<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperBooking
 */
class Booking extends Model
{
    use HasFactory;

    public function scopeSubmitted($query)
    {
        return $query->whereStatus(0);
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
