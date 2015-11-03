<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Ticket_Attente extends \PageHelper {

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
        /* ------------------------ Recuperation messages reçus  ---------------------------- */
        $Ticket_Attente = "SELECT * FROM site.support_ticket_attente
                                             ORDER by date DESC";
        $Parametres_Ticket_Attente = $this->objConnection->prepare($Ticket_Attente);
        $Parametres_Ticket_Attente->execute(array(
            $_SESSION['ID']));
        $Parametres_Ticket_Attente->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Boite_Reception = $Parametres_Ticket_Attente->rowCount();
        /* -------------------------------------------------------------------------- */

        /* ------------------------ Recuperation pseudo chat  --------------------------- */
        $Pseudo_Messagerie = "SELECT pseudo_messagerie 
                                        FROM account.account
                                        WHERE id = ?
                                        LIMIT 1";
        $Parametres_Pseudo_Messagerie = $this->objConnection->prepare($Pseudo_Messagerie);
        /* ------------------------------------------------------------------------------ */
        ?>

        <script type="text/javascript">

            function Assignation_Ticket(numero_discussion) {

                window.parent.Barre_De_Statut("Assignation et déplacement du ticket...");
                window.parent.Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "ajax/ajaxDiscussionAssign.php",
                    data: "Numero_Discussion=" + numero_discussion,
                    success: function (msg) {

                        if (msg == "NULL") {

                            window.parent.Barre_De_Statut("Le message n'existe plus.");
                            window.parent.Icone_Chargement(2);

                        } else {

                            Ajax_Ouverture_Ticket(msg);
                        }
                    }
                });
            }

        </script>

        <table id="Tableau_Recapitulatif_Attente">
            <tr>
                <th colspan="2">Récapitulatif :</th>
            </tr>
            <tr>
                <td class="Colonne_Gauche" title="Nombre de discussion ouverte">Tickets en attente :</td>
                <td><?= $Nombre_De_Resultat_Boite_Reception; ?></td>
            </tr>
        </table>

        <div class="Zone_Boite_de_Reception">

            <table class="Tableau_Boite_de_Reception">

                <thead>
                    <tr>
                        <th width="25">ID</th>
                        <th width="180">Objet</th>
                        <th width="100">Contenue</th>
                        <th width="150">Expediteur</th>
                        <th width="250">Date</th>
                        <th title="Ip de l'expediteur" width="100">IP Exp.</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if ($Nombre_De_Resultat_Boite_Reception != 0) { ?>
                        <?php while ($Donnees_Ticket_Attente = $Parametres_Ticket_Attente->fetch()) { ?>
                            <tr onclick="Assignation_Ticket(<?php echo $Donnees_Ticket_Attente->numero_discussion; ?>);" class="Pointer" onmouseover="this.style.backgroundColor = '#333333';" onmouseout="this.style.backgroundColor = 'transparent';">

                                <td><?php echo $Donnees_Ticket_Attente->numero_discussion; ?></td>
                                <td><?php echo $Donnees_Ticket_Attente->objet_message; ?></td>
                                <?php
                                $chaineCoupe = substr($Donnees_Ticket_Attente->contenue_message, 0, 15);
                                ?>
                                <td><?php echo htmlentities($chaineCoupe . "..."); ?></td>

                                <?php
                                $Parametres_Pseudo_Messagerie->execute(array(
                                    $Donnees_Ticket_Attente->id_compte));
                                $Parametres_Pseudo_Messagerie->setFetchMode(\PDO::FETCH_OBJ);
                                $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch()
                                ?>
                                <td><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></td>
                                <td><?php echo \FonctionsUtiles::Formatage_Date($Donnees_Ticket_Attente->date); ?></td>
                                <td><?php echo $Donnees_Ticket_Attente->ip; ?></td>
                            </tr>
                        <?php } ?>

                    <?php } else { ?>
                    <td colspan="6">Aucun messages en attente.</td>
                <?php } ?>

                </tbody>
            </table>


        </div>

        <?php
    }

}

$class = new Messagerie_Ticket_Attente();
$class->run();
