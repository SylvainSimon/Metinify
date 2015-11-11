<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieInbox extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieInbox.html5.twig";

    public function run() {

        $arrObjSupportDiscussions = \Site\SiteHelper::getSupportDiscussionsRepository()->findDiscussions($this->objAccount->getId(), false, 20);
        $countMessageNonLu = \Site\SiteHelper::getSupportMessagesRepository()->countMessagesNonLu($this->objAccount->getId());

        $this->arrayTemplate["arrObjSupportDiscussions"] = $arrObjSupportDiscussions;
        $this->arrayTemplate["countMessageNonLu"] = $countMessageNonLu;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MessagerieInbox();
$class->run();
