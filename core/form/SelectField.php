<?php

namespace app\core\form;


use app\Services\CategoryService;

$categoryController = new CategoryService();

class SelectField extends BaseField{
    public function renderInput(): string {
        return 
        Select::begin() . 
        "<option>deneme</option>"   . 
        Select::end();
    }
}