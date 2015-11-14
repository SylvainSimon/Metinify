<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class News extends \PageHelper {

    public $strTemplate = "News.html5.twig";

    public function run() {

        $arrObjAdminNews = \Site\SiteHelper::getAdminNewsRepository()->findNews(4);
        $this->arrayTemplate["arrObjAdminNews"] = $arrObjAdminNews;
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new News();
$class->run();
