<?php

namespace app\Services;

use app\core\Controller;
use app\model\ContentForm;

class ContentService {
    public function getContents($where = '', $orderBy = '', $limit = ''){
        $contentForm = new ContentForm();
        return $contentForm::getAll(ContentForm::class, $where,  $orderBy, $limit);
    }
    
//post'u pasife ve aktife alırken değiştiriyoruz
    public function updateActive($where, $isActive){
        $contentForm = new ContentForm();
        $contentForm::updateWhere($where, ContentForm::class, $isActive);
    }

    public function deleteContent($where){
        $contentForm = new ContentForm();
        $contentForm->deleteOne($where, ContentForm::class);
    }

    public function getContent($where){
        $contentForm = new ContentForm();
        return $contentForm::findOne($where, ContentForm::class);
    }

    public function hasContent($where){
        if($this->getContent($where)){
            return true;
        }
        return false;
    }
}