<?php

namespace app\core\form;

use app\core\Model;


class InputField extends BaseField{//InputFiled
 
    public const TYPE_TEXT = "text"; 
    public const TYPE_PASSWORD = "password"; 
    public const TYPE_NUMBER = "number"; 

    public string $type;
   public Model $model;
   // public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model,$attribute);
    }
  

    public function passwordField()
    {
       $this->type=self::TYPE_PASSWORD;
       return $this;
    }
    public function renderInput(): string
    {
       // print_r($this->model->);exit;
        return sprintf(
            '<input type="%s" name="%s" value="%s" class="au-input au-input--full form-control%s" placeholder="%s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getLabel($this->attribute)
        );
    }
}
