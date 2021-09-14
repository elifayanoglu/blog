<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use app\controller\SiteController;
use app\core\Application;
use app\controller\AuthController;
use app\controller\HomeController;
use app\controller\AdminController;
use app\model\User;
use Bramus\Router\Router;
use app\core\Request;
use app\core\Response;


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
//echo "hello";

$app= new Application(__DIR__ , $config);

$router = new Router();

$router->setNamespace('\app\controller');
$router->get('/elif2', 'SiteController@showProfile');
$router->get("/member/detail/{memberid}","SiteController@member_detail");
$router->get('/', 'HomeController@main');

$router->get("/categories","HomeController@categories");
$router->get("/contact","HomeController@contact");
$router->get("/favourites","HomeController@favourites");
$router->get("/about","HomeController@about");
$router->get("/account","HomeController@account");



$router->get("/admin","SiteController@admin");
$router->get("/adminlogin","AdminController@adminLogin");
$router->post("/adminlogin","AdminController@adminLogin");


$router->get("/login","AuthController@login");
$router->post("/login","AuthController@login");
$router->get("/register","AuthController@register");
$router->post("/register","AuthController@register");
$router->get("/logout","AuthController@logout");
$router->post("/profile","AuthController@profile");


$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "404";
});

$router->run();// bu çalıştığında hangi fonk çalışacağına karar vermemizi sağlıyor

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

