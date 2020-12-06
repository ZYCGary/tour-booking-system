<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * Testing bookings whose status is 0 are "Submitted"
     *
     * @test
     * @covers \App\Models\Booking
     */
    public function submitted_booking()
    {
        $submittedBooking1 = Booking::factory()->submitted()->create();
        $submittedBooking2 = Booking::factory()->submitted()->create();
        $confirmedBooking = Booking::factory()->confirmed()->create();

        $submittedBookings = Booking::submitted()->get();

        $this->assertTrue($submittedBookings->contains($submittedBooking1));
        $this->assertTrue($submittedBookings->contains($submittedBooking2));
        $this->assertFalse($submittedBookings->contains($confirmedBooking));
    }

    /**
     * Testing a booking belongs to a tour.
     *
     * @test
     * @covers \App\Models\Booking
     */
    public function a_Booking_belongs_to_a_tour()
    {
        $tour = create(Tour::class);

        $booking = create(Booking::class, ['tour_id' => $tour->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $booking->tour());
        $this->assertInstanceOf('App\Models\Tour', $booking->tour);
    }

}
