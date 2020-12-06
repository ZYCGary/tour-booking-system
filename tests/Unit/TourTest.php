<?php

namespace Tests\Unit;

use App\Models\Tour;
use App\Models\TourDate;
use App\Models\User;
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

    /**
     * Testing a tour has and only has one creator.
     *
     * Testing the one-to-many relationship with User.
     *
     * @test
     * @covers \App\Models\Tour
     */
    public function a_tour_belongs_to_a_creator()
    {
        $tour = create(Tour::class);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $tour->creator());
        $this->assertInstanceOf('App\Models\User', $tour->creator);
    }

    /**
     * Testing a tour is published.
     *
     * @test
     * @covers \App\Models\Tour
     */
    public function a_tour_is_public()
    {
        $tour = create(Tour::class);

        $this->assertFalse($tour->isPublic());

        $tour->update(['status' => 1]);

        $this->asserttrue($tour->isPublic());
    }

    /**
     * Testing A tour has many tour dates.
     *
     * Testing the one-to-many relationship with TourDate.
     *
     * @test
     * @covers \App\Models\Tour
     */
    public function a_tour_has_many_tour_dates()
    {
        $tour = create(Tour::class);

        create(TourDate::class, ['tour_id' => $tour->id], 2);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $tour->dates());
    }
}
