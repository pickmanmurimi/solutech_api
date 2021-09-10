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
            "registration" => "KB" . $this->faker
                    ->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R,', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'])
                . " " . random_int(100, 999),
            "make" => $this->faker->randomElement(['Isuzu', 'Tata', 'Mercedes']),
            "status" => Vehicle::AVAILABLE,
            "vehicle_type_id" => random_int(1, 2),
        ];
    }
}

