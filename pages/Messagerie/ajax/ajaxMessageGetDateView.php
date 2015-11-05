<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxMessageGetDateView extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
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

        echo \FonctionsUtiles::Formatage_Date_Vue_Vue($Donnees_Recuperation_Date->date_vue);
    }

}

$class = new ajaxMessageGetDateView();
$class->run();
