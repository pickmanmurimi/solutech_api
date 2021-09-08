<?php

return [

    'storage' => [
        'database' => [
            'connection' => null,
        ],
    ],
    'key_path' => env('OAUTH_KEY_PATH', 'storage'),

    'oauth_clients' => [
        'users' => [
            'client_id' => env('USER_CLIENT_ID'),
            'client_secret' => env('USER_CLIENT_SECRET'),
        ],
    ]

];
