<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieArchive extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieArchive.html5.twig";

    public function run() {

        $arrObjSupportDiscussions = \Site\SiteHelper::getSupportDiscussionsRepository()->findDiscussions($this->objAccount->getId(), true, 50);
        $this->arrayTemplate["arrObjSupportDiscussions"] = $arrObjSupportDiscussions;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new MessagerieArchive();
$class->run();
