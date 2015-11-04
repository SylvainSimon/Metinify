<?php

require __DIR__ . '/core/initialize.php';

class Activation extends \PageHelper {

    public function run() {

        if (isset($_GET['id'])) {

            /* ------------------------ Recherche Pays ---------------------------- */
            $Recherche_Pays = "SELECT id 
					   FROM account.account 
					   WHERE account.id = :id
					   AND account.status = '.'
					   AND account.email != 'ketur-du-67sang@hotmail.fr'
					   AND account.email != 'anonyma42@outlook.fr'
					   AND account.email != 'marc93izi@live.fr'
					   AND ( not (email like '%yopmail.com' ))
					   ";
            $Parametres_Recherche_Pays = $this->objConnection->prepare($Recherche_Pays);
            $Parametres_Recherche_Pays->execute(array(
                ":id" => $_GET['id']));
            $Parametres_Recherche_Pays->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recherche_Pays = $Parametres_Recherche_Pays->rowCount();
            /* -------------------------------------------------------------------------- */
            if ($Nombre_De_Resultat_Recherche_Pays != 0) {


                /* ----------------- Update Name --------------------- */
                $Update_Name = "UPDATE account.account 
                            SET account.status = ? 
                            WHERE account.id = ?
                            LIMIT 1";

                $Parametres_Update_Name = $this->objConnection->prepare($Update_Name);
                $Parametres_Update_Name->execute(array(
                    "OK",
                    $_GET['id']));
                /* ----------------------------------------------------------- */

                if ($Parametres_Update_Name->rowCount() == "1") {

                    header("LOCATION: index.php?ok");
                } else {
                    echo "Echec de l'activation, ressayez via le lien de L'E-Mail.";
                }
            } else {
                echo "Votre compte semble d&eacute;j&agrave; activ&eacute;";
            }
        }
    }

}

$class = new Activation();
$class->run();
