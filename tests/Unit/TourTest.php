<?php

namespace Tests\Unit;

use App\Models\Tour;
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
     * Testing tours with status as 'draft' are draft tours that are invisible to users.
     *
     * @test
     * @covers \App\Models\Tour
     */
    public function tours_with_status_as_draft_are_draft_tours()
    {
        $user = create(User::class);

        $draft1 = Tour::factory()->draft()->create(['user_id'=>$user->id]);
        $draft2 = Tour::factory()->draft()->create(['user_id'=>$user->id]);
        $publicTour = Tour::factory()->public()->create();

        $drafts = Tour::drafts($user)->get();

        $this->assertTrue($drafts->contains($draft1));
        $this->assertTrue($drafts->contains($draft2));
        $this->assertFalse($drafts->contains($publicTour));
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

}
