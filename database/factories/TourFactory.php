<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'name' => $this->faker->sentence,
            'itinerary' => $this->faker->text,
        ];
    }

    /**
     * Indicate that the question status is 'public'.
     *
     * @return Factory
     */
    public function public()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'public',
            ];
        });
    }

    /**
     * Indicate that the question status is 'draft'.
     *
     * @return Factory
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'draft',
            ];
        });
    }
}
