<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPseudoCreate extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {

        $Definition_Pseudo_Messagerie_Pseudo = $_POST['Pseudo'];
        $Definition_Pseudo_Messagerie_ID = $_SESSION['ID'];

        /* ----------------- Update Email --------------------- */
        $Update_Mail = "UPDATE account.account 
                SET pseudo_messagerie = ? 
                WHERE id = ?
                LIMIT 1";

        $Parametres_Update_Email = $this->objConnection->prepare($Update_Mail);
        $Parametres_Update_Email->execute(array(
            $Definition_Pseudo_Messagerie_Pseudo,
            $Definition_Pseudo_Messagerie_ID));
        /* ----------------------------------------------------------- */

        $_SESSION['Pseudo_Messagerie'] = $Definition_Pseudo_Messagerie_Pseudo;

        echo "1";
    }

}

$class = new ajaxPseudoCreate();
$class->run();
