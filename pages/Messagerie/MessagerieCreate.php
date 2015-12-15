<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieCreate extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieCreate.html5.twig";

    public function run() {

        $nombreDiscussionOuverte = \Site\SiteHelper::getSupportDiscussionsRepository()->countDiscussionActiveByIdAccount($this->objAccount->getId());
        $this->arrayTemplate["nombreDiscussionOuverte"] = $nombreDiscussionOuverte;
        
        $arrObjSupportObjets = \Site\SiteHelper::getSupportObjetsRepository()->findAll();
        $this->arrayTemplate["arrObjSupportObjets"] = $arrObjSupportObjets;
        $this->arrayTemplate["objAccount"] = $this->objAccount->getId();
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new MessagerieCreate();
$class->run();
