<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\TourDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourDateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourDate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tour_id' => function () {
                return Tour::factory()->create();
            },
            'date' => $this->faker->date(),
        ];
    }

    /**
     * Indicate that the tour date status is 'enabled'.
     *
     * @return Factory
     */
    public function enabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'enabled',
            ];
        });
    }

    /**
     * Indicate that the tour date status is 'disabled'.
     *
     * @return Factory
     */
    public function disabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'disabled',
            ];
        });
    }
}
