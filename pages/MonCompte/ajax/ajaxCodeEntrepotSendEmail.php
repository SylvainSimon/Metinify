<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxCodeEntrepotSendEmail extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        $objSafebox = \Player\PlayerHelper::getSafeboxRepository()->findByIdCompte($this->objAccount->getId());
        $template = $this->objTwig->loadTemplate("CodeEntrepotForgottenEmail.html5.twig");

        if ($objSafebox !== null) {
            $result = $template->render([
                "password" => $objSafebox->getPassword(),
            ]);
        } else {

            $result = $template->render([
                "password" => "000000",
            ]);
        }
        $subject = 'VamosMt2 - Mot de passe entrepot';
        \EmailHelper::sendEmail($this->objAccount->getEmail(), $subject, $result);

        echo json_encode(["result" => true]);
    }

}

$class = new ajaxCodeEntrepotSendEmail();
$class->run();
