<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\User as CoreRegisterModel;
use app\core\Request;
use app\core\Response;
use app\core\form\LoginForm;
use app\core\form\RegisterForm;
use app\model\User;
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller
{


  //  public function __construct()
  //  {
        //$this->registerMiddleware(new AuthMiddleware(['profile']));


   // }

    /* $request = new Request;
       $response= new Response;

        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                  $response->redirect('/');
                  return ;
            }
        }*/
    public function login()
    {
        $request = new Request;
        $response = new Response;
        $this->setLayout('main');
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return;
            }
         }
        echo $this->templates->render('login', [
            'model' => $loginForm
        ]);
    }


    public function register()
    {
        $request = new Request;
        // $this->setLayout("auth");
        $errors = [];

        //$user = new User();
        $registerForm = new RegisterForm;

        if ($request->isPost()) {
           // $user->loadData($request->getBody());
            $registerForm->loadData($request->getBody());

            //if ($user->validate() && $user->save()) {
             if ($registerForm->validate() && $registerForm->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
                exit;
            }

            echo $this->templates->render("register", [
                "model" =>   $registerForm// $user
            ]);
        }

        echo $this->templates->render("register", [
            "errors" => $errors
        ]);
    }

    public function logout( )
    {
        $request= new Request;
        $response= new Response;
        Application::$app->logoutMember();
        $response->redirect('/cms2');
    }

    public function profile()
    {
        //Application::$app->router
        //  return $this->render('profile');
    }
}