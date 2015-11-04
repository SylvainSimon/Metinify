<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_CompteurContacts extends \ScriptHelper {

    public function run() {
        $Blocage_Contacts_Ip = $_SERVER['REMOTE_ADDR'];


        if (empty($_SESSION['Blocage_Contacts']) || ($_SESSION['Blocage_Contacts'] == 0)) {

            echo '1';
            $_SESSION['Blocage_Contacts'] = 1;
        } else {

            if ($_SESSION['Blocage_Contacts'] == 1) {

                echo '2';
                $_SESSION['Blocage_Contacts'] = 2;
            } else if ($_SESSION['Blocage_Contacts'] == 2) {

                echo '3';
                $_SESSION['Blocage_Contacts'] = 3;
            }

            if ($_SESSION['Blocage_Contacts'] >= 3) {

                echo 'Bloquer';
                $_SESSION['Blocage_Contacts'] = 0;

                /* ------------------------------------------ Blocage Inscription ----------------------------------------- */
                $Insertion_Blocage_Contacts = "INSERT INTO site.blocage_contacts (ip, date_de_blocage) 
                                                 VALUES (:ip, NOW())";

                $Parametres_Blocage_Contacts = $this->objConnection->prepare($Insertion_Blocage_Contacts);
                $Parametres_Blocage_Contacts->execute(array(
                    ':ip' => $Blocage_Contacts_Ip));
                /* -------------------------------------------------------------------------------------------------------- */
            }
        }


    }

}

$class = new SQL_CompteurContacts();
$class->run();
