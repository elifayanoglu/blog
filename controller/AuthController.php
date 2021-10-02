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


class AuthController extends Controller
{


    public function login()
    {
        $request = new Request;
        $response = new Response;
        $this->setLayout('main');
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/cms2/');
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
        $response = new Response;
         $this->setLayout("auth");
        $errors = [];
        $registerForm = new RegisterForm;

        if ($request->isPost()) {
            $registerForm->loadData($request->getBody());
             if ($registerForm->validate() && $registerForm->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/cms2/login');
                exit;
            }
            
        }
        echo $this->templates->render("register", [
            "model" =>   $registerForm,
            "errors" => $errors
        ]);
    }

    public function logout( )
    {
        $request= new Request;
        $response= new Response;
        Application::$app->logoutMember();
        echo $this->templates->render("logout");
        $response->redirect('/cms2/');
    }

    public function profile()
    {
        //Application::$app->router
        //  return $this->render('profile');
    }
}