<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\TourDate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateToursTest extends TestCase
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
            'itinerary' => 'new itinerary',
            'dates' => '2020-12-02,2020-12-04'
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
            'itinerary' => 'new itinerary',
            'dates' => '2020-12-02,2020-12-04'
        ];

        // Another user trys to update the tour
        $this->signIn($anotherUser);

        $this->put(route('tours.update', ['tour' => $tour]), $formRequest)
            ->assertStatus(403);
        $this->assertEquals($tour, $tour->refresh());
    }

    /**
     * Testing update enabled tour dates when tour updated.
     *
     * Add new enabled tour dates into database, delete enabled dates that are not in the update request.
     * Do no operation on disabled date as the user cannot re-enable a booked date.
     *
     * @test
     * @covers \App\Http\Controllers\ToursController
     */
    public function update_tour_dates_when_tour_updated()
    {
        $this->signIn();

        $tour = create(Tour::class, ['user_id' => auth()->id()]);

        $enabledDate1 = TourDate::factory()->enabled()->create([
            'tour_id' => $tour->id,
            'date' => '2020-12-01'
        ]);
        $enabledDate2 = TourDate::factory()->enabled()->create([
            'tour_id' => $tour->id,
            'date' => '2020-12-02'
        ]);
        $disabledDate = TourDate::factory()->disabled()->create([
            'tour_id' => $tour->id,
            'date' => '2020-12-03'
        ]);

        $this->assertCount(2, $tour->dates()->enabled()->get());
        $this->assertCount(1, $tour->dates()->disabled()->get());

        $formRequest = [
            'name' => 'new name',
            'itinerary' => 'new itinerary',
            'dates' => '2020-12-02,2020-12-04'
        ];

        $this->put(route('tours.update', ['tour' => $tour]), $formRequest)
            ->assertStatus(302);

        // testing enabled tour dates are updated.
        $enabledDates = $tour->refresh()->dates()->enabled()->get();

        $this->assertCount(2, $enabledDates);
        $this->assertTrue($enabledDates->contains($enabledDate2));
        $this->assertFalse($enabledDates->contains($enabledDate1));

        // testing disabled tour dates are not operated.
        $disabledDates = $tour->refresh()->dates()->disabled()->get();

        $this->assertCount(1, $tour->refresh()->dates()->disabled()->get());
        $this->assertTrue($disabledDates->contains($disabledDate));
    }

}
