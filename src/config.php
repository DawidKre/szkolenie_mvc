<?php

return [
    'database' => [
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => 'bazadanych',
        'dbname' => 'mvc_blog',
    ],

    'twig' => [
        'dir' => __DIR__,
        'cache' => __DIR__ . '/../cache'
    ]
];