<?php
namespace app\core;

use app\core\exception\ForbiddenException;
use app\core\exception\NotFoundException;

class Router{
     public Request $request;
     public Response $response;
     protected array $routes = [];

     public function __construct(Request $request,Response $response)
     {
         $this->request= $request;
         $this->response= $response;
     }

    public function get($path,$callback){//$path mevcut old. $callback yürütülecek
           $this->routes["get"][$path] = $callback ;
     }

     public function post($path,$callback){
        $this->routes["post"][$path] = $callback ;
     }

     public function resolve(){
      /*   $path= $this->request->getPath();
         $method= $this->request->method();
         $callback= $this->routes[$method][$path] ?? false;
         if($callback==false){
             //Application::$app->response->setStatusCode(404);
             
            // return $this->renderOnlyView("404");
            throw new NotFoundException();
         }

         if(is_string($callback)){
               return Application::$app->view->renderView($callback);
         }
         if(is_array($callback)){
             //$callback[0]= new $callback[0]();
             /** @var \app\core\Controller $controller 
             $controller = new $callback[0]();
             Application::$app->controller = $controller ;
             $controller->action = $callback[1];
             $callback[0] =  $controller;
             foreach($controller->getMiddleware() as $middleware){
                    $middleware->execute();
            }
         }
         return call_user_func($callback,$this->request,$this->response);*/
     }

    public function renderView($view,$params=[])
     {
             return Application::$app->view->renderView($view,$params);
     }

     public function renderContent($viewContent)
     {
        $layoutContent= $this->layoutContent();
        return str_replace("{{content}}",$viewContent,$layoutContent);
       // include_once Application::$ROOT_DIR. "/view/$view.php";
    }

     protected function  layoutContent()
     {
         $layout = Application::$app->layout;
         if(Application::$app->controller){
             $layout = Application::$app->controller->layout;
         }
         ob_start();
         include_once Application::$ROOT_DIR."/view/layouts/$layout.php";
         return ob_get_clean();
     }

     protected function renderOnlyView($view,$params=[])
     {
         foreach($params as $key =>$value){
             $$key = $value;
         }
        ob_start();
        include_once  Application::$ROOT_DIR."/view/$view.php";
        return ob_get_clean();

     }
}