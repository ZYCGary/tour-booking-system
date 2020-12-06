<?php

namespace App\Listeners;

use App\Events\TourCreated;
use App\Models\TourDate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateTourDates
{
    /**
     * Handle the event.
     *
     * @param  TourCreated  $event
     * @return void
     */
    public function handle(TourCreated $event)
    {
        $dates = $event->dates;
        $records = array_map(function ($date) use ($event) {
            return [
                'tour_id' => $event->tour->id,
                'date' => $date
            ];
        }, $dates);

        TourDate::upsert($records, ['tour_id', 'date']);
    }
}
