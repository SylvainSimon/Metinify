<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Bannissement extends \PageHelper {

    public $strTemplate = "Bannissement.html5.twig";

    public function run() {

        $objBannissementActifs = \Site\SiteHelper::getBannissementsActifsRepository()->findBannissement($this->objAccount->getId());
        
        $this->arrayTemplate["objBannissementActifs"] = $objBannissementActifs;
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new Bannissement();
$class->run();
