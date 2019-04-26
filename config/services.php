<?php

use App\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET')
        // 'webhook' => [
        //     'secret' => env('STRIPE_WEBHOOK_SECRET'),
        //     'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        // ],
    ],

    'facebook' => [
    'client_id' => '2240394202881631',
    'client_secret' => '20b210e3228e7b222c28a6707ae02ade',
    'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],

];
