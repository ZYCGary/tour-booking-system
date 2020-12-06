<?php

namespace Tests\Feature\Tours;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditToursTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing a guest cannot edit tours.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function guest_cannot_edit_tours()
    {
        $this->withExceptionHandling();

        $tour = create(Tour::class);

        $this->get(route('tours.edit', ['tour' => $tour]))
            ->assertRedirect(route('login'));
    }

    /**
     * Testing a logged-in user can edit his/her tour(s).
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function logged_in_user_can_edit_a_tour()
    {
        $this->signIn();

        $tour = create(Tour::class, ['user_id' => auth()->id()]);

        $this->get(route('tours.edit', ['tour' => $tour]))
            ->assertStatus(200)
            ->assertSee($tour->name);
    }

    /**
     * Testing only the tour creator can edit the tour.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function only_the_creator_can_edit_the_tour()
    {
        $this->withExceptionHandling();

        $creator = create(User::class);

        $tour = create(Tour::class, ['user_id' => $creator->id]);

        $this->signIn(create(User::class));

        $this->get(route('tours.edit', ['tour' => $tour]))
            ->assertStatus(403);

        $this->assertCount(0, Tour::public()->get());
    }
}
