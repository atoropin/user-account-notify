<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Access Token URL
    |--------------------------------------------------------------------------
    |
    | To access UserAccount we need to get fresh access_token first.
    |
    */

    'token_url'     => env('USER_ACCOUNT_TOKEN_URL', 'https://id.tomsk.life/auth/realms/master/protocol/openid-connect/token'),

    /*
    |--------------------------------------------------------------------------
    | UserAccount notifications URL
    |--------------------------------------------------------------------------
    */

    'notify_url'    => env('USER_ACCOUNT_NOTIFY_URL', 'https://account.tomsk.life/ntf-srv/send-notification'),

    /*
    |--------------------------------------------------------------------------
    | Keycloak client credentials
    |--------------------------------------------------------------------------
    */

    'client_id'     => env('KEYCLOAK_CLIENT_ID'),
    'client_secret' => env('KEYCLOAK_CLIENT_SECRET'),
];
