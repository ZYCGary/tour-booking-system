<?php

namespace Tests\Feature\Bookings;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewBookingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing a user can view the booking list.
     *
     * @test
     * @covers \App\Http\Controllers\BookingsController
     */
    public function user_can_view_booking_list()
    {
        $bookings = create(Booking::class, [], 2);

        $response = $this->get(route('bookings.index'))
            ->assertStatus(200);

        $response->assertSee($bookings[0]->tour->name);
        $response->assertSee($bookings[1]->tour->name);
    }

}
