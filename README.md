# Into

This is a backend Api for the Solutech evaluation test.

The codebase follows a modular structure, thus all functional
parts of the api are found under the Modules folder.

The project has tests included, you can always run `php artisan test`
them first to make sure everything runs smoothly.

# Setup

#### Run the following commands to get started.

    php artisan passport:keys

    php artisan passport:client --password --name="Users Api Password Grant Clients" --provider=users

#### Copy the values of client_id and client_secret onto the .env file

    USER_CLIENT_ID=
    USER_CLIENT_SECRET=

#### Run tests

    php artisan test

#### Create a test user
    
    php artisan create-user --first_name={name} --last_name={name} --email={email}

You can leave out the options to create a 
default user with the credentials, email: `optimus@gmail.com` password: `1234567890`.

The default password is `1234567890`
