<?php

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;

class Controller{

    public string $layout = "home";
    public string $action = '';

    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     */ 
    protected array $middlewares = [];//it's an array of middleware classes
    //The middlewares is an array of BaseMiddlewares

    public function setLayout($layout)
    {
        $this->layout = $layout;

    }

     public function render($view,$params=[])
     {
         return Application::$app->view->renderView($view,$params);
     }

     public function registerMiddleware(BaseMiddleware $middleware)
     {
         $this->middlewares[] = $middleware;

     }

     public function getMiddleware(): array
     {
         return $this->middlewares;
     }

}