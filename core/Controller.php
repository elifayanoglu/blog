<?php

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;
use League\Plates\Engine;

class Controller{

    public string $layout = "home";
    public string $action = '';
    public $twig ;
    public $templates;

    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     */ 
    protected array $middlewares = [];//it's an array of middleware classes
    //The middlewares is an array of BaseMiddlewares

    public function __construct(Engine $templates)
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
        $this->twig = new \Twig\Environment($loader);
       // $this->templates = new Engine(__DIR__ . '/../templates');
       $this->templates = $templates;

    }
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