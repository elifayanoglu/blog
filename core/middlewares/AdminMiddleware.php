<?php

namespace app\core\middlewares;
use app\core\Application;
use app\core\exception\ForbiddenException;

class AdminMiddleware{
    
    public array $actions = [];

    public function __construct(array $actions = []) {
        /*if(!Application::hasAdminSession()){
            throw new ForbiddenException();
         }*/
        
    }

    
}