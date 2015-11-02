<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class SQL_Recuperation_Date_Vue extends \PageHelper {

    public function run() {

?>
        <?php include '../../pages/Fonctions_Utiles.php'; ?>
        <?php

        $ID_Message = $_POST['id'];

        /* ----------------------- Recuperation Date ------------------------------- */
        $Recuperation_Date = "SELECT * FROM site.support_ticket_traitement
                                  WHERE id = ?
                                  LIMIT 1";
        $Parametres_Recuperation_Date = $this->objConnection->prepare($Recuperation_Date);
        $Parametres_Recuperation_Date->execute(array(
            $ID_Message));
        $Parametres_Recuperation_Date->setFetchMode(\PDO::FETCH_OBJ);
        $Donnees_Recuperation_Date = $Parametres_Recuperation_Date->fetch();
        /* -------------------------------------------------------------------------- */

        echo Formatage_Date_Vue($Donnees_Recuperation_Date->date_vue);
    }

}

$class = new SQL_Recuperation_Date_Vue();
$class->run();
