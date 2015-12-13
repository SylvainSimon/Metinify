<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class MarchePlace extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MarchePlace.html5.twig";

    public function __construct() {
        parent::__construct();
        global $config;
        parent::moduleIsActivated($config["marche"]["activate"]);
    }
    
    public function run() {

        $templateTop = $this->objTwig->loadTemplate("ajaxGetArticles.html5.twig");
        $arrObjMarcheArticles = \Site\SiteHelper::getMarcheArticlesRepository()->findArticlePersonnages();
        $viewArticles = $templateTop->render(["arrObjMarcheArticles" => $arrObjMarcheArticles, "objAccount" => $this->objAccount]);

        $this->arrayTemplate["viewArticles"] = $viewArticles;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MarchePlace();
$class->run();
