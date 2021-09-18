<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\ContentForm;
use app\model\Admin;
use app\model\AdminLoginForm;
use app\model\Member;
use app\model\ReplyComment;
use app\core\middlewares\AdminMiddleware;
use app\Services\ContentService;
use app\Services\MemberService;
use app\Services\SubscriberService;
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
        $admin = new AdminLoginForm();
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

    public function adminAddContent()
    {
        $request = new Request;
        $response = new Response;

        $addContent = new ContentForm();

        if ($request->isPost()) {
            $addContent->loadData($request->getBody());
            if ($addContent->validate() && $addContent->save()) {
                $addContent->uploadImage(ContentForm::class, ['title' => $addContent->title]);
                $mailController = new MailController();
                $subscriberController = new SubscriberService();
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

    public function editContent(){

        $request= new Request; 
        $response= new Response;
        $addContent = new ContentForm();
        $contentController = new ContentService();
        if($request->isPost()){
            $addContent->loadData($request->getBody());
            if($addContent->validate() && $addContent->update("")){

            }
        }
        $this->setLayout('admin');
        return $this->render('admineditcontent', [
            'model' => $addContent
        ]);
    }

    public function adminAddMember()
    {
        $this->setLayout("admin");
        echo $this->templates->render("adminaddmember");
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
        echo $this->templates->render("/admin/adminaccount");
    }

    public function getAdmin()
    {
        $admin = new Admin();
        return $admin::findOne(['id' => $_SESSION['admin']], Admin::class);
    }
}
