<?php
return [
    'settings' => [
        'displayErrorDetails' => false, // Set to true when debugging
        'addContentLengthHeader' => false,

        'twig' => [
            'templates' => __DIR__ . '/../templates/',
            'cache' => __DIR__ . '/../cache/'
        ],

        'logger' => [
            'name' => 's-update-server',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::INFO, // Set to DEBUG when debugging
        ],
    ],
];
