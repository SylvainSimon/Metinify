<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_CompteurCaptcha extends \PageHelper {

    public function run() {

        $Blocage_Inscription_Ip = $_SERVER['REMOTE_ADDR'];


        if (empty($_SESSION['Blocage_Inscription']) || ($_SESSION['Blocage_Inscription'] == 0)) {

            echo '1';
            $_SESSION['Blocage_Inscription'] = 1;
        } else {

            if ($_SESSION['Blocage_Inscription'] == 1) {

                echo '2';
                $_SESSION['Blocage_Inscription'] = 2;
            } else if ($_SESSION['Blocage_Inscription'] == 2) {

                echo '3';
                $_SESSION['Blocage_Inscription'] = 3;
            }

            if ($_SESSION['Blocage_Inscription'] >= 3) {

                echo 'Bloquer';
                $_SESSION['Blocage_Inscription'] = 0;

                /* ------------------------------------------ Blocage Inscription ----------------------------------------- */
                $Insertion_Blocage_Inscription = "INSERT INTO site.blocage_inscription (ip, date_de_blocage) 
                                                 VALUES (:ip, NOW())";

                $Parametres_Blocage_Inscription = $this->objConnection->prepare($Insertion_Blocage_Inscription);
                $Parametres_Blocage_Inscription->execute(array(
                    ':ip' => $Blocage_Inscription_Ip));
                /* -------------------------------------------------------------------------------------------------------- */
            }
        }


    }

}

$class = new SQL_CompteurCaptcha();
$class->run();
