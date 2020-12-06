<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingPassenger;
use App\Models\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mockery\Generator\StringManipulation\Pass\Pass;

class BookingPassengerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingPassenger::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_id' => function () {
                return create(Booking::class)->id;
            },
            'passenger_id' =>function () {
                return create(Passenger::class)->id;
            },
            'special_request' => $this->faker->text()
        ];
    }
}
