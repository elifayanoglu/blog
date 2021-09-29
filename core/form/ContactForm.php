<?php

namespace app\model;


use app\core\Model;

class ContactForm extends Model{
    
    public string $name = '';
    public string $email = '';
    public string $body = '';
    
    public function rules() : array {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED]
        ];
    }
}