<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGetMySales extends \ScriptHelper {

    public $isProtected = true;
    public $strTemplate = "ajaxGetMySales.html5.twig";

    public function run() {

        $arrObjMarcheArticles = \Site\SiteHelper::getMarcheArticlesRepository()->findArticlePersonnages($this->objAccount->getId());
        $this->arrayTemplate["arrObjMarcheArticles"] = $arrObjMarcheArticles;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
        
    }

}

$class = new ajaxGetMySales();
$class->run();
