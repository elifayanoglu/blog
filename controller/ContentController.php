<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class ContentController extends Controller{

    public function getContents()
    {
        $this->setLayout("main");
       return $this->render("post",[
          "title" => "post"
       ]);


    }
 
}