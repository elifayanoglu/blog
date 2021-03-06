<?php

namespace app\Services;

use app\core\Controller;
use app\model\Category;

class CategoryService {

    public function getCategories(){
        $category = new Category();
        return $category->getAll(Category::class);
    }
    
    public function getCategory($where){
        $categoryForm = new Category();
        return $categoryForm::findOne($where, Category::class);
    }

}