<?php

namespace Modules\Vehicles\Tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Vehicles\Entities\Vehicle;
use Modules\Vehicles\Entities\VehicleType;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function can_add_vehicle()
    {

        $vehicle_type = VehicleType::factory()->create();

        $vehicle_data = Vehicle::factory()->definition();
        $vehicle_data['vehicle_type_id'] = $vehicle_type->id;

        $this->authenticate();

        $response = $this->postJson('/api/v1/vehicles/vehicle', $vehicle_data);

        $response->assertStatus(201);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function can_update_vehicle(): void
    {
        VehicleType::factory()->count(2)->create();
        $vehicle = Vehicle::factory()->create();

        $vehicle_update_data = Vehicle::factory()->definition();

        $this->authenticate();

        $response = $this->putJson('/api/v1/vehicles/vehicle/' . $vehicle->uuid, $vehicle_update_data);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
                'make',
                'status',
                'vehicle_type' => ['uuid', 'name'],
            ]
        ]);
        $this->assertEquals( $vehicle_update_data['name'], Vehicle::first()->name );
    }


    /**
     * @test
     * @return void
     */
    public function can_get_vehicles()
    {
        VehicleType::factory()->create()->count(2);
        Vehicle::factory()->create();
        $this->authenticate();

        $response = $this->getJson('/api/v1/vehicles/vehicle');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [[
                'uuid',
                'name',
                'make',
                'status',
                'vehicle_type' => ['uuid', 'name'],
            ]]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function can_get_vehicle()
    {
        VehicleType::factory()->create()->count(2);
        $vehicle = Vehicle::factory()->create();
        $this->authenticate();

        $response = $this->getJson('/api/v1/vehicles/vehicle/' . $vehicle->uuid);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
                'make',
                'status',
                'vehicle_type' => ['uuid', 'name'],
            ]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function can_delete_vehicle()
    {
        VehicleType::factory()->create()->count(2);
        $vehicle = Vehicle::factory()->create();
        $this->authenticate();

        $response = $this->deleteJson('/api/v1/vehicles/vehicle/' . $vehicle->uuid);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Vehicle deleted', 'success' => true]);
        $this->assertEmpty(Vehicle::first());
    }
}
