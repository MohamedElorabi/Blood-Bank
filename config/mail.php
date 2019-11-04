<?php
return [


    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => 'elorabi199@gmail.com', 'name' => 'Mohamed elorabi'],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => 'elorabi199@gmail.com',
    'password' => 'elorabi7',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
];
