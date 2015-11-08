<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class CodeEntrepotForgottenEmail extends \PageHelper {

    public $isProtected = true;

    public function run() {
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Code d'entrepôt renvoyé</h3>
            </div>

            <div class="box-body">
                Vous avez reçu un e-mail contenant le code de votre entrepôt.
            </div>
        </div>


        <?php
        /* ------------------------ Vérification Données ---------------------------- */
        $Recuperatio_Entrepot_Password = "SELECT safebox.password FROM account.account
									LEFT JOIN player.safebox
									ON account.id = safebox.account_id
                                    WHERE account.id = ?
									LIMIT 1";
        $Parametres_Entrepot_Password = $this->objConnection->prepare($Recuperatio_Entrepot_Password);
        $Parametres_Entrepot_Password->execute(array(
            $_SESSION['ID']));
        $Parametres_Entrepot_Password->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Entrepot_Password->rowCount();
        /* -------------------------------------------------------------------------- */

        $template = $this->objTwig->loadTemplate("CodeEntrepotForgottenEmail.html5.twig");

        if ($Nombre_De_Resultat > 0) {

            $Donnes_Password = $Parametres_Entrepot_Password->fetch();
            $result = $template->render([
                "password" => $Donnes_Password->password,
            ]);
            
        } else {

            $result = $template->render([
                "password" => "000000",
            ]);
            
        }

        $subject = 'VamosMt2 - Mot de passe entrepot';
        \EmailHelper::sendEmail($_SESSION['Email'], $subject, $result);
    }

}

$class = new CodeEntrepotForgottenEmail();
$class->run();
