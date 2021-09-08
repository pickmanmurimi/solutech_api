<?php

namespace Modules\Orders\Tests\Feature;

use Modules\Depots\Entities\Depot;
use Modules\Orders\Entities\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function get_orders()
    {
        $this->authenticate();

        Depot::factory()->count(2)->create();
        Order::factory()->count(3)->create();

        $response = $this->getJson('api/v1/orders/order');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [[
                'uuid',
                'name',
                'status',
                'dispatched_at',
                'loaded_at',
                'delivered_at',
                'address',
                'depot' => [
                    'uuid',
                    'name',
                    'address',
                ]
            ]]
        ]);
    }
}
