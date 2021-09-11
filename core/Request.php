<?php
namespace app\core;
class Request{
    public function getPath(){
       $path = $_SERVER["REQUEST_URI"] ?? "/";//request_uri sayfaya erişim için belirtilen uri var mı yok mu o kontrol ediliyor
       $position = strpos($path,"?");//request_uri ile soru işaretinden önceki kısmı alıyoruz
       //strpos verilen $path'in içinde soru işareti hangi pozisyonda onu belirler
       if($position==false){
           return $path;
       }
       return substr($path,0,$position);
    }

    public function method(){
        return strtolower($_SERVER["REQUEST_METHOD"]);//PHP sayfasına erişim için kullanılan yöntemi verir (GET, POST gibi).
    }

    public function isGet(){
        return $this->method()==="get";
    }

    public function isPost(){
        return $this->method()==="post";
    }

    public function getBody(){
        $body = [];
        if($this->method()=="get"){
            foreach($_GET as $key=>$value){
                $body[$key]=filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS) ;
            }
        } 
        if($this->method()=="post"){
            foreach($_POST as $key=>$value){
                $body[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS) ;
            }
        } 
        return $body;
    }

}