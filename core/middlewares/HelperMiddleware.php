<?php

namespace app\middlewares;
use app\core\Controller;

class HelperMiddleware extends Controller {
    public function getParams () {
        print_r(1); exit;
        $this->templates->addData([
            "title" => "başlık",
            "categories" => $this->getCetegories(),
        ]);
    }

    public function getCetegories() {
        return [
            "1" => "bilim",
            "2" => "felsefe",
            "3" => "sanat"
        ];
    }
}