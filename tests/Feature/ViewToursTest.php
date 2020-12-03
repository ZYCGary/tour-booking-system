<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewToursTest extends TestCase
{
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

}
