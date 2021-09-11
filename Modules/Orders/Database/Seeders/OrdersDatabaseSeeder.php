<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Depots\Entities\Depot;
use Modules\Orders\Entities\Order;

class OrdersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Depot::factory()->count(2)->create();
        Order::factory(20)->create();
        // $this->call("OthersTableSeeder");
    }
}
