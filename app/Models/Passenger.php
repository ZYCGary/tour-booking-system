<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Passenger extends Model
{
    use HasFactory;

    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class, 'booking_passengers');
    }
}
