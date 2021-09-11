<?php

use app\controller\SiteController;
use app\core\Application;
use app\controller\AuthController;

require_once __DIR__ . "/vendor/autoload.php";
require_once "config/settings.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    "db" =>[ //DB_DSN, DB_USER, DB_PASSWORD .env dosyasından geliyor
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
];


$app= new Application(__DIR__ , $config);

$app->db->applyMigrations();

