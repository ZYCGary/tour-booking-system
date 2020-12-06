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
    use RefreshDatabase;

    /**
     * Testing a user can edit a booking.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_edit_a_booking()
    {
        $data = $this->initABooking();
        $booking = $data['booking'];

        $this->get(route('bookings.edit', ['booking' => $booking->id]))
            ->assertStatus(200);
    }

    /**
     * Testing a user can update a booking.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_update_a_booking()
    {
        $data = $this->initABooking();
        $tour = $data['tour'];
        $booking = $data['booking'];
        $passenger1 = $data['passengers'][0];
        $passenger2 = $data['passengers'][1];

        $newTourDate = $data['enabledTourDate2']->date;
        $newPassengers = [
            'given_name' => [$passenger1->given_name, 'Lily'],
            'surname' => [$passenger1->surname, 'Wang'],
            'email' => [$passenger1->email, 'lily@test.com'],
            'mobile' => [$passenger1->mobile, '1234567'],
            'passport' => [$passenger1->passport, 'E123456'],
            'dob' => [$passenger1->birth_date, '1992-04-25']
        ];

        $formRequest = [
            'tour_id' => $tour->id,
            'tour_date' => $newTourDate,
            'status' => 1,
            'given_name' => $newPassengers['given_name'],
            'surname' => $newPassengers['surname'],
            'email' => $newPassengers['email'],
            'mobile' => $newPassengers['mobile'],
            'passport' => $newPassengers['passport'],
            'dob' => $newPassengers['dob'],
            'special_request' => ['', 'Lily request']
        ];

        // testing booking updated
        $this->put(route('bookings.update', $booking), $formRequest)
            ->assertStatus(302);
        $this->assertCount(1, Booking::all());
        $this->assertEquals($newTourDate, $booking->refresh()->tour_date);
        $this->assertEquals(1, $booking->refresh()->status);

        // testing passenger updated
        $this->assertCount(3, Passenger::all());

        // testing booking_passenger updated
        $this->assertCount(2, BookingPassenger::all());
        $this->assertCount(0, BookingPassenger::where([
            'booking_id' => $booking->id,
            'passenger_id' => $passenger2->id
        ])->get());
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
