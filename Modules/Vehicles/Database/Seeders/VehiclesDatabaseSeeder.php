<?php

namespace Modules\Vehicles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicles\Entities\Vehicle;
use Modules\Vehicles\Entities\VehicleType;

class VehiclesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        VehicleType::factory()->count(2)->create();
        $vehicle = Vehicle::factory()->count(10)->create();
    }
}
