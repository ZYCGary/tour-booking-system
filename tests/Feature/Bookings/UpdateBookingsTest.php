<?php

namespace Tests\Feature\Bookings;

use App\Models\Booking;
use App\Models\BookingPassenger;
use App\Models\Passenger;
use App\Models\Tour;
use App\Models\TourDate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateBookingsTest extends TestCase
{
    /**
     * Testing a user can edit a booking.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_edit_a_booking()
    {
        $data = $this->initABooking();
        $tour = $data['tour'];
        $enabledTourDate = $data['enabledTourDate1']->date;
        $booking = $data['booking'];
        $passengers = $data['passengers'];
        $bookingPassengers = $data['bookingPassengers'];

        $this->get(route('bookings.edit', ['booking' => $booking->id]))
            ->assertStatus(200);
    }

    /**
     * Initialise a tour and tour dates for booking.
     *
     * @return array
     */
    private function initABooking(): array
    {
        $tour = Tour::factory()->public()->create();

        $enabledTourDate1 = create(TourDate::class, [
            'tour_id' => $tour->id,
            'date' => '2020-12-06',
            'status' => 1
        ]);
        $enabledTourDate2 = create(TourDate::class, [
            'tour_id' => $tour->id,
            'date' => '2020-12-07',
            'status' => 1
        ]);
        $disabledTourDate = create(TourDate::class, [
            'tour_id' => $tour->id,
            'date' => '2020-12-08',
            'status' => 0
        ]);

        $booking = create(Booking::class, [
            'tour_id' => $tour->id,
            'tour_date' => $enabledTourDate1->date
        ]);

        $passengers = create(Passenger::class, [], 2);

        $bookingPassengers1 = create(BookingPassenger::class, [
            'booking_id' => $booking->id,
            'passenger_id' => $passengers[0]->id,
        ]);

        $bookingPassengers2 = create(BookingPassenger::class, [
            'booking_id' => $booking->id,
            'passenger_id' => $passengers[1]->id,
        ]);

        return [
            'tour' => $tour,
            'enabledTourDate1' => $enabledTourDate1,
            'enabledTourDate2' => $enabledTourDate2,
            'disabledTourDate' => $disabledTourDate,
            'booking' => $booking,
            'passengers' => $passengers,
            'bookingPassengers' => [$bookingPassengers1, $bookingPassengers2]
        ];
    }
}
