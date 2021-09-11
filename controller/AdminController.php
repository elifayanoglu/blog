<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class AdminController extends Controller{

    public function adminAccount()
    {
        $this->setLayout("admin");
       return $this->render("account");
    }

    public function adminLogin()  
    {
       $this->setLayout("admin");
       return $this->render("adminlogin");
    } 

    public function adminContent()
    {
        $this->setLayout("admin");
        return $this->render("admincontent");
    }

    public function adminAddContent()
    {
        $this->setLayout("admin");
        return $this->render("adminaddcontent");
    }

    public function adminAddMember()
    {
        $this->setLayout("admin");
        return $this->render("adminaddmember");
    }

    public function adminMembers()
    {
        $this->setLayout("admin");
        return $this->render("adminmembers");
    }

}

?>