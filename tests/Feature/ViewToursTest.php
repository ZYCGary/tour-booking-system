<?php

namespace Tests\Feature;

use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewToursTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing a user can view the tour list
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function user_can_view_tours()
    {
        $this->get(route('tours.index'))
            ->assertStatus(200);
    }

    /**
     * Testing a user can only view a list of public tours.
     *
     * Tours with status as 'draft' are invisible from the tour list.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function user_can_only_view_public_tours()
    {
        $publicTour = Tour::factory()->public()->create();
        $draftTour = Tour::factory()->draft()->create();

        $response = $this->get(route('tours.index'))
            ->assertStatus(200);

        $response->assertSee($publicTour->name);
        $response->assertDontSee($draftTour->name);
    }

}
