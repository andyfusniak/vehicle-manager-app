<?php
return array(
    // database
    'db' => [
        'hostname' => 'localhost',
        'database' => 'serenityleisure',
        'username' => 'root',
        'password' => 'mysql'
    ],
    // time zone
    'system' => [
        'timezones' => [
            'server' => 'UTC',
            'local'  => 'Europe/London'
        ]
    ],
    'serenitylesiure' => [
        'upload_dir' => __DIR__ . '/uploads'
    ]
);
