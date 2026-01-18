<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Twilio Credentials
    |--------------------------------------------------------------------------
    */

    "twilio" => [
        "account_sid" => env("TWILIO_ACCOUNT_SID"),
        "auth_token" => env("TWILIO_AUTH_TOKEN"),
        "from" => env("TWILIO_FROM"),
        "from_whatsapp" => env("TWILIO_FROM_WHATSAPP"),
    ],

];
