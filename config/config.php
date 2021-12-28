<?php

return [
    'database' => [
        'name' => 'quant-zadatak',
        'username' => 'root',
        'password' => 'root',
        'host' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];