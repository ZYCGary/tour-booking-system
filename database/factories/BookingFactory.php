<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\TourDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tour = Tour::factory()->create();
        $tourDate = TourDate::factory()->create([
            'tour_id' => $tour->id,
            'status' => 0
        ]);

        return [
            'tour_id' => $tour->id,
            'tour_date' => $tourDate->date,
        ];
    }

    public function submitted()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 0,
            ];
        });
    }

    public function confirmed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 1,
            ];
        });
    }
}
