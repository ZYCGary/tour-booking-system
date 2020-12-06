<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewListingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing A guest cannot view the tour listing.
     *
     * @test
     * @covers \App\Http\Controllers\ListingsController
     */
    public function guest_cannot_view_draft_list()
    {
        $this->withExceptionHandling();

        $this->get(route('listings.index'))
            ->assertRedirect(route('login'));
    }

    /**
     * Testing a logged-in user can view the list of tours he/she created.
     *
     * @test
     * @covers \App\Http\Controllers\ListingsController
     */
    public function logged_in_user_can_view_draft_list()
    {
        $this->signIn();

        $tour = create(Tour::class, [
            'user_id' => auth()->id()
        ]);

        $this->get(route('listings.index'))
            ->assertStatus(200)
            ->assertSee($tour->name);
    }

    /**
     * Testing Only the tour creator can view his/her draft list.
     *
     * @test
     * @covers \App\Http\Controllers\ListingsController
     */
    public function only_the_creator_can_view_draft_list()
    {
        $user1 = create(User::class);
        $user2 = create(User::class);

        $draftByUser1 = Tour::factory()->draft()->create(['user_id' => $user1->id]);
        $draftByUser2 = Tour::factory()->draft()->create(['user_id' => $user2->id]);

        $this->signIn($user1);

        $this->get(route('listings.index'))
            ->assertStatus(200)
            ->assertSee($draftByUser1->name)
            ->assertDontSee($draftByUser2->name);
    }


}
