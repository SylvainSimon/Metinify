<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class CodeEntrepotForgottenEmail extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "CodeEntrepotForgotten.html5.twig";

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


        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new CodeEntrepotForgottenEmail();
$class->run();
