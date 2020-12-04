<?php

namespace Tests\Unit;

use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TourTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing tours with status as 'public' are public tours that are visible to users.
     *
     * @test
     * @covers \App\Models\Tour
     */
    public function tours_with_status_as_public_are_public_tours()
    {
        $publicTour1 = Tour::factory()->public()->create();
        $publicTour2 = Tour::factory()->public()->create();
        $draftTour = Tour::factory()->draft()->create();

        $publicTours = Tour::public()->get();

        $this->assertTrue($publicTours->contains($publicTour1));
        $this->assertTrue($publicTours->contains($publicTour2));
        $this->assertFalse($publicTours->contains($draftTour));
    }

}
