<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieWaiting extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieWaiting.html5.twig";

    public function run() {

        $arrObjSupportDiscussions = \Site\SiteHelper::getSupportDiscussionsRepository()->findDiscussionsEnAttente(20);

        $this->arrayTemplate["arrObjSupportDiscussions"] = $arrObjSupportDiscussions;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MessagerieWaiting();
$class->run();
