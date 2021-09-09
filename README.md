#Into
This is a backend Api for the solutech evaluation test.

The codebase follows a modular structure, thus all functional
parts of the api are found under the Modules folder.

# Setup

#### Run the following commands to get started.

    php artisan passport:keys

    php artisan passport:client --password --name="Users Api Password Grant Clients" --provider=users

#### Copy the values of client_id and client_secret onto the .env file

    USER_CLIENT_ID=
    USER_CLIENT_SECRET=

#### Run tests

    php artisan test
