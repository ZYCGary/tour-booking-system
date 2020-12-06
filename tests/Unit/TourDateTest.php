<?php

namespace Tests\Unit;

use App\Models\Tour;
use App\Models\TourDate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TourDateTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * Testing a tour date is enable if its status is 'enable'
     *
     * @test
     * @covers \App\Models\TourDate
     */
    public function enabled_tour_dates()
    {
        $tour = create(Tour::class);

        $enabledDate1 = TourDate::factory()->enabled()->create(['tour_id' => $tour->id]);
        $enabledDate2 = TourDate::factory()->enabled()->create(['tour_id' => $tour->id]);
        $disabledDate = TourDate::factory()->disabled()->create(['tour_id' => $tour->id]);

        $enabledDates = $tour->dates()->enabled()->get();

        $this->assertTrue($enabledDates->contains($enabledDate1));
        $this->assertTrue($enabledDates->contains($enabledDate2));
        $this->assertFalse($enabledDates->contains($disabledDate));
    }

    /**
     * Testing a tour date is disable if its status is 'disable'
     *
     * @test
     * @covers \App\Models\TourDate
     */
    public function disabled_tour_dates()
    {
        $tour = create(Tour::class);

        $disabledDate1 = TourDate::factory()->disabled()->create(['tour_id' => $tour->id]);
        $disabledDate2 = TourDate::factory()->disabled()->create(['tour_id' => $tour->id]);
        $enabledDate = TourDate::factory()->enabled()->create(['tour_id' => $tour->id]);

        $disabledDates = $tour->dates()->disabled()->get();

        $this->assertTrue($disabledDates->contains($disabledDate1));
        $this->assertTrue($disabledDates->contains($disabledDate2));
        $this->assertFalse($disabledDates->contains($enabledDate));
    }
}
