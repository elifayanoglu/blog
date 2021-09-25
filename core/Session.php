<?php

namespace app\core;
class Session{

  protected const FLASH_KEY = "flash_messages";
  //Bir olayın gerçekleştiğini web sitesi veya uygulamanın kullanıcısına geri iletmek
  // için bir flaş mesaj kullanılır
  public function __construct()
  {
    session_start();

   $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
   //$_SESSION, birden çok sayfada kullanılacak bilgileri (değişkenlerde) depolamanın
   // bir yoludur

   foreach($flashMessages as $key => &$flashMessage)
   {
      //Mark to be removed
      $flashMessage['remove']=true;
   }
   $_SESSION[self::FLASH_KEY] = $flashMessages;
  }

  public function setFlash($key , $message)
  {
     $_SESSION[self::FLASH_KEY][$key] =[
        'remove' => false, 
        'value' => $message
     ];
  }

  public function getFlash($key)
  {

     $message = $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
     //$this->remove($key);
     return $message;
  }

  public function set($key, $value)
  {
      $_SESSION[$key] = $value;
  }

  public function get($key)
  {
      return $_SESSION[$key] ?? false;
  }

  public function remove($key){
       unset($_SESSION[SELF::FLASH_KEY][$key]);
  }

  
  public function __destruct()
  {
    //Iterate over marked to be removed
    $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

   foreach($flashMessages as $key => &$flashMessage)
   {
       if($flashMessage['remove']){
           unset($flashMessages[$key]);
       }
   }
   $_SESSION[self::FLASH_KEY] = $flashMessages;
   }
}