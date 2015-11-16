<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "Messagerie.html5.twig";

    public function run() {

        $templateTop = $this->objTwig->loadTemplate("MessagerieInbox.html5.twig");
        $arrObjSupportDiscussions = \Site\SiteHelper::getSupportDiscussionsRepository()->findDiscussions($this->objAccount->getId(), false, 20);
        $countMessageNonLu = \Site\SiteHelper::getSupportMessagesRepository()->countMessagesNonLu($this->objAccount->getId());
        $viewInbox = $templateTop->render(["arrObjSupportDiscussions" => $arrObjSupportDiscussions, "countMessageNonLu" => $countMessageNonLu]);
        
        $countModerateur = \Site\SiteHelper::getSupportModerateursRepository()->countByIdAccount($this->objAccount->getId());
        if ($countModerateur > 0) {
            $this->arrayTemplate["isModerateurTicket"] = true;
        } else {
            $this->arrayTemplate["isModerateurTicket"] = false;
        }
        
        $this->arrayTemplate["viewInbox"] = $viewInbox;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Messagerie();
$class->run();
