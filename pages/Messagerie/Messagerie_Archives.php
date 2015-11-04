<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Archives extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Tableaux_Arrays.php'; ?>


        <?php
        if (empty($_SESSION['ID'])) {

            echo "Vous n'êtes pas connecté";
            exit();
        }
        ?>

        <?php
        /* ------------------------ Recuperation discussions  ---------------------------- */
        $Boite_Reception = "SELECT DISTINCT(numero_discussion) FROM site.support_ticket_archives
                             WHERE id_recepteur = ?
                             OR id_emmeteur = ?";
        $Parametres_Boite_Reception = $this->objConnection->prepare($Boite_Reception);
        $Parametres_Boite_Reception->execute(array(
            $_SESSION['ID'],
            $_SESSION['ID']));
        $Parametres_Boite_Reception->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Archives = $Parametres_Boite_Reception->rowCount();
        /* -------------------------------------------------------------------------- */

        /* ------------------------------------- Recuperation discussions  ------------------------------------ */
        $Boite_Reception_Message_Total = "SELECT COUNT(id) AS nombre FROM site.support_ticket_archives
                                  WHERE id_recepteur = ?
                                  OR id_emmeteur = ?";
        $Parametres_Boite_Reception_Message_Total = $this->objConnection->prepare($Boite_Reception_Message_Total);
        $Parametres_Boite_Reception_Message_Total->execute(array(
            $_SESSION['ID'],
            $_SESSION['ID']));
        $Parametres_Boite_Reception_Message_Total->setFetchMode(\PDO::FETCH_OBJ);
        $Donnees_Boite_Reception_Message_Total = $Parametres_Boite_Reception_Message_Total->fetch();
        /* ---------------------------------------------------------------------------------------------------- */
        ?>

        <div class="row">
            <div class="col-lg-3">
                <table class="table table-condensed" style="border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 0px;"  data-tooltip="Nombre de discussion ouverte">Discussions</td>
                        <td style="border-top: 0px;" ><?= $Nombre_De_Resultat_Archives; ?></td>
                    </tr>
                    <tr>
                        <td data-tooltip="Nombre de messages total de la boite de réception">Messages</td>
                        <td><?= $Donnees_Boite_Reception_Message_Total->nombre; ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-9">
                <table class="table table-condensed" style="border-collapse: collapse;">

                    <thead>
                        <tr>
                            <th width="120" data-tooltip="Expediteur du premier message de la discussion">Expediteur</th>
                            <th width="120" data-tooltip="Destinataire du premier message de la discussion">Destinataire</th>
                            <th width="130" data-tooltip="Objet de la discussion">Objet</th>
                            <th width="160" data-tooltip="Premier message de la discussion">Premier Message</th>
                            <th width="210" data-tooltip="Date du début de la discussion">Date</th>
                            <th width="30" data-tooltip="Nombre de messages de la discussion">Nbr.</th>
                        </tr>
                    </thead>

                    <?php
                    /* ------------------------ Listage des Fils  ------------------------------- */
                    $Listage_Fils = "SELECT numero_discussion 
                         FROM site.support_ticket_archives
                         WHERE id_recepteur = ?
                         OR id_emmeteur = ?
                         GROUP BY numero_discussion
                         ORDER by date DESC";
                    $Parametres_Listage_Fils = $this->objConnection->prepare($Listage_Fils);
                    $Parametres_Listage_Fils->execute(array(
                        $_SESSION['ID'],
                        $_SESSION['ID']));
                    $Parametres_Listage_Fils->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Listage_Fils = $Parametres_Listage_Fils->rowCount();
                    /* -------------------------------------------------------------------------- */

                    /* ------------------------ Récuperation Pseudonyme Emmeteur  ------------- */
                    $Pseudo_Messagerie_Emmeteur = "SELECT pseudo_messagerie 
                                       FROM account.account
                                       WHERE id = ?
                                       LIMIT 1";
                    $Parametres_Pseudo_Messagerie_Emmeteur = $this->objConnection->prepare($Pseudo_Messagerie_Emmeteur);
                    /* -------------------------------------------------------------------------- */

                    /* ------------------------ Récuperation Pseudonyme Recepteur  ------------- */
                    $Pseudo_Messagerie_Recepteur = "SELECT pseudo_messagerie 
                                        FROM account.account
                                        WHERE id = ?
                                        LIMIT 1";
                    $Parametres_Pseudo_Messagerie_Recepteur = $this->objConnection->prepare($Pseudo_Messagerie_Recepteur);
                    /* -------------------------------------------------------------------------- */
                    ?>

                    <tbody>

                        <?php if ($Nombre_De_Resultat_Listage_Fils != 0) { ?>

                            <?php while ($Donnees_Listage_Fils = $Parametres_Listage_Fils->fetch()) { ?>

                                <?php
                                /* ------------------------ Recuperation premier message -------------------- */
                                $Recuperation_Premier_Message = "SELECT * FROM site.support_ticket_archives
                                                     WHERE numero_discussion = ?
                                                     ORDER by date ASC";
                                $Parametres_Recuperation_Premier_Message = $this->objConnection->prepare($Recuperation_Premier_Message);
                                $Parametres_Recuperation_Premier_Message->execute(array(
                                    $Donnees_Listage_Fils->numero_discussion));
                                $Parametres_Recuperation_Premier_Message->setFetchMode(\PDO::FETCH_OBJ);
                                $Nombre_De_Resultat_Recuperation_Premier_Message = $Parametres_Recuperation_Premier_Message->rowCount();
                                $Donnees_Recuperation_Premier_Message = $Parametres_Recuperation_Premier_Message->fetch();
                                /* -------------------------------------------------------------------------- */

                                /* ------------ Recuperation du Pseudonyme Emmeteur ----------------------- */
                                $Parametres_Pseudo_Messagerie_Emmeteur->execute(array(
                                    $Donnees_Recuperation_Premier_Message->id_emmeteur));
                                $Parametres_Pseudo_Messagerie_Emmeteur->setFetchMode(\PDO::FETCH_OBJ);
                                $Donnees_Pseudo_Messagerie_Emmeteur = $Parametres_Pseudo_Messagerie_Emmeteur->fetch();
                                /* -------------------------------------------------------------------------- */

                                /* ------------ Recuperation du Pseudonyme Recepteur ----------------------- */
                                $Parametres_Pseudo_Messagerie_Recepteur->execute(array(
                                    $Donnees_Recuperation_Premier_Message->id_recepteur));
                                $Parametres_Pseudo_Messagerie_Recepteur->setFetchMode(\PDO::FETCH_OBJ);
                                $Donnees_Pseudo_Messagerie_Recepteur = $Parametres_Pseudo_Messagerie_Recepteur->fetch();
                                /* -------------------------------------------------------------------------- */
                                ?>

                                <tr onclick="Ajax_Ouverture_Viewer_Messagerie(<?= $Donnees_Recuperation_Premier_Message->id; ?>)" class="Pointer" onmouseover="this.style.backgroundColor = '#333333';" onmouseout="this.style.backgroundColor = 'transparent';">
                                    <td><?= $Donnees_Pseudo_Messagerie_Emmeteur->pseudo_messagerie; ?></td>
                                    <td><?= $Donnees_Pseudo_Messagerie_Recepteur->pseudo_messagerie; ?></td>
                                    <td><?= $Donnees_Recuperation_Premier_Message->objet_message; ?></td>
                                    <td><?= \FonctionsUtiles::Raccourcissement_Chaine($Donnees_Recuperation_Premier_Message->contenue_message, 15); ?></td>
                                    <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Premier_Message->date); ?></td>
                                    <td align="center"><?= $Nombre_De_Resultat_Recuperation_Premier_Message; ?></td>
                                </tr>

                            <?php } ?>

                        <?php } else { ?>
                            <tr><td colspan="7">Aucune de vos discussions n'est stocké en archives.</td></tr>
                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>

        <script type="text/javascript">
            function Ajax_Ouverture_Viewer_Messagerie(id) {

                window.parent.Barre_De_Statut("Ouverture du visualisateur d'archive...");
                window.parent.Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "pages/Messagerie/Messagerie_Viewer.php",
                    data: "id=" + id,
                    success: function (msg) {

                        $("#Contenue_Cadre_Messagerie").fadeOut("medium", function () {
                            $("#Contenue_Cadre_Messagerie").html(msg);
                            window.parent.Barre_De_Statut("Chargement terminé.");
                            window.parent.Icone_Chargement(0);
                            $("#Contenue_Cadre_Messagerie").fadeIn("medium");
                        });

                    }
                });
                return false;
            }
        </script>
        <?php
    }

}

$class = new Messagerie_Archives();
$class->run();
