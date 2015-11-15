<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGetArticles extends \ScriptHelper {

    public $isProtected = true;
    public $strTemplate = "ajaxGetArticles.html5.twig";

    public function run() {

        global $request;

        $raceFilter = $request->request->get("race");
        $sexeFilter = $request->request->get("sexe");
        $levelFilter = $request->request->get("level");
        $orderFilter = $request->request->get("ordre");
        $deviseFilter = $request->request->get("monnaie");
        
        $arrObjMarcheArticles = \Site\SiteHelper::getMarcheArticlesRepository()->findArticlePersonnages($raceFilter, $sexeFilter, $levelFilter, $orderFilter, $deviseFilter);
        $this->arrayTemplate["arrObjMarcheArticles"] = $arrObjMarcheArticles;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new ajaxGetArticles();
$class->run();
