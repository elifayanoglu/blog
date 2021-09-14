<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class MemberController extends Controller{
        
    public function getMembers()
    {
        $this->setLayout("admin");
       return $this->render("adminmembers",[
          "title" => "adminmembers"
       ]);

    }
    public function deleteMember()
    {
        $this->setLayout("admin");

    }
    
}