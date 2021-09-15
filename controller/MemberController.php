<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class MemberController extends Controller{
        

    public function getMembers()
    {
        $this->setLayout("admin");
      echo $this->templates->render("adminmembers",[
          "title" => "adminmembers"
       ]);

    }
    public function deleteMember()
    {
        $this->setLayout("admin");

    }

    public function memberAccount()
    {
        $this->setLayout("main");
       echo $this->templates->render("account");
    }
    
}