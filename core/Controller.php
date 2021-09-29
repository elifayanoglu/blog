<?php

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;
use League\Plates\Engine;

class Controller{

    public string $layout = "main";//default layout
    public string $action = '';
    public function setLayout($layout)
    {//set layout of content
        $this->layout = $layout;

    }
     public function render($view,$params=[])
     {// render view
         return Application::$app->view->renderView($view,$params);
     }



  

    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     */ 
    protected array $middlewares = [];//it's an array of middleware classes
    //The middlewares is an array of BaseMiddlewares

    public $templates;
    public function __construct()
    {
       
        $this->templates = new Engine(__DIR__ . '/../templates');

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