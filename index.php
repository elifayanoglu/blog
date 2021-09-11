<?php

use app\controller\SiteController;
use app\core\Application;
use app\controller\AuthController;
use app\controller\HomeController;
use app\controller\AdminController;
use app\model\User;
use Bramus\Router\Router;

require_once __DIR__ . "/vendor/autoload.php";
require_once "config/settings.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'userClass' => User::class,
    "db" =>[ //DB_DSN, DB_USER, DB_PASSWORD .env dosyasından geliyor
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
];
echo "hello";

$app= new Application(__DIR__ , $config);

$router = new Router();
$router->setNamespace('\App\Controllers');
$router->get('cms2/elif2', 'SiteController@showProfile');

//$router->get("/cms2/elif",function(){ echo "elif";});


/*$app->router->get("/cms2/",[SiteController::class,"home"]);
$app->router->get("/cms2/contact",[SiteController::class,"contact"]);
$app->router->post("/cms2/contact",[SiteController::class,"handleContact"]);

$app->router->get("/cms2/categories",[HomeController::class,"categorypost"]);
$app->router->get("/cms2/contact",[HomeController::class,"contact"]);
$app->router->get("/cms2/favourites",[HomeController::class,"favorites"]);
$app->router->get("/cms2/about",[HomeController::class,"about"]);
$app->router->get("/cms2/account",[HomeController::class,"account"]);

$app->router->get("/cms2/admin",[SiteController::class,"admin"]);
$app->router->get("/cms2/login",[AuthController::class,"login"]);
$app->router->post("/cms2/login",[AuthController::class,"login"]);
$app->router->get("/cms2/register",[AuthController::class,"register"]);
$app->router->post("/cms2/register",[AuthController::class,"register"]);
$app->router->get("/cms2/logout",[AuthController::class,"logout"]);
$app->router->get("/cms2/profile",[AuthController::class,"profile"]);*/

$router->run();// bu çalıştığında hangi fonk çalışacağına karar vermemizi sağlıyor