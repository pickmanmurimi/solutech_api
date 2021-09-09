<?php

namespace Modules\Vehicles\Tests\Feature;

use Modules\Vehicles\Entities\Vehicle;
use Modules\Vehicles\Entities\VehicleType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTypeTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function can_get_vehicle_types()
    {
        VehicleType::factory()->create()->count(2);

        $this->authenticate();

        $response = $this->getJson('/api/v1/vehicles/vehicle-type');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [[
                'uuid',
                'name',
                'created_at',
            ]]
        ]);
    }
}
