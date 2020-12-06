<?php

namespace Tests\Feature\Bookings;

use App\Models\BookingPassenger;
use App\Models\Passenger;
use App\Models\Tour;
use App\Models\TourDate;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatBookingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing A user can view a booking page of a tour.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_view_create_page()
    {
        $data = $this->initATour();

        $tour = $data['tour'];
        $enabledTourDate1 = $data['enabledTourDate1'];
        $enabledTourDate2 = $data['enabledTourDate2'];
        $disabledTourDate = $data['disabledTourDate'];

        $response = $this->get(route('bookings.create', ['tour' => $tour->id]))
            ->assertStatus(200);

        $response->assertSee($tour->name);
    }

    /**
     * Testing a user can bool a tour on an enabled tour date.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_book_a_tour()
    {
        $data = $this->initATour();

        $tour = $data['tour'];
        $enabledTourDate = $data['enabledTourDate1']->date;

        $formRequest = [
            'tour_id' => $tour->id,
            'tour_date' => $enabledTourDate,
            'status' => 0
        ];

        $this->post(route('bookings.store', $formRequest))
            ->assertStatus(302);
    }

    /**
     * Testing a user can book a tour only on an enabled date.
     *
     * A user cannot book for a disabled tour date.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_book_a_tour_only_on_an_enabled_date()
    {
        $data = $this->initATour();

        $tour = $data['tour'];
        $disabledTourDate = $data['disabledTourDate']->date;

        $formRequest = [
            'tour_id' => $tour->id,
            'tour_date' => $disabledTourDate,
            'status' => 0
        ];

        $this->post(route('bookings.store', $formRequest))
            ->assertRedirect(route('bookings.create', ['tour' => $tour->id]));
    }

    /**
     * Testing a user can add passengers in a tour booking.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_add_passengers()
    {
        $data = $this->initATour();
        $tour = $data['tour'];
        $enabledTourDate = $data['enabledTourDate1']->date;

        $passengers = [
            'given_name' => ['Gary', 'Lily'],
            'surname' => ['Zhang', 'Wang'],
            'email' => ['gary@test.com', 'lily@test.com'],
            'mobile' => ['0123456', '1234567'],
            'passport' => ['E012345', 'E123456'],
            'dob' => ['1993-03-03', '1992-04-25']
        ];

        $formRequest = [
            'tour_id' => $tour->id,
            'tour_date' => $enabledTourDate,
            'status' => 0,
            'given_name' => $passengers['given_name'],
            'surname' => $passengers['surname'],
            'email' => $passengers['email'],
            'mobile' => $passengers['mobile'],
            'passport' => $passengers['passport'],
            'dob' => $passengers['dob'],
            'special_request' => ['', 'Lily request']
        ];

        $this->post(route('bookings.store', $formRequest))
            ->assertStatus(302);

        $this->assertCount(2, Passenger::all());
        $this->assertCount(2, BookingPassenger::all());
    }


    /**
     * Initialise a tour and tour dates for booking.
     *
     * @return array
     */
    private function initATour(): array
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

        return [
            'tour' => $tour,
            'enabledTourDate1' => $enabledTourDate1,
            'enabledTourDate2' => $enabledTourDate2,
            'disabledTourDate' => $disabledTourDate,
        ];
    }
}
