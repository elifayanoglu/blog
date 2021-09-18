<?php
namespace app\core;

use app\core\db\DbModel;
use app\core\db\Database;

class Application{
 
    public static string $ROOT_DIR;

    public string $layout = "main";
    public string $userClass;
  //  public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Application $app;
    public ?Controller $controller = null;
    public ?UserModel $user;
    public View $view;
    public $admin;
   
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR=$rootPath;
        self::$app = $this;
        $this->response= new Response();
        $this->request= new Request();
        $this->session= new Session();
    //    $this->router= new Router($this->request,$this->response);
        $this->view = new View();
        $this->db= new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if($primaryValue){
          $primaryKey = $this->userClass::primaryKey();
          $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }
    }
    public static function isGuest()
    {
      return !self::$app->user;
    }

    public function run(){
         try{
            echo $this->router->resolve();
         }catch(\Exception $e){
             $this->response->setStatusCode($e->getCode());
             echo $this->view->renderView('error',[
                 'exception' => $e
             ]);
         } 
    }

    public function getController(){
         return $this->controller;
    }

    public function setController(Controller $controller){
        $this->controller=$controller;
    }
    public static function hasAdminSession(){
        return self::$app->admin;
    }

    public function login(UserModel $user){
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user',$primaryValue);
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');

    }

    public function loginAdmin(DbModel $admin){
        if(isset($_SESSION['admin'])){
            self::$app->logoutMember();
        }
        $this->admin = $admin;
        $primaryKey = $admin->primaryKey(); 
        $primaryValueAdmin = $admin->{$primaryKey};
        $this->session->set('admin', $primaryValueAdmin);
        return true;
    }

    public function logoutMember(){
        $this->member = null;
        $this->session->remove('member');
    }

    public function logoutAdmin(){
        $this->admin = null;
        $this->session->remove('admin');
    }

    public static function slugify($string) {
        // replace turkish chars
        $string = str_replace('ü','u',$string);
        $string = str_replace('Ü','U',$string);
     
        $string = str_replace('ğ','g',$string);
        $string = str_replace('Ğ','G',$string);
     
        $string = str_replace('ş','s',$string);
        $string = str_replace('Ş','S',$string);
     
        $string = str_replace('ç','c',$string);
        $string = str_replace('Ç','C',$string);
     
        $string = str_replace('ö','o',$string);
        $string = str_replace('Ö','O',$string);
        
        $string = str_replace('ı','i',$string);
        $string = str_replace('İ','I',$string);
        
        $slug= trim(preg_replace('@[^A-Za-z0-9-]+@', '-', $string), '-');
        
     
        return $slug;
    }
}