<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Models\BookingPassenger;
use App\Models\Passenger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateBookingPassenger
{
    /**
     * Handle the event.
     *
     * @param  BookingCreated  $event
     * @return void
     */
    public function handle(BookingCreated $event)
    {
        $passengers = $event->passengers;
        $booking = $event->booking;
        $specialRequests = $event->specialRequests;

        foreach ($passengers as $index => $passenger) {
            BookingPassenger::create([
                'booking_id' => $booking->id,
                'passenger_id' => Passenger::where($passenger)->firstOrFail()->id,
                'special_request' => $specialRequests[$index] ? $specialRequests[$index] : ''
            ]);
        }
    }
}
