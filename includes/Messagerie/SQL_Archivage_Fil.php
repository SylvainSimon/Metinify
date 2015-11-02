<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class SQL_Archivage_Fil extends \PageHelper {

    public function run() {

        $ID_Message = $_POST['id'];

        /* ----------------------- Recuperation Date ------------------------------- */
        $Verification_Proprietaire = "SELECT * FROM site.support_ticket_traitement
                                  WHERE id = ?
                                  AND (id_recepteur = ? OR id_emmeteur = ?)
                                  LIMIT 1";
        $Parametres_Verification_Proprietaire = $this->objConnection->prepare($Verification_Proprietaire);
        $Parametres_Verification_Proprietaire->execute(array(
            $ID_Message,
            $_SESSION["ID"],
            $_SESSION["ID"]));
        $Parametres_Verification_Proprietaire->setFetchMode(\PDO::FETCH_OBJ);
        $Donnees_Verification_Proprietaire = $Parametres_Verification_Proprietaire->fetch();
        $Nombre_De_Resultat_Verification_Proprietaire = $Parametres_Verification_Proprietaire->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat_Verification_Proprietaire > 0) {

            /* ----------------------- Recuperation Date ------------------------------- */
            $Selection_Lignes = "SELECT * FROM site.support_ticket_traitement
                                  WHERE numero_discussion = ?";
            $Parametres_Selection_Lignes = $this->objConnection->prepare($Selection_Lignes);
            $Parametres_Selection_Lignes->execute(array(
                $Donnees_Verification_Proprietaire->numero_discussion));
            $Parametres_Selection_Lignes->setFetchMode(\PDO::FETCH_OBJ);
            /* -------------------------------------------------------------------------- */

            while ($Donnees_Selection_Lignes = $Parametres_Selection_Lignes->fetch()) {
                /* ------------------------------------------------ Insertion ---------------------------------------------------------------------- */
                $Insertion_Logs = "INSERT INTO site.support_ticket_archives (id, id_emmeteur, id_recepteur, numero_discussion, objet_message, contenue_message, date, ip, etat, date_vue, type) 
                          VALUES (:id, :id_emmeteur, :id_recepteur, :numero_discussion, :objet_message, :contenue_message, :date, :ip, :etat, :date_vue, :type)";

                $Paremetres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                $Paremetres_Insertion->execute(array(
                    ':id' => $Donnees_Selection_Lignes->id,
                    ':id_emmeteur' => $Donnees_Selection_Lignes->id_emmeteur,
                    ':id_recepteur' => $Donnees_Selection_Lignes->id_recepteur,
                    ':numero_discussion' => $Donnees_Selection_Lignes->numero_discussion,
                    ':objet_message' => $Donnees_Selection_Lignes->objet_message,
                    ':contenue_message' => $Donnees_Selection_Lignes->contenue_message,
                    ':date' => $Donnees_Selection_Lignes->date,
                    ':ip' => $Donnees_Selection_Lignes->ip,
                    ':etat' => $Donnees_Selection_Lignes->etat,
                    ':date_vue' => $Donnees_Selection_Lignes->date_vue,
                    ':type' => $Donnees_Selection_Lignes->type));
                /* ----------------------------------------------------------------------------------------------------------------------------------- */
            }

            /* ----------------------- Suppression du ticket en attente ------------------------------------ */
            $Requete_Suppression_Contenue_Site = "DELETE FROM site.support_ticket_traitement
                                             WHERE numero_discussion = ?";
            $Preparation_Suppression_Contenue_Site = $this->objConnection->prepare($Requete_Suppression_Contenue_Site);
            $Preparation_Suppression_Contenue_Site->execute(array($Donnees_Verification_Proprietaire->numero_discussion));
            /* --------------------------------------------------------------------------------------------- */

            echo "1";
        } else {

            echo "NON";
        }
    }

}

$class = new SQL_Archivage_Fil();
$class->run();
