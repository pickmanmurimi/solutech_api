<?php

namespace Modules\Vehicles\Database\factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Vehicles\Entities\Vehicle;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "make" => $this->faker->randomElement(['Isuzu', 'Tata', 'Mercedes']),
            "status" => 'Available',
            "vehicle_type_id" => random_int(1, 2),
        ];
    }
}

