<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Notification extends \PageHelper {

    public function run() {

        if (!empty($_SESSION["ID"])) {


            /* ------------------------ Vérification Données ---------------------------- */
            $Recuperation_Droits = "SELECT * 
                            FROM site.administration_users
                            WHERE id_compte = :id_compte
                            AND administration_users.support_ticket = 1
                            LIMIT 1";
            $Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
            $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
            $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
            /* -------------------------------------------------------------------------- */

            if ($Nombre_De_Resultat_Recuperation_Droits != 0) {

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Discussion_Attente = "SELECT numero_discussion
                                      FROM site.support_ticket_attente";
                $Parametres_Nombre_Discussion_Attente = $this->objConnection->prepare($Nombre_Discussion_Attente);
                $Parametres_Nombre_Discussion_Attente->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Discussion_Attente = $Parametres_Nombre_Discussion_Attente->rowCount();
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Message_Traitement = "SELECT id
                                      FROM site.support_ticket_traitement
                                      WHERE support_ticket_traitement.id_recepteur = :id_compte
                                      AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Message_Traitement = $this->objConnection->prepare($Nombre_Message_Traitement);
                $Parametres_Nombre_Message_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Message_Traitement = $Parametres_Nombre_Message_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Discussion_Traitement = "SELECT DISTINCT numero_discussion
                                         FROM site.support_ticket_traitement
                                         WHERE support_ticket_traitement.id_recepteur = :id_compte
                                         AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Discussion_Traitement = $this->objConnection->prepare($Nombre_Discussion_Traitement);
                $Parametres_Nombre_Discussion_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Discussion_Traitement = $Parametres_Nombre_Discussion_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                $Message = "message";
                if ($Nombre_De_Resultat_Message_Traitement > 1) {
                    $Message = "messages";
                }
                $Discussion = "discussion";
                if ($Nombre_De_Resultat_Discussion_Traitement > 1) {
                    $Discussion = "discussions";
                }
                $Attente = "ticket";
                if ($Nombre_De_Resultat_Discussion_Attente > 1) {
                    $Attente = "tickets";
                }

                $Tableau_Retour_Json = array(
                    'result' => "WIN",
                    'nombre_attente' => $Nombre_De_Resultat_Discussion_Attente,
                    'nombre_recu' => $Nombre_De_Resultat_Message_Traitement,
                    'reasons' => "Vous avez <span id='Nombre_Message_Non_Lu'>" . $Nombre_De_Resultat_Message_Traitement . "</span> " . $Message . " dans " . $Nombre_De_Resultat_Discussion_Traitement . " " . $Discussion . " (" . $Nombre_De_Resultat_Discussion_Attente . " " . $Attente . " en attente)."
                );
            } else {

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Message_Traitement = "SELECT id
                                      FROM site.support_ticket_traitement
                                      WHERE support_ticket_traitement.id_recepteur = :id_compte
                                      AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Message_Traitement = $this->objConnection->prepare($Nombre_Message_Traitement);
                $Parametres_Nombre_Message_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Message_Traitement = $Parametres_Nombre_Message_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Discussion_Traitement = "SELECT DISTINCT numero_discussion
                                         FROM site.support_ticket_traitement
                                         WHERE support_ticket_traitement.id_recepteur = :id_compte
                                         AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Discussion_Traitement = $this->objConnection->prepare($Nombre_Discussion_Traitement);
                $Parametres_Nombre_Discussion_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Discussion_Traitement = $Parametres_Nombre_Discussion_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                $Message = "message";
                if ($Nombre_De_Resultat_Message_Traitement > 1) {
                    $Message = "messages";
                }
                $Discussion = "discussion";
                if ($Nombre_De_Resultat_Discussion_Traitement > 1) {
                    $Discussion = "discussions";
                }

                $Tableau_Retour_Json = array(
                    'result' => "WIN",
                    'nombre_attente' => "NO",
                    'nombre_recu' => $Nombre_De_Resultat_Message_Traitement,
                    'reasons' => "Vous avez <span id='Nombre_Message_Non_Lu'>" . $Nombre_De_Resultat_Message_Traitement . "</span> " . $Message . " dans " . $Nombre_De_Resultat_Discussion_Traitement . " " . $Discussion . "."
                );
?>
            <?php } ?>
        <?php } else { ?>
            <?php

            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Vous êtes déconnecter"
            );
            ?>
        <?php } ?>
        <?php echo json_encode($Tableau_Retour_Json); ?>
        <?php

    }

}

$class = new SQL_Notification();
$class->run();
