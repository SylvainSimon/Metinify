<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Lecture extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        /* ------------------------ Informations de Base ---------------------------- */
        $Informations_De_Base = "SELECT * FROM site.support_ticket_traitement
                                  WHERE id = ?
                                  LIMIT 1";
        $Parametres_Informations_De_Base = $this->objConnection->prepare($Informations_De_Base);
        $Parametres_Informations_De_Base->execute(array(
            $_POST["id_ticket"]));
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
                              FROM site.support_ticket_traitement
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
            ?>

            <div id="Cadre_Fil_Informations">
                <div class="row">
                    <div class="col-lg-8">
                        <table class="table table-condensed" style="margin-bottom: 0px; border-collapse: collapse;">
                            <tr>
                                <td style="border-top: 0px;">Vous discutez avec</td>
                                <td style="border-top: 0px;"><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></td>
                            </tr>
                            <tr>
                                <td>Début du ticket </td> 
                                <td><?php echo \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Premier_Message->date); ?></td>
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
                    <div class="direct-chat-messages" id="Cadre_Fil_Discussion" style="min-height: 400px;">

                        <?php while ($Donnees_Recuperation_Fil = $Parametres_Recuperation_Fil->fetch()) { ?>

                            <?php if ($Donnees_Recuperation_Fil->id_emmeteur == $_SESSION["ID"]) { ?>

                                <div class="direct-chat-msg right" id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" style="margin-bottom: 18px;">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right"><?php echo $_SESSION["Pseudo_Messagerie"] ?></span>
                                        <span class="direct-chat-timestamp pull-left"><?php echo \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Fil->date); ?></span>
                                    </div>
                                    <i class="material-icons md-icon-person md-48 pull-right"></i>
                                    <div class="direct-chat-text  bg-red">
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
                                            <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" style="padding-top: 18px;">
                                            </div>
                                        <?php } ?>


                                        <i class="material-icons md-icon-person md-48 pull-left"></i>
                                        <div class="direct-chat-text bg-blue">
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

                            <script type="text/javascript">

                                $('#Message_<?php echo $Donnees_Recuperation_Fil->id; ?>').bind('inview', function (event, isVisible) {

                                    if (hasClassName(this, "NonVue")) {

                                        if (isVisible) {
                                            $.ajax({
                                                type: "POST",
                                                url: "ajax/ajaxMessageIsView.php",
                                                data: "etat=NonVue&id=" + this.id,
                                                success: function (etat) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "ajax/ajaxMessageGetDateView.php",
                                                        data: "id=<?php echo $Donnees_Recuperation_Fil->id; ?>",
                                                        success: function (date) {

                                                            $("#Message_<?php echo $Donnees_Recuperation_Fil->id; ?> .Etat_de_Visionnage").html("" + date);
                                                        }
                                                    });

                                                    window.parent.Actualisation_Messages_Sans_Boucle();
                                                }
                                            });

                                            this.className = "Message_Gauche Vue";
                                        }
                                    }
                                });
                            </script>
                        <?php } ?>

                        <a style="display: none;" id="Lien_Cache" href="#Message_<?php echo $_POST["id"]; ?>" title="Vers élément contact">lien vers l'élément contact</a>

                    </div>
                </div>

                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input id="Contenue_Reponse_Ticket" type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                                <button type="button" onclick="Envoyer_Message_Ticket()" class="btn btn-primary btn-flat">Send</button>
                            </span>
                        </div>
                    </form>
                </div>

            </div>

            <script type="text/javascript">

                var objDiv = document.getElementById("Cadre_Fil_Discussion");
                objDiv.scrollTop = objDiv.scrollHeight;


                $(function () {
                    $("#dialog_Confirmation_Suppression_Message").dialog({
                        resizable: false,
                        autoOpen: false,
                        modal: true,
                        buttons: {
                            "Je confirme": function () {
                                $(this).dialog("close");
                                Suppression_Message_Fil();

                            },
                            "Annuler": function () {
                                $(this).dialog("close");
                                window.parent.Barre_De_Statut("Suppression annulé.");
                                window.parent.Icone_Chargement(0);
                            }
                        }
                    });

                });

                $(function () {
                    $("#dialog_Confirmation_Archivage_Fil").dialog({
                        resizable: false,
                        autoOpen: false,
                        modal: true,
                        buttons: {
                            "Je confirme": function () {
                                $(this).dialog("close");
                                Archivage_Fil();

                            },
                            "Annuler": function () {
                                $(this).dialog("close");
                                window.parent.Barre_De_Statut("Suppression annulé.");
                                window.parent.Icone_Chargement(0);
                            }
                        }
                    });

                });

                function Ouverture_Dialogue(id_message) {

                    window.parent.Barre_De_Statut("En attente de la confirmation...");
                    window.parent.Icone_Chargement(1);

                    $("#Id_Tempo_Message").val(id_message);
                    $("#dialog_Confirmation_Suppression_Message").dialog("open");
                }

                function Ouverture_Dialogue_Archivage(id_message) {

                    window.parent.Barre_De_Statut("En attente de la confirmation...");
                    window.parent.Icone_Chargement(1);

                    $("#Id_Tempo_Message2").val(id_message);
                    $("#dialog_Confirmation_Archivage_Fil").dialog("open");
                }

                function Suppression_Message_Fil() {

                    window.parent.Barre_De_Statut("Suppression du message en cours...");
                    window.parent.Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "ajax/ajaxMessageDelete.php",
                        data: "id_message=" + $("#Id_Tempo_Message").val(),
                        success: function (msg) {

                            if (msg == "NON") {

                                window.parent.Barre_De_Statut("Ce message ne vous appartient pas.");
                                window.parent.Icone_Chargement(2);

                            } else {
                                $("#Message_" + msg).fadeOut("slow", function () {
                                    $("#Message_" + msg).remove();
                                    window.parent.Barre_De_Statut("Suppression du message réussi.");
                                    window.parent.Icone_Chargement(0);
                                });

                                var nombre_tempo = parseInt($("#Nombre_De_Message").html());
                                nombre_tempo--;
                                $("#Nombre_De_Message").html(nombre_tempo);
                            }
                        }
                    });
                }

                function Archivage_Fil() {

                    window.parent.Barre_De_Statut("Archivage en cours...");
                    window.parent.Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "ajax/ajaxDiscussionArchivage.php",
                        data: "id=" + $("#Id_Tempo_Message2").val(),
                        success: function (msg) {

                            if (msg == "NON") {

                                window.parent.Barre_De_Statut("Cette discussion ne vous appartient pas.");
                                window.parent.Icone_Chargement(2);

                            } else {
                                window.parent.Barre_De_Statut("Discussion archivé.");
                                window.parent.Icone_Chargement(0);

                                Ajax_Appel_Messagerie("pages/Messagerie/Messagerie_Boite_De_Reception.php");
                            }
                        }
                    });
                }

                function hasClassName(elmt, className)
                {
                    if (typeof elmt == "string")
                        elmt = document.getElementById(elmt);
                    var regex = new RegExp("\\b" + className + "\\b");
                    return regex.test(elmt.className);
                }

            </script>

            <script type="text/javascript">

                function nl2br(str, is_xhtml) {
                    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
                    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
                }

                var ID_Emmeteur = "<?php echo $_SESSION["ID"]; ?>";
                var ID_Recepteur = "<?php echo $Donnees_Informations_De_Base->id_emmeteur; ?>";
                var Num_Discussion = "<?php echo $Donnees_Informations_De_Base->numero_discussion; ?>";
                var Objet_Message = "<?php echo $Donnees_Informations_De_Base->objet_message; ?>";
                var Type_message = "<?php echo $Donnees_Informations_De_Base->type; ?>";

                function Apparition_Option_Message(id_img) {

                    $(id_img).css("display", "inline-block");
                }

                function Disparition_Option_Message(id_img) {

                    $(id_img).css("display", "none");
                }

                function Envoyer_Message_Ticket() {

                    window.parent.Barre_De_Statut("Envoie du message...");
                    window.parent.Icone_Chargement(1);

                    if ($("#Contenue_Reponse_Ticket").val() != "") {

                        $.ajax({
                            type: "POST",
                            url: "pages/Messagerie/ajax/ajaxMessageAdd.php",
                            data: "ID_Emmeteur=" + ID_Emmeteur + "&ID_Recepteur=" + ID_Recepteur + "&Num_Discussion=" + Num_Discussion + "&Objet_Message=" + Objet_Message + "&Type_message=" + Type_message + "&Contenue_message=" + $("#Contenue_Reponse_Ticket").val(),
                            success: function (msg) {


                                $("#Cadre_Fil_Discussion").append('<div class="direct-chat-msg right" id="Message_' + msg + '" style="margin-bottom: 18px;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right"><?php echo $_SESSION["Pseudo_Messagerie"] ?></span></div><i class="material-icons md-icon-person md-48 pull-right"></i><div class="direct-chat-text  bg-red">' + nl2br($("#Contenue_Reponse_Ticket").val()) + '</div><div class="Etat_de_Visionnage">Non-Lu</div></div>');

                                $("#Contenue_Reponse_Ticket").val("");

                                $("#Cadre_Fil_Discussion").animate({scrollTop: $("#Cadre_Fil_Discussion")[0].scrollHeight}, 300);

                                var nombre_tempo = parseInt($("#Nombre_De_Message").html());
                                nombre_tempo++;
                                $("#Nombre_De_Message").html(nombre_tempo);

                                $.ajax({
                                    type: "POST",
                                    url: "ajax/ajaxMessageGetDate.php",
                                    data: "id=" + msg,
                                    success: function (date) {

                                        window.parent.Barre_De_Statut("Message envoyé.");
                                        window.parent.Icone_Chargement(0);

                                        $("#Message_" + msg + " .Date_Du_Message").html("" + date);
                                        $("#Cadre_Fil_Discussion").animate({scrollTop: $("#Cadre_Fil_Discussion")[0].scrollHeight}, 1);
                                    }
                                });

                            }
                        });

                    } else {

                        window.parent.Barre_De_Statut("Message vide.");
                        window.parent.Icone_Chargement(2);

                        return false;
                    }

                }
            </script>
        <?php } else { ?>
            Le message n'existe plus.
        <?php } ?>

        <?php
    }

}

$class = new Messagerie_Lecture();
$class->run();
