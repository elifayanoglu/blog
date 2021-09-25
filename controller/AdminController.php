<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\form\RegisterForm;
use app\core\Request;
use app\core\Response;
use app\model\Content;
use app\model\Admin;
use app\model\AdminLogin;
use app\model\Member;
use app\model\ReplyComment;
use app\core\middlewares\AdminMiddleware;
use app\Services\ContentService;
use app\Services\MemberService;
use app\Services\SubscribersService;
use PDO;

class AdminController extends Controller
{
  //  public function __construct() {
        // $this->registerMiddleware(new AdminMiddleware([
        // 'comments', 
        // 'members', 
        // 'addContent',
        // 'account',
        // 'addMember'
        //  ]));
  //  }


    public function adminlogin()
    {
        $request = new Request;
        $response= new Response;
        $this->setLayout('admin');
        $admin = new AdminLogin();
        if ($request->isPost()) {
            $admin->loadData($request->getBody());
            if ($admin->validate() && $admin->login()) {
                $response->redirect('/cms2/admin');
                return;
            }
        }
        echo $this->templates->render('adminlogin', [
            'model' => $admin
        ]);
    }

    public function adminContent()
    {
        
        $this->setLayout("admin");
        $contentController = new ContentService;

        $contents = $contentController->getContents();
        
        /*   $contents = [   
            [
                "image"  => "about.jpg",
                "title"  => $cikti["title"],
                "active" => "active 1",
                "content"=>$cikti["content"]
            ],
            [
                "image"  => "about2.jpg",
                "title"  => $cikti["title"],
                "active" => "active 2",
                "content"=> " "
            ]
        ];*/
        echo $this->templates->render("admincontents", [
            "contents" => $contents
        ]);
    }
    public function adminChangeStatus(){
        $request= new Request;
        $data =$request->getBody();
        if(isset($data['id']) && isset($data['isActive'])){
            $contentForm = new Content();
            $contentForm::updateWhere(['id'=> $data['id']], Content::class, $data['isActive']);
        }
    }

    public function adminAddContent()
    {
        $request = new Request;
        $response = new Response;

        $addContent = new Content();
 

        if ($request->isPost()) {
            $addContent->loadData($request->getBody());
            if ($addContent->validate() && $addContent->save()) {
                $addContent->uploadImage(Content::class, ['title' => $addContent->title]);
                $mailController = new MailController();
                $subscriberController = new SubscribersService();
                $mailController->sentMailToSubscribers($subscriberController->getSubscribers(), $addContent);
                Application::$app->session->setFlash('success', "Content successfully uploaded, Mail sended to subscribers");
                return $response->redirect('/cms2/admin/contents');
            }
        }
        $this->setLayout("admin");
        echo $this->templates->render("adminaddcontent", [
            "model" => $addContent
        ]);
    }

    public function editContent($id){
        
        $request= new Request; 
        $response= new Response;
        $addContent = new Content();

        $contentController = new ContentService();
        $content =  $contentController->getContent(['id'=>$id]);
        $addContent->title="Yazılım2";
        if($request->isPost()){
            $data=$request->getBody();
            $data["image"]=$content->title;
            $addContent->loadData($data);
            if($addContent->validate() && $addContent->update("WHERE id = $id")){
             
                $addContent->uploadImage(Content::class, ['title' => $addContent->title]);
                Application::$app->session->setFlash('success', "You edit the content successfully");
                return  $response->redirect('/cms2/admin/contents');
            }
        }
        $this->setLayout('admin');
        echo $this->templates->render('admineditcontent', [
            'model' =>  $content,//$addContent,
            'thePost' =>(array)$content
        ]);
    }

    public function adminAddMember()
    {
        $this->setLayout("admin");
          $request= new Request;
          $response= new Response;

          //$user = new User();
          $register = new RegisterForm;

          if ($request->isPost()) {
             // $user->loadData($request->getBody());
              $register->loadData($request->getBody());
  
              //if ($user->validate() && $user->save()) {
               if ($register->validate() && $register->save()) {
                  Application::$app->session->setFlash('success', 'Thanks for registering');
                  Application::$app->response->redirect('/cms2/admin/members');
                  exit;
              }
  
             /* echo $this->templates->render("adminaddmember", [
                  "model" =>   $register// $user
              ]);*/
          }
          echo $this->templates->render("adminaddmember", [
            "model" =>   $register// $user
        ]);
       // echo $this->templates->render("adminaddmember");
    }

    public function adminMembers()
    {
        $this->setLayout("admin");
        $memberController = new MemberService;

        $members = $memberController->getMembers();
        
     /*   $members = [
            [
                "id"  => " 1",
                "username"  => "elif ",
                "email" => "elif@example.com "
            ],
            [
                "id"  => "2 ",
                "username"  => "esra ",
                "email" => "esra@example.com "
            ]
        ]; */
        echo $this->templates->render("adminmembers", [
            "members" => $members
        ]);
    }
   /*ö public function adminComments()
    {
        $this->setLayout("admin");
        $adminCommentController = new CommentController;

        $adminComments = $adminCommentController->;

        echo $this->templates->render("admincomments");
    }*/

    public function adminComments(){
        $this->setLayout('admin');
        echo $this->templates->render('admincomments');
    }
    
    public function replyComment(){
        $request = new Request;
        $response = new Response;
        $replyComment = new ReplyComment();
        $this->setLayout('admin');
        if($request->isPost()){
            $replyComment->loadData($request->getBody());
            if($replyComment->validate() && $replyComment->save()){
                Application::$app->session->setFlash('success', "You reply the comment successfully");
                return  $response->redirect('/cms2/admin/comments');
            }
            echo $this->templates->render('admincomments', [
                'model' => $replyComment
            ]);
        }
    }
    

    public function adminAccount()
    {
        $this->setLayout("admin");
        echo $this->templates->render("adminaccount");
    }

    public function subscriber()
    {
        $this->setLayout("admin");
        
        echo $this->templates->render("adminsubscribers");
    }
    public function getAdmin()
    {
        $admin = new Admin();
        return $admin::findOne(['id' => $_SESSION['admin']], Admin::class);
    }
}
