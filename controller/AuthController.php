<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\User as CoreRegisterModel;
use app\core\Request;
use app\core\Response;
use app\model\LoginForm;
use app\model\User;
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller{

   
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
        
        
    }
    public function login()
    {
      /* $request = new Request;
       $response= new Response;

        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                  $response->redirect('/');
                  return ;
            }
        }
        // $this->setLayout("auth");*/
        return $this->templates->render('login');
    }


    public function register(Request $request)
    {
        $this->setLayout("auth");
        $errors = [];

        $user = new User();

        if($request->isPost()){
            $user->loadData($request->getBody());

            if($user->validate() && $user->save()){
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
                exit;
            }

            return $this->render("register",[
                "model" => $user
            ]);
        }
        
        return $this->render("register",[
            "errors" => $errors
        ]);
    }

    public function logout(Request $request,Response $response)
    {
       Application::$app->logout();
       $response->redirect('/');
    }

    public function profile()
    {       
        //Application::$app->router
         return $this->render('profile');
    }
}

?>