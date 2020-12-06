<?php

namespace App\Events;

use App\Models\Tour;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TourCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Tour $tour;
    public array $dates;

    /**
     * Create a new event instance.
     *
     * @param Tour $tour
     * @param array $dates
     */
    public function __construct(Tour $tour, array $dates)
    {
        $this->tour = $tour;
        $this->dates = $dates;
    }
}
