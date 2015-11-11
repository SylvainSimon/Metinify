<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "Messagerie.html5.twig";

    public function run() {

        $countModerateur = \Site\SiteHelper::getSupportModerateursRepository()->countByIdAccount($this->objAccount->getId());
        if ($countModerateur > 0) {
            $this->arrayTemplate["isModerateurTicket"] = true;
        } else {
            $this->arrayTemplate["isModerateurTicket"] = false;
        }
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Messagerie();
$class->run();
