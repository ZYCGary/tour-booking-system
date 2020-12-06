<?php

namespace App\Events;

use App\Http\Requests\Request;
use App\Models\Booking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $passengers;
    public Booking $booking;
    public $specialRequests;

    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @param Booking $booking
     */
    public function __construct(Request $request, Booking $booking)
    {
        $given_names = $request->input('given_name');
        $surnames = $request->input('surname');
        $emails = $request->input('email');
        $mobiles = $request->input('mobile');
        $passports = $request->input('passport');
        $birthDates = $request->input('dob');
        $specialRequests = $request->input('special_request');

        $passengers = [];

        if($given_names) {
            foreach ($given_names as $index => $value) {
                $passengers[] = [
                    'given_name' => $given_names[$index],
                    'surname' => $surnames[$index],
                    'email' => $emails[$index],
                    'mobile' => $mobiles[$index],
                    'passport' => $passports[$index],
                    'birth_date' => $birthDates[$index],
                ];
            }
        }

        $this->passengers = $passengers;
        $this->booking = $booking;
        $this->specialRequests = $specialRequests;
    }
}
