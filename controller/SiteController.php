<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller{

 /*   public function home()
    {
        $params = [
            "name"=>"home"
        ];
       // return Application::$app->router->renderView("home",$params);
       $this->setLayout("home");
       return $this->render("home",$params);
    } */

    
    public function main()
    {
        $params = [
            "name"=>"home"
        ];
       // return Application::$app->router->renderView("home",$params);
       $this->setLayout("main");
       return $this->render("main",$params);
    }

    public function admin()  
    {
        $params = [
            "name2"=>"admin"
        ];
        $this->setLayout("admin");
       return $this->render("admin",$params);
    } 

    public function contact()
    {
        //return Application::$app->router->renderView("contact");
        return $this->render("contact");
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return "Handling submitted data";
    }

    public function showProfile()
    {
       echo "user profile";
    }

    public function member_detail($memberid)
    {
       /* return $this->render("404",[
            "member" => $memberid
        ]);*/

        echo $this->twig->render('index.html', ['name' => 'Fabien',
         'member'=>$memberid]);

    }
}


?>