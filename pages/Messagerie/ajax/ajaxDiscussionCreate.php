<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxDiscussionCreate extends \PageHelper {

    public function run() {

        mt_srand((float) microtime() * 1000000);
        $Nombre_Unique = mt_rand(0, 100000000000);

        /* ------------------------------------------------ Inscription ---------------------------------------------------------------------- */
        $Insertion_Logs = "INSERT INTO site.support_ticket_attente (numero_discussion, id_compte, objet_message, contenue_message, date, ip) 
                          VALUES (:numero_discussion, :id_compte, :objet_message, :contenue_message, NOW(), :ip)";

        $Paremetres_Insertion = $this->objConnection->prepare($Insertion_Logs);
        $Paremetres_Insertion->execute(array(
            ':numero_discussion' => $Nombre_Unique,
            ':id_compte' => $_SESSION['ID'],
            ':objet_message' => $_POST['Nouveau_Ticket_Objet'],
            ':contenue_message' => $_POST['Nouveau_Ticket_Message'],
            ':ip' => $_SERVER['REMOTE_ADDR']));
        /* ----------------------------------------------------------------------------------------------------------------------------------- */

        echo "1";
    }

}

$class = new ajaxDiscussionCreate();
$class->run();
