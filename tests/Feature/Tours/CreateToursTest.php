<?php

namespace Tests\Feature;

use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateToursTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing A guest cannot view the tour creation page.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function guest_cannot_view_tour_creation_page()
    {
        $this->withExceptionHandling();

        $this->get(route('tours.create'))
            ->assertRedirect(route('login'));
    }

    /**
     * Testing Summary
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function logged_in_user_can_view_tour_creation_page()
    {
        $this->signIn();

        $this->get(route('tours.create'))
            ->assertStatus(200);
    }

    /**
     * Testing A guest cannot create a tour.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function guest_cannot_create_a_tour()
    {
        $this->withExceptionHandling();

        $this->post(route('tours.store', []))
            ->assertRedirect(route('login'));
    }

    /**
     * Testing a logged-in user can create a tour draft
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function logged_in_user_can_create_a_tour()
    {
        $this->signIn();

        $tour = make(Tour::class);

        $this->assertCount(0, Tour::all());

        $this->post(route('tours.store', $tour->toArray()))
            ->assertRedirect(route('listings.index'));

        $this->assertCount(1, Tour::all());
    }
}
