<?php

namespace app\core\form;

use app\core\Model;


class Field extends BaseField{//InputFiled
 
    public const TYPE_TEXT = "text"; 
    public const TYPE_PASSWORD = "password"; 
    public const TYPE_NUMBER = "number"; 

    public string $type;
  //  public Model $model;
  //  public string $attribute;

    public function __construct(\app\core\Model $model, string $attribute)
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
        return sprintf('<input type=%s name=%s value=%s class="form-control%s">',
        $this->type,
        $this->attribute,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? 'is-invalid' : ''
         );
    }
}