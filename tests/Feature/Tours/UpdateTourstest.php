<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTourstest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing a guest cannot update tours
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function guest_cannot_update_tours()
    {
        $this->withExceptionHandling();

        $tour = create(Tour::class);

        $this->put(route('tours.update', ['tour' => $tour]))
            ->assertRedirect(route('login'));
    }

    /**
     * Testing the tour creator can update the tour.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function creator_can_update_a_tour()
    {
        $this->signIn();

        $tour = create(Tour::class, [
            'user_id' => auth()->id(),
            'name' => 'name',
            'itinerary' => 'itinerary'
        ]);

        $formRequest = [
            'name' => 'new name',
            'itinerary' => 'new itinerary'
        ];

        $this->put(route('tours.update', ['tour' => $tour]), $formRequest)
            ->assertStatus(302);

        $this->assertEquals('new name', $tour->refresh()->name);
        $this->assertEquals('new itinerary', $tour->refresh()->itinerary);
    }


    /**
     * Testing only the tour creator can update a tour.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function only_the_creator_can_update_a_tour()
    {
        $this->withExceptionHandling();

        $creator = create(User::class);
        $anotherUser = create(User::class);

        $tour = create(Tour::class, [
            'user_id' => $creator->id,
            'name' => 'name',
            'itinerary' => 'itinerary'
        ]);

        $formRequest = [
            'name' => 'new name',
            'itinerary' => 'new itinerary'
        ];

        // Another user trys to update the tour
        $this->signIn($anotherUser);

        $this->put(route('tours.update', ['tour' => $tour]), $formRequest)
            ->assertStatus(403);
        $this->assertEquals($tour, $tour->refresh());
    }

}
