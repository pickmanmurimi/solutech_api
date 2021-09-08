<?php

namespace Modules\Orders\Database\factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Orders\Entities\Order;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            "name" => "Order " . $this->faker->name,
            "status" => 'pending',
            "address" => $this->faker->address,
            "depot_id" => random_int(1, 2),
        ];
    }
}

