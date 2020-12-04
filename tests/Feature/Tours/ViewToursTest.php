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

    /**
     * Testing a user can view the detail of a public tour.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function user_can_view_a_public_tour()
    {
        $tour = Tour::factory()->public()->create();

        $this->get(route('tours.show', ['tour' => $tour->id]))
            ->assertStatus(200)
            ->assertSee($tour->name);
    }

    /**
     * Testing a user can only view the detail of a public tour.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function user_can_only_view_a_public_tour()
    {
        $this->withExceptionHandling();

        $draft = Tour::factory()->draft()->create();

        $this->get(route('tours.show', ['tour' => $draft->id]))
            ->assertStatus(404);
    }
}
