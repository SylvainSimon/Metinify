<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Code_Entrepot_Changer extends \PageHelper {

    public function run() {

        $Code_Entrepot_Changer_Code_Avant = $_POST['Code_Avant'];
        $Code_Entrepot_Changer_Code = $_POST['Code_Entrepot'];
        $Code_Entrepot_Changer_ID = $_SESSION['ID'];
        $Code_Entrepot_Changer_Utilisateur = $_SESSION['Utilisateur'];
        $Code_Entrepot_Changer_Ip = $_SERVER["REMOTE_ADDR"];

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Code = "SELECT size FROM player.safebox
                                   WHERE (password = ?
                                   OR password = ?)
                                   AND account_id = ?
                                   LIMIT 1";
        $Parametres_Verification_Code = $this->objConnection->prepare($Verification_Code);
        $Parametres_Verification_Code->execute(array(
            $Code_Entrepot_Changer_Code_Avant,
            "",
            $Code_Entrepot_Changer_ID));
        $Parametres_Verification_Code->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Code->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat != 0) {
            /* ----------------------------- Changer Code Entrepot ------------------------------- */
            $Changer_Code_Entrepot = "UPDATE player.safebox 
                            SET password = ? 
                            WHERE account_id = ?
                            LIMIT 1";

            $Parametres_Changer_Code_Entrepot = $this->objConnection->prepare($Changer_Code_Entrepot);
            $Parametres_Changer_Code_Entrepot->execute(array(
                $Code_Entrepot_Changer_Code,
                $Code_Entrepot_Changer_ID));
            /* ------------------------------------------------------------------------------------- */

            /* ------------------------------------- Insertion Logs Changement Entrepot --------------------------------------- */
            $Insertion_Logs_Changement_Entrepot = "INSERT INTO site.logs_code_entrepot_changement (id_compte, compte, ancien_code, nouveau_code, date, ip) 
                                          VALUES (:id_compte, :compte, :ancien_code, :nouveau_code, NOW(), :ip)";

            $Parametres_Insertion_Logs_Changement_Entrepot = $this->objConnection->prepare($Insertion_Logs_Changement_Entrepot);
            $Parametres_Insertion_Logs_Changement_Entrepot->execute(array(
                ':id_compte' => $Code_Entrepot_Changer_ID,
                ':compte' => $Code_Entrepot_Changer_Utilisateur,
                ':ancien_code' => $Code_Entrepot_Changer_Code_Avant,
                ':nouveau_code' => $Code_Entrepot_Changer_Code,
                ':ip' => $Code_Entrepot_Changer_Ip));
            /* ----------------------------------------------------------------------------------------------------------------- */

            echo '1';
        } else {

            echo '2';
        }
?>
        <?php

    }

}

$class = new SQL_Code_Entrepot_Changer();
$class->run();
