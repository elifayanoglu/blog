<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use app\controller\SiteController;
use app\core\Application;
use app\controller\AuthController;
use app\controller\HomeController;
use app\controller\AdminController;
use app\core\middlewares\AdminMiddleware;
use app\model\User;
use Bramus\Router\Router;
use app\core\Request;
use app\core\Response;
use app\middlewares\HelperMiddleware;
use app\model\Member;
use app\model\Admin;

require_once __DIR__ . "/vendor/autoload.php";
require_once "config/settings.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$config = [
    'memberClass' => Member::class,
    'adminClass' => Admin::class,
    'userClass' => User::class,
    "db" =>[ //DB_DSN, DB_USER, DB_PASSWORD .env dosyasından geliyor
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
];


$app= new Application(__DIR__ , $config);


$router = new Router();



$router->setNamespace('\app\controller');


$router->get('/', 'HomeController@main');
$router->get("/admin","SiteController@admin");

$router->get("/categories","HomeController@categories");
$router->get("/category/{id}","HomeController@category");
$router->get("/post/{id}","HomeController@postDetail");
$router->post("/post/{id}","HomeController@postDetail");
$router->get("/contact","HomeController@contact");
$router->post("/contact","HomeController@contact");
//$router->get('/contact', "HomeController@contactMe");
//$router->post('/contact', "HomeController@contactMe");
$router->get("/favorites","HomeController@favourites");
//$router->get("/favorites/addfavorite","HomeController@addFavourite");
$router->get("/about","HomeController@about");
$router->get("/account","HomeController@account");


$router->get("/admin/content/change", "AdminController@adminChangeStatus");
$router->get("/admin/login","AdminController@adminLogin");
$router->post("/admin/login","AdminController@adminLogin");
$router->get("/admin/contents","AdminController@adminContent");
$router->get("/admin/contents/new","AdminController@adminAddContent");
$router->post("/admin/contents/new","AdminController@adminAddContent");
$router->get("/admin/contents/edit/{id}", "AdminController@editContent");
$router->post("/admin/contents/edit/{id}", "AdminController@editContent");
//$router->get("/admin/members/addmember","AdminController@adminAddMember");
$router->get("/admin/members","AdminController@adminMembers");
$router->post("/admin/members","AdminController@adminMembers");
$router->get("/admin/comments","AdminController@adminComments");
$router->post("/admin/comments","AdminController@adminComments");
$router->get("/admin/account","AdminController@adminAccount");
$router->post("/admin/account","AdminController@adminAccount");
$router->get("/admin/subscribers","AdminController@subscriber");



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
