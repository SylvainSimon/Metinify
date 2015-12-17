<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class News extends \PageHelper {

    public $strTemplate = "News.html5.twig";

    public function run() {

        $arrObjActualites = \Site\SiteHelper::getActualitesRepository()->findNews(4);
        $this->arrayTemplate["arrObjActualites"] = $arrObjActualites;
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new News();
$class->run();
