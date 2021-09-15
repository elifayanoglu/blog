<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class HomeController extends Controller{

    public function main()
    {
        $params = [
            "name"=>"realhome"
        ];


       echo $this->templates->render("home", $params);
    }

    public function categories()  
    {
       $posts = [
         [
             "id" => 1,
             "title" => "Alperen blog" 
         ],
         [
            "id" => 2,
            "title" => "Elif blog" 
         ],  
         [
            "id" => 3,
            "title" => "Ali blog" 
         ],       
         [
            "id" => 4,
            "title" => "X blog" 
         ],
       ]; 

       echo $this->templates->render("categorypost", [
            "posts" => $posts
       ]);
    } 

    public function category($id)  
    {
        // select * from posts where category_id = $id
        $a = [
            "id" => $id,
            "title" => "X blog",
            "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam a dolores fuga labore eligendi. Placeat totam obcaecati necessitatibus natus culpa, magnam sed ipsum, suscipit sapiente cum laboriosam odio rerum dolores."  
        ];
      

       echo $this->templates->render("post", [
            "post" => $a,
       ]);
    } 

    public function contact()
    {
        $this->setLayout("main");
        echo $this->templates->render("contact");
    }

    public function favourites()
    {
        echo $this->templates->render("favorites");
    }

    public function about()
    {
        $this->setLayout("main");
        echo $this->templates->render("about");
    }

    public function account()
    {
        $this->setLayout("main");
        echo $this->templates->render("account");
    }
}


?>