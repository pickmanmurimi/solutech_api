<?php

namespace Modules\Orders\Tests\Feature;

use Modules\Depots\Entities\Depot;
use Modules\Orders\Entities\Order;
use Modules\Vehicles\Entities\Vehicle;
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
            'data' => [
                $this->getOrdersStructure()
            ]
        ]);
    }

    /**
     * @return array
     */
    public function getOrdersStructure(): array
    {
        return [
            'uuid',
            'name',
            'status',
            'dispatched_at',
            'loading_at',
            'delivered_at',
            'address',
            'depot' => [
                'uuid',
                'name',
                'address',
            ]
        ];
    }

    /**
     * @test
     * @return void
     */
    public function get_pending_orders()
    {
        $this->authenticate();

        Depot::factory()->count(2)->create();
        Order::factory()->count(1)->create();

        $response = $this->getJson('api/v1/orders/order?status=pending');

        $response->assertStatus(200);
        $order = json_decode($response->getContent(), true);
        $this->assertSame($order['data'][0]['status'], 'pending');
        $response->assertJsonStructure([
            'data' => [
                $this->getOrdersStructure()
            ]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function get_loading_orders()
    {
        $this->authenticate();

        Depot::factory()->count(2)->create();
        Order::factory()->count(1)->create(['loading_at' => now(), 'status' => 'loading']);

        $response = $this->getJson('api/v1/orders/order?status=loading');

        $response->assertStatus(200);
        $order = json_decode($response->getContent(), true);
        $this->assertSame($order['data'][0]['status'], 'loading');
        $this->assertNotEmpty($order['data'][0]['loading_at']);
        $response->assertJsonStructure([
            'data' => [
                $this->getOrdersStructure()
            ]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function get_dispatched_orders()
    {
        $this->authenticate();

        Depot::factory()->count(2)->create();
        Order::factory()->count(1)->create(
            ['loading_at' => now(), 'status' => 'dispatched', 'dispatched_at' => now()]
        );

        $response = $this->getJson('api/v1/orders/order?status=dispatched');

        $response->assertStatus(200);
        $order = json_decode($response->getContent(), true);
        $this->assertSame($order['data'][0]['status'], 'dispatched');
        $this->assertNotEmpty($order['data'][0]['loading_at']);
        $this->assertNotEmpty($order['data'][0]['dispatched_at']);
        $response->assertJsonStructure([
            'data' => [
                $this->getOrdersStructure()
            ]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function get_delivered_orders()
    {
        $this->authenticate();

        Depot::factory()->count(2)->create();
        Order::factory()->count(1)->create(
            ['loading_at' => now(), 'status' => 'delivered', 'dispatched_at' => now(), 'delivered_at' => now()]
        );

        $response = $this->getJson('api/v1/orders/order?status=delivered');

        $response->assertStatus(200);
        $order = json_decode($response->getContent(), true);
        $this->assertSame($order['data'][0]['status'], 'delivered');
        $this->assertNotEmpty($order['data'][0]['loading_at']);
        $this->assertNotEmpty($order['data'][0]['dispatched_at']);
        $this->assertNotEmpty($order['data'][0]['delivered_at']);
        $response->assertJsonStructure([
            'data' => [
                $this->getOrdersStructure()
            ]
        ]);
    }

    /**
     * @test
     */
    public function can_load_an_order()
    {
        $this->authenticate();

        Depot::factory()->count(2)->create();
        $order = Order::factory()->create();
        $vehicle = Vehicle::factory()->create();
        $data = [
            'vehicle_uuid' => $vehicle->uuid,
            'order_uuid' => $order->uuid,
        ];

        $response = $this->postJson('api/v1/orders/delivery/load', $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                "uuid",
                "order",
                "vehicle",
                "created_at",
                "created_at_readable",
            ]
        ]);
    }

    /**
     * @test
     */
    public function can_dispatch_an_order()
    {

        $this->authenticate();

        Depot::factory()->count(2)->create();
        $order = Order::factory()->count(1)->create();
        $vehicle = Vehicle::factory()->create();

        $response = $this->postJson('api/v1/orders/delivery/dispatch');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Order is dispatched', 'success' => true]);
    }

    /**
     * @test
     */
    public function can_deliver_an_order()
    {
        $this->authenticate();

        Depot::factory()->count(2)->create();
        $order = Order::factory()->count(1)->create();
        $vehicle = Vehicle::factory()->create();

        $response = $this->postJson('api/v1/orders/delivery/deliver');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Order is delivered', 'success' => true]);
    }
}
