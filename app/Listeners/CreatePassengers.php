<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Models\Passenger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePassengers
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
        $uniqueAttributes = ['given_name', 'surname', 'email', 'mobile', 'passport', 'birth_date'];

        foreach ($passengers as $passenger) {
            Passenger::upsert($passenger, $uniqueAttributes);
        }
    }
}
