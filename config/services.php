<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party
    | services such as Twilio and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'twilio' => [
        'auth-token'  => env('TWILIO_APP_SID'),
        'account-sid' => env('TWILIO_ACCOUNT_SID'),
    ],

];
