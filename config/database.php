<?php

return [


    'default' => 'pgsql',

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql2.9-phos_db' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '192.168.2.9'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'phos_db'),
            'username' => env('DB_USERNAME', ''),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            //'prefix' => '',
            //'strict' => true,
            //'engine' => null,
        ],
        'mysql2.11-we-chair' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '192.168.2.11'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'we-chair'),
            'username' => env('DB_USERNAME', ''),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'mysql4.20-hosxpv3' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '192.168.4.20'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'phosbmsdb'),
            'username' => env('DB_USERNAME', ''),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            //'prefix' => '',
            //'strict' => true,
            //'engine' => null,
        ],

        'hosxp4.2' => [
            'driver' => 'pgsql',
            'host' => '192.168.4.2',
            'port' => '5432',
            'database' => 'phosdb',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],


        'oracle' => [
            'driver' => 'oracle',
            'host' => 'localhost',
            'port' => '1521',
            'database' => 'DB',
            'service_name' => 'SID',
            'username' => 'username',
            'password' => 'pass',
            'charset' => '',
            'prefix' => '',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

    ],

    'migrations' => 'migrations',

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];