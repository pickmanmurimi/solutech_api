<?php

namespace Modules\Authentication\Tests\Feature;

use Laravel\Passport\Passport;
use Modules\User\Entities\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function can_get_user_details()
    {

        /** @var User $user */
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->getJson('api/v1/user/me');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [ 'uuid', 'name', 'email', 'email_verified_at' ]
        ]);
    }
}
