<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Code_Effacement_Definir extends \PageHelper {

    public function run() {


        $Code_Effacement_Definir_Code = $_POST['Code_Effacement'];
        $Code_Effacement_Definir_ID = $_SESSION['ID'];
        $Code_Effacement_Definir_Utilisateur = $_SESSION['Utilisateur'];
        $Code_Effacement_Definir_Ip = $_SERVER["REMOTE_ADDR"];

        /* ----------------------------- Definir Code Effacement ------------------------------- */
        $Definir_Code_Effacement = "UPDATE account.account 
                            SET social_id = ? 
                            WHERE id = ?
                            LIMIT 1";

        $Parametres_Definir_Code_Effacement = $this->objConnection->prepare($Definir_Code_Effacement);
        $Parametres_Definir_Code_Effacement->execute(array(
            $Code_Effacement_Definir_Code,
            $Code_Effacement_Definir_ID));
        /* ------------------------------------------------------------------------------------- */

        /* ------------------------------------- Insertion Logs Definition Effacement --------------------------------------- */
        $Insertion_Logs_Definition_Effacement = "INSERT INTO site.logs_code_effacement_definition (id_compte, compte, code, date, ip) 
                                          VALUES (:id_compte, :compte, :code, NOW(), :ip)";

        $Parametres_Insertion_Logs_Definition_Effacement = $this->objConnection->prepare($Insertion_Logs_Definition_Effacement);
        $Parametres_Insertion_Logs_Definition_Effacement->execute(array(
            ':id_compte' => $Code_Effacement_Definir_ID,
            ':compte' => $Code_Effacement_Definir_Utilisateur,
            ':code' => $Code_Effacement_Definir_Code,
            ':ip' => $Code_Effacement_Definir_Ip));
        /* ----------------------------------------------------------------------------------------------------------------- */

        echo '1';
?>
        <?php

    }

}

$class = new SQL_Code_Effacement_Definir();
$class->run();
