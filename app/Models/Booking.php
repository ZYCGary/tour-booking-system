<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperBooking
 */
class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSubmitted($query)
    {
        return $query->whereStatus(0);
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function passengers(): BelongsToMany
    {
        return $this->belongsToMany(Passenger::class, 'booking_passengers');
    }
}
