<?php

namespace App\Listeners;

use App\Events\TourUpdated;
use App\Models\TourDate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTourDates
{
    /**
     * Handle the event.
     *
     * @param  TourUpdated  $event
     * @return void
     */
    public function handle(TourUpdated $event)
    {
        $dates = $event->dates;

        // delete enabled tour dates that are not in the request
        $event->tour->dates()->enabled()->whereNotIn('date', $dates)->delete();

        // create new enabled tour dates according to the request
        $records = array_map(function ($date) use ($event) {
            return [
                'tour_id' => $event->tour->id,
                'date' => date($date)
            ];
        }, $dates);

        TourDate::upsert($records, ['tour_id', 'date']);
    }
}
