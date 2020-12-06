<?php

namespace App\Listeners;

use App\Events\BookingUpdated;
use App\Models\Passenger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePassengers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingUpdated  $event
     * @return void
     */
    public function handle(BookingUpdated $event)
    {
        $passengers = $event->passengers;
        $uniqueAttributes = ['given_name', 'surname', 'email', 'mobile', 'passport', 'birth_date'];

        foreach ($passengers as $passenger) {
            Passenger::upsert($passenger, $uniqueAttributes);
        }
    }
}
