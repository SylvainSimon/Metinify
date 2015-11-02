<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class SQL_Actualiser_Vue extends \PageHelper {

    public function run() {

        $etat = $_POST['etat'];

        $id = explode("Message_", $_POST['id']);

        /* ----------------- Update Email --------------------- */
        $Update_Vue = "UPDATE site.support_ticket_traitement 
                SET etat = ?, date_vue = NOW()
                WHERE id = ?
                LIMIT 1";

        $Parametres_Update_Vue = $this->objConnection->prepare($Update_Vue);
        $Parametres_Update_Vue->execute(array(
            "Lu",
            $id[1]));
        /* ----------------------------------------------------------- */

        echo "1";
    }

}

$class = new SQL_Actualiser_Vue();
$class->run();
