<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class VerifUtilisateur extends \PageHelper {

    public function run() {

        $Verification_Disponibilite_Pseudo = $_GET["pseudo"];

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Disponibilite = "SELECT id 
                                    FROM account.account 
                                    WHERE login = ?
                                    LIMIT 1";
        $Parametres_Verification_Disponibilite = $this->objConnection->prepare($Verification_Disponibilite);
        $Parametres_Verification_Disponibilite->execute(array(
            $Verification_Disponibilite_Pseudo));
        $Parametres_Verification_Disponibilite->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Disponibilite->rowCount();
        /* -------------------------------------------------------------------------- */


        if ($Nombre_De_Resultat > 0) {
            echo "1";
        } else {
            echo "2";
        }
    }

}

$class = new VerifUtilisateur();
$class->run();
