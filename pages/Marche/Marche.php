<?php

namespace pages\Marche;

require __DIR__ . '../../../core/initialize.php';

class Marche extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "Marche.html5.twig";

    public function run() {

        $templateTop = $this->objTwig->loadTemplate("ajaxGetArticles.html5.twig");
        $arrObjMarcheArticles = \Site\SiteHelper::getMarcheArticlesRepository()->findArticlePersonnages();
        $viewArticles = $templateTop->render(["arrObjMarcheArticles" => $arrObjMarcheArticles]);
        
        $templatePlace = $this->objTwig->loadTemplate("MarchePlace.html5.twig");
        $viewMarchePlace = $templatePlace->render(["viewArticles" => $viewArticles]);
        
        $this->arrayTemplate["viewMarchePlace"] = $viewMarchePlace;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Marche();
$class->run();
