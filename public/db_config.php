<?php

use Illuminate\Database\Capsule\Manager as DB;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$database = new DB();

$config = [
    'driver'    => 'mysql',
    'host'      => getenv('BD_HOST'),
    'database'  => getenv('DATABASE'),
    'username'  => getenv('USERNAME'),
    'password'  => getenv('PASSWORD'),
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
];

$database->addConnection($config);

$database->setAsGlobal();

$database->bootEloquent();
