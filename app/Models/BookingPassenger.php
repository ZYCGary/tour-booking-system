<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBookingPassenger
 */
class BookingPassenger extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'passenger_id', 'special_request'];
}
