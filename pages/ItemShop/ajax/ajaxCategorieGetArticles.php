<?php

namespace Includes;

require __DIR__ . '../../../../core/initialize.php';

class ajaxCategorieGetArticles extends \ScriptHelper {

    public $isProtected = true;
    public $strTemplate = "ajaxCategorieGetArticles.html5.twig";

    public function run() {

        global $request;
        $idCategorie = $request->request->get("id");
        
        $arrObjItemshop = \Site\SiteHelper::getItemshopRepository()->findItemsByCategorie($idCategorie, true);
        
        $this->arrayTemplate["arrObjItemshop"] = $arrObjItemshop;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
 
    }

}

$class = new ajaxCategorieGetArticles();
$class->run();
