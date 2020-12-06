<?php

namespace App\Listeners;

use App\Events\BookingUpdated;
use App\Models\BookingPassenger;
use App\Models\Passenger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBookingPassenger
{
    /**
     * Handle the event.
     *
     * @param BookingUpdated $event
     * @return void
     */
    public function handle(BookingUpdated $event)
    {
        $passengers = $event->passengers;
        $booking = $event->booking;
        $specialRequests = $event->specialRequests;

        // delete records whose 'passenger_id' are not in updated passenger IDs
        $passengerIds = array_map(function ($passenger) {
            return Passenger::where($passenger)->firstOrFail()->id;
        }, $passengers);
        BookingPassenger::whereBookingId($booking->id)
            ->whereNotIn('passenger_id', $passengerIds)
            ->delete();

        foreach ($passengers as $index => $passenger) {
            BookingPassenger::upsert([
                'booking_id' => $booking->id,
                'passenger_id' => Passenger::where($passenger)->firstOrFail()->id,
                'special_request' => $specialRequests[$index] ? $specialRequests[$index] : ''
            ], ['booking_id', 'passenger_id']);
        }
    }
}
