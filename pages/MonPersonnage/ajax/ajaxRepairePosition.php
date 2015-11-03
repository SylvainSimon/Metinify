<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxRepairePosition extends \PageHelper {

    public function run() {

        $Id_Personnage = $_POST["id_perso"];
        $Ip = $_SERVER["REMOTE_ADDR"];


        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT player.name 
                             FROM player.player
                             WHERE id = ?
                             AND account_id = ?
                             LIMIT 1";
        $Parametres_Verification_Donnees = $this->objConnection->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $Id_Personnage,
            $_SESSION["ID"]));
        $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat != 0) {

            $Selection_Empire = "SELECT empire 
                     FROM player.player_index 
                     WHERE id = ? 
                     LIMIT 1";
            $Parametres_Selection_Empire = $this->objConnection->prepare($Selection_Empire);
            $Parametres_Selection_Empire->execute(array(
                $_SESSION["ID"]));
            $Parametres_Selection_Empire->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Selection_Empire = $Parametres_Selection_Empire->rowCount();

            if ($Nombre_De_Resultat_Selection_Empire != 0) {

                $Donnees_Selection_Empire = $Parametres_Selection_Empire->fetch();

                if ($Donnees_Selection_Empire->empire == "1") {
                    $x = "488774";
                    $y = "955480";
                    $map = "1";
                } elseif ($Donnees_Selection_Empire->empire == "2") {
                    $x = "64305";
                    $y = "186753";
                    $map = "21";
                } elseif ($Donnees_Selection_Empire->empire == "3") {
                    $x = "963684";
                    $y = "285235";
                    $map = "41";
                }

                /* ----------------- Update Coordonées --------------------- */
                $Update_Coordonees = "UPDATE player.player 
                          SET map_index = ?, 
                              x = ?,
                              y = ?,
                              exit_map_index = ?,
                              exit_x = ?,
                              exit_y = ?
                          WHERE id = ?";

                $Parametres_Update_Coordonees = $this->objConnection->prepare($Update_Coordonees);
                $Parametres_Update_Coordonees->execute(array(
                    $map,
                    $x,
                    $y,
                    $map,
                    $x,
                    $y,
                    $Id_Personnage));
                /* ----------------------------------------------------------- */

                /* -------------------------------------------- Insertion logs ----------------- */
                $Insertion_Logs = "INSERT INTO site.logs_deblocage_persos (id_perso, id_compte, map_index, date, ip) 
                              VALUES (:id_perso, :id_compte, :map_index, NOW(), :ip)";

                $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                $Parametres_Insertion->execute(array(
                    ':id_perso' => $Id_Personnage,
                    ':id_compte' => $_SESSION["ID"],
                    ':map_index' => $map,
                    ':ip' => $Ip));
                /* ----------------------------------------------------------------------------- */
            } else {
                echo "NOT_EMPIRE";
            }
        } else {
            echo "NOT_YOU";
        }
    }

}

$class = new ajaxRepairePosition();
$class->run();
