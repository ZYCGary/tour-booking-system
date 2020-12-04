<?php

namespace Tests\Feature\Tours;

use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublishToursTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing A guest cannot publish a tour draft.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function guest_cannot_publish_a_draft()
    {
        $this->withExceptionHandling();

        $draft = Tour::factory()->draft()->create();

        $this->post(route('tours.publish', ['tour' => $draft->id]))
            ->assertRedirect(route('login'));
    }

    /**
     * Testing a logged-in user can publish a tour draft he/she created
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function logged_in_user_can_publish_drafts()
    {
        $this->signIn();

        $draft = Tour::factory()->draft()->create(['user_id' => auth()->id()]);

        $this->post(route('tours.publish', ['tour' => $draft->id]))
            ->assertRedirect(route('tours.show', ['tour' => $draft->id]));

        $this->assertCount(1, Tour::public()->get());
    }

}
