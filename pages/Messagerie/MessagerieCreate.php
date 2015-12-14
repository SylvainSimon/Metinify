<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieCreate extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieCreate.html5.twig";

    public function run() {

        global $session;

        $arrObjBanword = \Player\PlayerHelper::getBanwordRepository()->findAll();
        if (count($arrObjBanword) > 0) {
            $Tableau_Mots_Bannis = [];
            foreach ($arrObjBanword AS $objBanword) {
                $Tableau_Mots_Bannis[] = $objBanword->getWord();
            }
        }
        $session->set("Tableau_Mots_Bannis", $Tableau_Mots_Bannis);

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
