<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class HomeController extends Controller{

    public function home()
    {
        $params = [
            "name"=>"realhome"
        ];
       // $this->setLayout("home");
       return $this->render("home",$params);
    }

    public function categories()  
    {
       $this->setLayout("home");
       return $this->render("categorypost");
    } 

    public function contact()
    {
        $this->setLayout("home");
        return $this->render("contact");
    }

    public function favourites()
    {
        $this->setLayout("home");
        return $this->render("favorites");
    }

    public function about()
    {
        $this->setLayout("home");
        return $this->render("about");
    }

    public function account()
    {
        $this->setLayout("home");
        return $this->render("account");
    }
}


?>