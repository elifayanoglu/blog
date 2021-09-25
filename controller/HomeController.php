<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Category;
use app\model\Comment;
use app\model\ContactForm;
use app\Services\CategoryService;
use app\Services\ContentService;
use app\Services\FavoritesService;
use app\Services\MemberService;

class HomeController extends Controller{

    public function main()
    {
        $params = [
            "name"=>"realhome"
        ];

        $contentController = new ContentService;

        $contents = $contentController->getContents();


       echo $this->templates->render("home", $contents);
    }

    public function categories()  
    {
        $category = new CategoryService;
        $categories = $category->getCategories();

      /* $posts = [
         [
             "id" => 1,
             "title" => "Alperen blog",
              
         ],
         [
            "id" => 2,
            "title" => "Elif blog" ,
            
         ],  
         [
            "id" => 3,
            "title" => "Ali blog" ,
            
         ],       
         [
            "id" => 4,
            "title" => "X blog" ,
            
         ],
       ]; */

       echo $this->templates->render("categorypost", [
            "posts" => $categories// $posts
       ]);
    } 

    public function category($id)  
    {
        $categoryService = new CategoryService;
        $category = $categoryService->getCategory(["id"=> $id]);
      //  print_r($category); exit;
        // select * from posts where category_id = $id
        $content = new ContentService;
        $name=$category->name;
        $contents = $content->getContents("where category = '{$name}'");

      /*  $a = [
            "id" => $id,
            "title" => "X blog",
            "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam a dolores fuga labore eligendi. Placeat totam obcaecati necessitatibus natus culpa, magnam sed ipsum, suscipit sapiente cum laboriosam odio rerum dolores."  ,
            "updated_at" => date('d - m -Y H:i:s'),
            "category" =>" ",
            "image" => ""
        ];*/
      

       echo $this->templates->render("posts", [
            "posts" => $contents,
            "categoryname" => $name
       ]);
    } 
    public function postDetail($id)
    {
         $request = new Request;
         $response = new Response;
         $content = new ContentService;
         $comment = new  Comment;

       
         $content1 = $content->getContent(["id" => $id]);
         $title =$content1->title;
         if ($request->isPost()) {
            $data = $request->getBody();

            $data['member_id'] = $_SESSION['member'];
            $data['post_title'] = $title;
            $comment->loadData($data);
            if ($comment->validate() && $comment->save()) {
                Application::$app->session->setFlash('success', "Comment successfully uploaded, Mail sended to subscribers");
                return $response->redirect('/cms2/post/'.$id);
            }
        }
         
       echo $this->templates->render("post", [
        "post" => (array)$content1
   ]);
        
    }
  
    public function favourites()
    {
        
        echo $this->templates->render("favorites");
    }

    public function addFavourite()
    {
        $favorite = new FavoritesService;
        $addFavorite =$favorite->addFavorite();
        echo $this->templates->render("addfavorite");
    }

    public function contact()
    {
        echo $this->templates->render("contact");
    }
    public function contactMe(){
        $request = new Request;
        $response = new Response;
        $contactForm = new ContactForm();
        if($request->isPost()){
            $contactForm->loadData($request->getBody());
            if($contactForm->validate()){
                $mailController = new MailController();
                $result = $mailController->sentMailToAdmin($contactForm->name, $contactForm->email, $contactForm->website, $contactForm->body);
                if($result == true){
                    $msg = "Thanks for contacting me!";
                }
                else {
                    $msg = "A problem has occurs!";
                }
                Application::$app->session->setFlash('success', $msg);
                return $response->redirect('/cms2/contact');
            }
            return $this->render('contact', [
                'model' => $contactForm
            ]);
        }
    }


    public function about()
    {
        echo $this->templates->render("about");
    }

    public function account()
    {
        $member = new MemberService();
        $members = $member->getMember(['id' => $_SESSION['member']]);
        echo $this->templates->render("account",[
            "members" => (array)$members
        ]);
    }
  
}


?>