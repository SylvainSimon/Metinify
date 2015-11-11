<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Viewer extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        include '../../pages/Tableaux_Arrays.php';

        /* ------------------------ Informations de Base ---------------------------- */
        $Informations_De_Base = "SELECT * FROM site.support_ticket_archives
                                  WHERE id = ?
                                  LIMIT 1";
        $Parametres_Informations_De_Base = $this->objConnection->prepare($Informations_De_Base);
        $Parametres_Informations_De_Base->execute(array(
            $_POST["id"]));
        $Parametres_Informations_De_Base->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Informations_De_Base = $Parametres_Informations_De_Base->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>
        <?php if ($Nombre_De_Resultat_Informations_De_Base != 0) { ?>

            <?php $Donnees_Informations_De_Base = $Parametres_Informations_De_Base->fetch(); ?>
            <?php
            /* ------------------------ Recuperation pseudo chat  --------------------------- */
            $Pseudo_Messagerie = "SELECT pseudo_messagerie 
                          FROM account.account
                          WHERE id = ?
                          LIMIT 1";
            $Parametres_Pseudo_Messagerie = $this->objConnection->prepare($Pseudo_Messagerie);
            $Parametres_Pseudo_Messagerie->execute(array(
                $Donnees_Informations_De_Base->id_emmeteur));
            $Parametres_Pseudo_Messagerie->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch();
            /* ------------------------------------------------------------------------------ */

            /* ----------------------------- Recuperation Fil  ------------------------------ */
            $Recuperation_Fil = "SELECT * 
                              FROM site.support_ticket_archives
                              WHERE numero_discussion = ?
                              ORDER BY date ASC";
            /* ----------------------------- Recuperation Fil ------------------------------- */
            $Parametres_Recuperation_Fil = $this->objConnection->prepare($Recuperation_Fil);
            $Parametres_Recuperation_Fil->execute(array(
                $Donnees_Informations_De_Base->numero_discussion));
            $Parametres_Recuperation_Fil->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Fil = $Parametres_Recuperation_Fil->rowCount();
            /* ------------------------------------------------------------------------------ */
            /* ----------------------------- Recuperation premier message ------------------- */
            $Parametres_Recuperation_Premier_Message = $this->objConnection->prepare($Recuperation_Fil);
            $Parametres_Recuperation_Premier_Message->execute(array(
                $Donnees_Informations_De_Base->numero_discussion));
            $Parametres_Recuperation_Premier_Message->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Recuperation_Premier_Message = $Parametres_Recuperation_Premier_Message->fetch();
            /* ------------------------------------------------------------------------------ */

            /* ----------------------------- Recuperation Fil Inverse ------------------------------ */
            $Recuperation_Fil_Inverse = "SELECT * 
                              FROM site.support_ticket_archives
                              WHERE numero_discussion = ?
                              ORDER BY date DESC";
            /* ----------------------------- Recuperation Fil Inverse ------------------------------- */
            /* ----------------------------- Recuperation dernier message ------------------- */
            $Parametres_Recuperation_Dernier_Message = $this->objConnection->prepare($Recuperation_Fil_Inverse);
            $Parametres_Recuperation_Dernier_Message->execute(array(
                $Donnees_Informations_De_Base->numero_discussion));
            $Parametres_Recuperation_Dernier_Message->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Recuperation_Dernier_Message = $Parametres_Recuperation_Dernier_Message->fetch();
            /* ------------------------------------------------------------------------------ */
            ?>

            <div id="Cadre_Fil_Informations">
                <div class="row">
                    <div class="col-lg-8">
                        <table class="table table-condensed" style="margin-bottom: 0px; border-collapse: collapse;">
                            <tr>
                                <td style="border-top: 0px;">Premier</td>
                                <td style="border-top: 0px;"><?php echo \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Premier_Message->date); ?></td>
                            </tr>
                            <tr>
                                <td>Dernier</td> 
                                <td><?php echo \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Dernier_Message->date); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <table class="table table-condensed" style="margin-bottom: 0px; border-collapse: collapse;">
                            <tr>
                                <td style="border-top: 0px;">Nombre</td> 
                                <td style="border-top: 0px;" id="Nombre_De_Message"><?php echo $Nombre_De_Resultat_Recuperation_Fil; ?></td>
                            </tr>
                            <tr>
                                <td>Objet</td>
                                <td><?php echo $Donnees_Recuperation_Premier_Message->objet_message; ?></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

            <div class="box box-warning direct-chat direct-chat-danger" style="margin-bottom: 0px;">

                <div class="box-body" style="min-height: 400px;">
                    <div class="direct-chat-messages" id="Cadre_Fil_Discussion_Viewer" style="min-height: 400px;">

                        <?php while ($Donnees_Recuperation_Fil = $Parametres_Recuperation_Fil->fetch()) { ?>

                            <?php if ($Donnees_Recuperation_Fil->id_emmeteur == $_SESSION["ID"]) { ?>

                                <div class="direct-chat-msg right" id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" style="margin-bottom: 18px;">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right"><?php echo $_SESSION["Pseudo_Messagerie"] ?></span>
                                        <span class="direct-chat-timestamp pull-left"><?php echo \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Fil->date); ?></span>
                                    </div>
                                    <i class="material-icons md-icon-person md-48 pull-right"></i>
                                    <div class="direct-chat-text">
                                        <?php echo nl2br(htmlentities($Donnees_Recuperation_Fil->contenue_message)); ?>
                                        <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                                            <div class="Etat_de_Visionnage"><?php echo \FonctionsUtiles::Formatage_Date_Vue($Donnees_Recuperation_Fil->date_vue); ?></div>
                                        <?php } else { ?>
                                            <div class="Etat_de_Visionnage">Non-Lu</div>
                                        <?php } ?>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="direct-chat-msg" id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" style="margin-bottom: 18px;">

                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left"><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></span>
                                        <span class="direct-chat-timestamp pull-right"><?php echo \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Fil->date); ?></span>

                                        <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                                            <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" style="padding-top: 18px;">
                                            </div>

                                        <?php } else { ?>
                                            <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>">
                                            </div>
                                        <?php } ?>

                                        <i class="material-icons md-icon-person md-48 pull-left"></i>
                                        <div class="direct-chat-text">
                                            <?php echo nl2br(htmlentities($Donnees_Recuperation_Fil->contenue_message)); ?>
                                            <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                                                <div class="Etat_de_Visionnage"><?php echo \FonctionsUtiles::Formatage_Date_Vue($Donnees_Recuperation_Fil->date_vue); ?></div>
                                            <?php } else { ?>
                                                <div class="Etat_de_Visionnage">Non-Lu</div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        <?php } ?>

                    </div>
                </div>

                <a style="display: none;" id="Lien_Cache" href="#Message_<?php echo $_POST["id"]; ?>" title="Vers élément contact">lien vers l'élément contact</a>
            </div>    

            <script type="text/javascript">
                function Defilement(lien) {

                    id = $(lien).attr("href");
                    offset = $(id).offset().top
                    $('#Cadre_Fil_Discussion_Viewer').animate({scrollTop: offset - 166}, 'fast');
                }
                setTimeout(function () {
                    Defilement("#Lien_Cache")
                }, 500);
            </script>

        <?php } else { ?>
            Le message n'existe plus.
        <?php } ?>
        <?php
    }

}

$class = new Messagerie_Viewer();
$class->run();
