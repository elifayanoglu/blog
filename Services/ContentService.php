<?php

namespace app\Services;

use app\core\Controller;
use app\model\Content;

class ContentService {
    public function getContents($where = '', $orderBy = '', $limit = ''){
        $contentForm = new Content();
        return $contentForm::getAll(Content::class, $where,  $orderBy, $limit);
    }
    
//post'u pasife ve aktife alırken değiştiriyoruz
    public function updateActive($where, $isActive){
        $contentForm = new Content();
        $contentForm::updateWhere($where, Content::class, $isActive);
    }

    public function deleteContent($where){
        $contentForm = new Content();
        $contentForm->deleteOne($where, Content::class);
    }

    public function getContent($where){
        $contentForm = new Content();
        return $contentForm::findOne($where, Content::class);
    }

    public function hasContent($where){
        if($this->getContent($where)){
            return true;
        }
        return false;
    }
}