<?php

namespace Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxMessageVerifyNew extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        $countMessageNonLu = \Site\SiteHelper::getSupportMessagesRepository()->countMessagesNonLu($this->objAccount->getId());

        $Message = " message";
        if ($countMessageNonLu > 1) {
            $Message = " messages";
        }
        
        if ($countMessageNonLu == 0) {
            $return = "<i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='Aucun nouveau message' data-tooltip-position='left' style='cursor:pointer; top: 7px; position: relative; margin-left: 7px;' class='material-icons md-icon-chat md-24'></i>";
        } else {

            $return = "<i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='" . $countMessageNonLu . $Message ." non-lu' data-tooltip-position='left' style='cursor:pointer; top: 7px;  margin-left: 7px; position: relative;' class='material-icons text-green md-icon-chat md-22'></i>";
        }

        $Tableau_Retour_Json = array(
            'result' => "WIN",
            'nombre_recu' => $countMessageNonLu,
            'nombre_attente' => 0,
            'reasons' => $return
        );

        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxMessageVerifyNew();
$class->run();
