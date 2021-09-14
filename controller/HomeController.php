<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class HomeController extends Controller{

    public function main()
    {
        $params = [
            "name"=>"realhome"
        ];
       // $this->setLayout("home");
       return $this->twig->render("main",$params);
    }

    public function categories()  
    {
       $this->setLayout("main");
       return $this->render("categorypost");
    } 

    public function contact()
    {
        $this->setLayout("main");
        return $this->render("contact");
    }

    public function favourites()
    {
        $this->setLayout("main");
        return $this->render("favorites");
    }

    public function about()
    {
        $this->setLayout("main");
        return $this->render("about");
    }

    public function account()
    {
        $this->setLayout("main");
        return $this->render("account");
    }
}


?>