<?php

namespace app\core\form;

use app\core\Application;
use app\core\Model;
use app\model\Member;

class LoginForm extends Model{

    public string $email = '';
    public string $password = '';

    public function rules(): array{
        return [
            'email' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login(){
        $member = Member::findOne(['email' => $this->email], Member::class);
        if(!$member){
            $this->addError('email', "User does not exist with this email");
            return false;
        }
        if(md5($this->password) == $member->password){
            $this->addError('password', "Password is incorrect");
            return false;
        }
        return Application::$app->loginMember($member);
    }

    public function labels(): array{
        return [
            "email" => "Email",
            "password" => "Password"
        ];
    }
}


?>
