<?php

return [
    'serverKey' => env('MIDTRANS_SERVER_KEY'),
    'clientKey' => env('MIDTRANS_CLIENT_KEY'),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),

    'curlOptions' => [
        64 => false,  // CURLOPT_SSL_VERIFYPEER
        81 => false,  // CURLOPT_SSL_VERIFYHOST
        10023 => [],
    ],
];
