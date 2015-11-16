<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class MarcheMySales extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MarcheMySales.html5.twig";

    public function run() {

        $templateTop = $this->objTwig->loadTemplate("ajaxGetMySales.html5.twig");
        $arrObjMarcheArticles = \Site\SiteHelper::getMarcheArticlesRepository()->findArticlePersonnages($this->objAccount->getId(), 0, 0, 0, 0, 0);
        $viewArticles = $templateTop->render(["arrObjMarcheArticles" => $arrObjMarcheArticles]);
        
        $this->arrayTemplate["viewArticles"] = $viewArticles;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MarcheMySales();
$class->run();
