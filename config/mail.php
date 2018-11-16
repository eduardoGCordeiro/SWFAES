<?php

return [
'driver' => env('MAIL_DRIVER', ''),

'host' => env('MAIL_HOST', ''),

'port' => env('MAIL_PORT', ''),

'address' => env('MAIL_FROM_ADDRESS', ''),

'name' => env('MAIL_FROM_NAME', 'SWFAES'),

'encryption' => env('MAIL_ENCRYPTION', ''),

'username' => env('MAIL_USERNAME',''),

'password' => env('MAIL_PASSWORD',''),

'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'swfaes@gmail.com'),
    'name' => env('MAIL_FROM_NAME', 'SWFAES'),
],

'sendmail' => '/usr/sbin/sendmail -bs',

'markdown' => [
    'theme' => 'default',

    'paths' => [
        resource_path('views/vendor/mail'),
    ],
],

];

