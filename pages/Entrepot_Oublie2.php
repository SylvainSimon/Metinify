<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Entrepot_Oublie2 extends \PageHelper {

    public function run() {
        ?>

        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Code d'entrep&ocirc;t oubli&eacute;</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                <p>
                    Si vous d&eacute;sirez recevoir votre code d'entrep&ecirc;t par E-Mail cliquez ci-dessous:
                </p>
                <hr class="Hr_Bas"/>
            </div>
        </form>
        </div>

        <?php include_once '../configPDO.php'; ?>

        <?php
        $Mot_De_Passe_Oublie_Compte = $_POST['Mot_De_Passe_Oublie_Compte'];
        $Mot_De_Passe_Oublie_Email = $_POST['Mot_De_Passe_Oublie_Email'];
        $Mot_De_Passe_Oublie_Ip = $_SERVER["REMOTE_ADDR"];
        $Mot_De_Passe_Oublie_Resultat = "";

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT id FROM account.account
                                   WHERE login = ?
                                   AND email = ?
                                   LIMIT 1";
        $Parametres_Verification_Donnees = $Connexion->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $Mot_De_Passe_Oublie_Compte,
            $Mot_De_Passe_Oublie_Email));
        $Parametres_Verification_Donnees->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
        /* -------------------------------------------------------------------------- */



        $to = $Mot_De_Passe_Oublie_Email;

        $subject = 'VamosMt2 - Mot de passe entrepôt';

        $headers = "From: \"VamosMt2\" <noreplay@vamosmt2.org>" . "\n";
        $headers .= "Reply-to: \"VamosMt2\" <noreplay@vamosmt2.org>" . "\r\n";
        $headers .= 'Mime-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "\r\n";

        $msg = 'Bonjour, suite à votre demande de mot de passe entrepôt' . "<br/>";
        $msg .= 'Vous le trouverez ci-joint.' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Mot de passe entrepôt : ' . $Mot_De_Passe_Generer . '' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Veillez a ne plus l\'oubliez à l\'avenir ;)' . "<br/>";
        $msg .= '' . "<br/>";

        mail($to, $subject, $msg, $headers);


        /* ----------------- Update mot de passe --------------------- */
        $Update_Mot_De_Passe = "UPDATE account.account 
                               SET password=password(?) 
                               WHERE login=?";

        $Parametres_Update = $Connexion->prepare($Update_Mot_De_Passe);
        $Parametres_Update->execute(array(
            $Mot_De_Passe_Generer,
            $Mot_De_Passe_Oublie_Compte));
        /* ----------------------------------------------------------- */

        $Mot_De_Passe_Oublie_Resultat = "1";

    }

}

$class = new Entrepot_Oublie2();
$class->run();
