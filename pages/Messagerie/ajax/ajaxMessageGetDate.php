<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxMessageGetDate extends \PageHelper {

    public function run() {

?>
        
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

        echo \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Date->date);
    }

}

$class = new ajaxMessageGetDate();
$class->run();
