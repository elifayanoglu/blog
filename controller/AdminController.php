<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class AdminController extends Controller{


    public function adminLogin()  
    {
       $this->setLayout("admin");
       echo $this->templates->render("adminlogin");
    } 

    public function adminContent()
    {
        $this->setLayout("admin");
        echo $this->templates->render("admincontents");
    }

    public function adminAddContent()
    {
        $this->setLayout("admin");
        echo $this->templates->render("adminaddcontent");
    }

    public function adminAddMember()
    {
        $this->setLayout("admin");
        echo $this->templates->render("adminaddmember");
    }

    public function adminMembers()
    {
        $this->setLayout("admin");
        echo $this->templates->render("adminmembers");
    }
    public function adminComments()
    {
        $this->setLayout("admin");
        echo $this->templates->render("admincomments");
    }
    public function adminAccount()
    {
        $this->setLayout("admin");
        echo $this->templates->render("adminaccount");
    }
    

}

?>