<?php

return [
    'database' => [
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => 'bazadanych',
        'dbname' => 'mydb',
    ],

    'twig' => [
        'dir' => __DIR__,
        'cache' => __DIR__ . '/../cache'
    ]
];