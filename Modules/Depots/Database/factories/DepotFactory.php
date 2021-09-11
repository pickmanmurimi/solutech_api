<?php

namespace Modules\Depots\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Depots\Entities\Depot;

class DepotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Depot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            //
            "name" => $this->faker->unique()->randomElement([ "Mombasa Depot", "Nairobi Depot"]),
            "address" => $this->faker->address,
        ];
    }
}

