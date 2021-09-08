<?php

namespace Modules\Orders\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function get_orders()
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
