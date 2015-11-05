<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Boite_De_Reception extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {

        include '../../pages/Tableaux_Arrays.php';

        /* ------------------------ Recuperation discussions  ---------------------------- */
        $Boite_Reception = "SELECT DISTINCT(numero_discussion) FROM site.support_ticket_traitement
                             WHERE id_recepteur = ?
                             ORDER by date DESC";
        $Parametres_Boite_Reception = $this->objConnection->prepare($Boite_Reception);
        $Parametres_Boite_Reception->execute(array(
            $_SESSION['ID']));
        $Parametres_Boite_Reception->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Boite_Reception = $Parametres_Boite_Reception->rowCount();
        /* -------------------------------------------------------------------------- */

        /* ------------------------------------- Recuperation discussions  ------------------------------------ */
        $Boite_Reception_Message_Total = "SELECT COUNT(id) AS nombre FROM site.support_ticket_traitement
                                  WHERE id_recepteur = ?
                                  OR id_emmeteur = ?";
        $Parametres_Boite_Reception_Message_Total = $this->objConnection->prepare($Boite_Reception_Message_Total);
        $Parametres_Boite_Reception_Message_Total->execute(array(
            $_SESSION['ID'],
            $_SESSION['ID']));
        $Parametres_Boite_Reception_Message_Total->setFetchMode(\PDO::FETCH_OBJ);
        $Donnees_Boite_Reception_Message_Total = $Parametres_Boite_Reception_Message_Total->fetch();
        /* ---------------------------------------------------------------------------------------------------- */

        /* ------------------------------------- Recuperation discussions  ------------------------------------ */
        $Boite_Reception_Message_Non_Lu = "SELECT COUNT(id) AS nombre FROM site.support_ticket_traitement
                                  WHERE id_recepteur = ?
                                  AND etat= 'Non-Lu'";
        $Parametres_Boite_Reception_Message_Non_Lu = $this->objConnection->prepare($Boite_Reception_Message_Non_Lu);
        $Parametres_Boite_Reception_Message_Non_Lu->execute(array(
            $_SESSION['ID']));
        $Parametres_Boite_Reception_Message_Non_Lu->setFetchMode(\PDO::FETCH_OBJ);
        $Donnees_Boite_Reception_Message_Non_Lu = $Parametres_Boite_Reception_Message_Non_Lu->fetch();
        /* ---------------------------------------------------------------------------------------------------- */

        /* ------------------------ Recuperation premier message non-lu  ---------------------------- */
        $Boite_Reception_Dernier_Message_NonLu = "SELECT * FROM site.support_ticket_traitement
                                          WHERE numero_discussion = ?
                                          AND etat = 'Non-Lu'
                                          AND id_emmeteur != ?
                                          ORDER by date ASC
                                          LIMIT 1";
        $Parametres_Reception_Dernier_Message_NonLu = $this->objConnection->prepare($Boite_Reception_Dernier_Message_NonLu);
        /* -------------------------------------------------------------------------- */

        /* ------------------------ Recuperation dernier message  ---------------------------- */
        $Boite_Reception_Dernier_Message = "SELECT * FROM site.support_ticket_traitement
                             WHERE numero_discussion = ?
                             AND id_emmeteur != ?
                             ORDER by date DESC
                             LIMIT 1";
        $Parametres_Reception_Dernier_Message = $this->objConnection->prepare($Boite_Reception_Dernier_Message);
        /* -------------------------------------------------------------------------- */

        /* ------------------------ Recuperation pseudo chat  --------------------------- */
        $Pseudo_Messagerie = "SELECT pseudo_messagerie 
                      FROM account.account
                      WHERE id = ?
                      LIMIT 1";
        $Parametres_Pseudo_Messagerie = $this->objConnection->prepare($Pseudo_Messagerie);
        /* ------------------------------------------------------------------------------ */
        ?>
        <div class="row">
            <div class="col-lg-3">
                <table class="table table-condensed" style="border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 0px;" title="Nombre de discussion ouverte">Discussions</td>
                        <td style="border-top: 0px;"><?= $Nombre_De_Resultat_Boite_Reception; ?></td>
                    </tr>
                    <tr>
                        <td title="Nombre de messages total de la boite de réception">Messages</td>
                        <td><?= $Donnees_Boite_Reception_Message_Total->nombre; ?></td>
                    </tr>
                    <tr>
                        <td title="Nombre de message non-lu dans la boite de réception">Non-lu</td>
                        <td><?= $Donnees_Boite_Reception_Message_Non_Lu->nombre; ?></td>
                    </tr>
                </table>
            </div>
            
            <div class="col-lg-9">
                <table class="table table-condensed" style="border-collapse: collapse;">

                    <thead>
                        <tr>
                            <th width="140">Dernier acteur</th>
                            <th width="130">Objet</th>
                            <th>Contenue</th>
                            <th width="240">Date</th>
                            <th width="50">Etat</th>
                            <th width="60">Type</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($Nombre_De_Resultat_Boite_Reception != 0) { ?>
                            <?php while ($Donnees_Ticket_Attente = $Parametres_Boite_Reception->fetch()) { ?>
                                <?php
                                $Parametres_Reception_Dernier_Message_NonLu->execute(array(
                                    $Donnees_Ticket_Attente->numero_discussion,
                                    $_SESSION['ID']));
                                $Parametres_Reception_Dernier_Message_NonLu->setFetchMode(\PDO::FETCH_OBJ);
                                $Nombre_De_Resultat_Reception_Dernier_Message_NonLu = $Parametres_Reception_Dernier_Message_NonLu->rowCount();
                                ?>

                                <?php if ($Nombre_De_Resultat_Reception_Dernier_Message_NonLu != 0) { ?>
                                    <?php $Donnees_Reception_Dernier_Message_NonLu = $Parametres_Reception_Dernier_Message_NonLu->fetch(); ?>

                                    <tr style="background: #333333;" title="Cliquez pour ouvrire la fil de discussion" class="Pointer" onclick="Ajax_Ouverture_Ticket(<?php echo $Donnees_Reception_Dernier_Message_NonLu->id ?>)" onmouseover="this.style.backgroundColor = '#333333';" onmouseout="this.style.backgroundColor = '#222222';">

                                        <?php
                                        $Parametres_Pseudo_Messagerie->execute(array(
                                            $Donnees_Reception_Dernier_Message_NonLu->id_emmeteur));
                                        $Parametres_Pseudo_Messagerie->setFetchMode(\PDO::FETCH_OBJ);
                                        $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch();
                                        ?>

                                        <td><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></td>
                                        <td><?= $Donnees_Reception_Dernier_Message_NonLu->objet_message; ?></td>
                                        <td><?= \FonctionsUtiles::Raccourcissement_Chaine($Donnees_Reception_Dernier_Message_NonLu->contenue_message, 10); ?></td>
                                        <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Reception_Dernier_Message_NonLu->date); ?></td>
                                        <td><?= $Donnees_Reception_Dernier_Message_NonLu->etat; ?></td>
                                        <td><?= $Donnees_Reception_Dernier_Message_NonLu->type; ?></td>

                                    </tr>

                                <?php } else { ?>

                                    <?php
                                    $Parametres_Reception_Dernier_Message->execute(array(
                                        $Donnees_Ticket_Attente->numero_discussion,
                                        $_SESSION['ID']));
                                    $Parametres_Reception_Dernier_Message->setFetchMode(\PDO::FETCH_OBJ);
                                    $Nombre_De_Resultat_Reception_Dernier_Message = $Parametres_Reception_Dernier_Message->rowCount();
                                    ?>
                                    <?php if ($Nombre_De_Resultat_Reception_Dernier_Message != 0) { ?>
                                        <?php $Donnees_Reception_Dernier_Message = $Parametres_Reception_Dernier_Message->fetch(); ?>

                                        <?php
                                        if ($Donnees_Reception_Dernier_Message->id_emmeteur == $_SESSION["ID"]) {
                                            $Parametres_Pseudo_Messagerie->execute(array(
                                                $Donnees_Reception_Dernier_Message->id_recepteur));
                                            $Parametres_Pseudo_Messagerie->setFetchMode(\PDO::FETCH_OBJ);
                                            $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch();
                                        } else {
                                            $Parametres_Pseudo_Messagerie->execute(array(
                                                $Donnees_Reception_Dernier_Message->id_emmeteur));
                                            $Parametres_Pseudo_Messagerie->setFetchMode(\PDO::FETCH_OBJ);
                                            $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch();
                                        }
                                        ?>

                                        <tr title="Cliquez pour ouvrire la fil de discussion" class="Pointer" onclick="Ajax_Ouverture_Ticket(<?php echo $Donnees_Reception_Dernier_Message->id ?>)" onmouseover="this.style.backgroundColor = '#333333';" onmouseout="this.style.backgroundColor = 'transparent';">
                                            <td><?= $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></td>
                                            <td><?= $Donnees_Reception_Dernier_Message->objet_message; ?></td>
                                            <td><?= \FonctionsUtiles::Raccourcissement_Chaine($Donnees_Reception_Dernier_Message->contenue_message, 15); ?></td>
                                            <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Reception_Dernier_Message->date); ?></td>
                                            <td><?= $Donnees_Reception_Dernier_Message->etat; ?></td>
                                            <td><?= $Donnees_Reception_Dernier_Message->type; ?></td>
                                        </tr>

                                    <?php } ?>
                                <?php } ?>

                                </tr>
                            <?php } ?>

                        <?php } else { ?>
                        <td colspan="6">Vous n'avez reçu aucun messages</td>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

}

$class = new Messagerie_Boite_De_Reception();
$class->run();
