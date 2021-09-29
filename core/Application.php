<?php
namespace app\core;

use app\core\db\DbModel;
use app\core\db\Database;
use app\model\Member;
use app\model\Admin;
use Exception;

class Application{
 
    public static string $ROOT_DIR;

    public string $layout = "main";
    public string $memberClass;
    public string $adminClass;
   // public string $userClass;
  //  public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Application $app;
    public ?Controller $controller = null;
    public ?UserModel $user;
    public View $view;
//    public $admin;
    public ?DbModel $member;
    public ?DbModel $admin;
   
    public function __construct($rootPath, array $config)
    {
        $this->memberClass = $config['memberClass'];
        $this->adminClass = $config['adminClass'];
        self::$ROOT_DIR=$rootPath;
        self::$app = $this;
        $this->response= new Response();
        $this->request= new Request();
        $this->session= new Session();
        $this->view = new View();
     
        $this->db = new Database($config['db']);

        $primaryValueMember = $this->session->get('member');
        $primaryValueAdmin = $this->session->get('admin');
        if($primaryValueMember){
            $primaryKey = $this->memberClass::primaryKey();
            $this->member = $this->memberClass::findOne([$primaryKey => $primaryValueMember], Member::class);
        }
        else {
            $this->member = null;
        }
        if($primaryValueAdmin){
            $primaryKey = $this->adminClass::primaryKey();
            $this->admin = $this->adminClass::findOne([$primaryKey => $primaryValueAdmin], Admin::class);
        }
        else {
            $this->admin = null;
        }
    }

    public static function isGuest(){
        return !self::$app->member;
    }
    public static function hasAdminSession(){
        return self::$app->admin;
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

 /*   public function login(UserModel $user){
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user',$primaryValue);
        return true;
    }*/

 /*   public function logout(){
        $this->user = null;
        $this->session->remove('user');

    }*/

    public function loginAdmin(DbModel $admin){
        if(isset($_SESSION['member'])){
            self::$app->logoutMember();
        }
        $this->admin = $admin;
        $primaryKey = $admin->primaryKey(); 
        $primaryValueAdmin = $admin->{$primaryKey};
        $this->session->set('admin', $primaryValueAdmin);
        return true;
    }
    public function loginMember(DbModel $member){
        if(isset($_SESSION['admin'])){
            self::$app->logoutAdmin();
        }
        $this->member = $member;
        $primaryKey = $member->primaryKey(); 
        $primaryValueMember = $member->{$primaryKey};
        $this->session->set('member', $primaryValueMember);
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