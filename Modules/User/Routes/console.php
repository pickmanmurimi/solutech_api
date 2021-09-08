<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;

Artisan::command('create-user
            { --first_name=optimus} { --last_name=prime} { --email=optimus@gmail.com} {--simple} {--mail}',
    function ($first_name, $last_name, $email, $simple = false, $mail = false ) {

    if( ! User::whereEmail( $email )->first() )
    {
        try{

            DB::beginTransaction();

            $this->info( "creating user $first_name ");

            // first_name
            $param['first_name'] = $first_name;
            // last_name
            $param['last_name'] = $last_name;
            //email
            $param['email'] = $email;

            $validator = Validator::make( $param ,
                [
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);

            if( $validator->fails() )
            {
                return $this->info( $validator->messages() );
            }

            $this->info( "Creating user ..... ");

            if ($simple)
            {
                $password = 1234567890;
            }else {
                $password = Str::random(8);
            }

            $user = User::create([
                'name' => $param['first_name'] . " " . $param['last_name'],
                'email' => $param['email'],
                'password' => Hash::make($password),
            ]);

//            $this->info( "Assigning roles ..... ");
//
//            //assign role to user
//            $user->assignRole('super-admin');

            // show new account
             $user->OptionsObject()->set('new_account', true );

            DB::commit();

            return $this->info("User created ");
        }

        catch( \Exception $e)
        {
            dump( $e->getMessage() );
            DB::rollback();
            Log::error( $e );
        }
    }

    return $this->info("User Already Exists. ");

})->describe('Create an User');
