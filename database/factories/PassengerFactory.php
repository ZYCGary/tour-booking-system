<?php

namespace Database\Factories;

use App\Models\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Passenger::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'given_name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'mobile' => $this->faker->numerify('##########'),
            'passport' => $this->faker->text(10),
            'birth_date' => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y-m-d'),
        ];
    }
}
