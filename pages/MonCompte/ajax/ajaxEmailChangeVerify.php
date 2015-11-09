<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxEmailChangeVerify extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $numeroVerif = $request->request->get("code");
        
        $objChangementMail = \Site\SiteHelper::getChangementMailRepository()->findByIdCompteAndNumeroVerif($this->objAccount->getId(), $numeroVerif);

        if ($objChangementMail !== null) {
            echo "1";
        } else {
            echo "2";
        }
    }

}

$class = new ajaxEmailChangeVerify();
$class->run();
