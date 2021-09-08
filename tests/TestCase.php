<?php

namespace Tests;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Modules\Authentication\Database\Seeders\PermissionsSeeder;
use Modules\User\Entities\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call("migrate:fresh");

        $clientRepository = new ClientRepository();

        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', url('/')
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * authenticate
     */
    public function authenticate( $guard = 'api', $role = '' ): void
    {
        /** @var User $user */
        $user = User::factory()->create();

//        $this->seed( PermissionsSeeder::class );

//        $user->assignRole( $role);

        Passport::actingAs($user, [], $guard);
    }
}
