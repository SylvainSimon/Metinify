<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Lecture extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {
        
        global $request;

        $objSupportDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($request->request->get("id_ticket"));
        $objAccount = \Account\AccountHelper::getAccountRepository()->find($objSupportDiscussion->getIdAdmin());
        $objSupportObjet = \Site\SiteHelper::getSupportObjetsRepository()->find($objSupportDiscussion->getIdObjet());
        $arrObjSupportMessages = \Site\SiteHelper::getSupportMessagesRepository()->findMessages($this->objAccount->getId(), $request->request->get("id_ticket"));

        if (count($arrObjSupportMessages) > 0) {
            ?>

            <div id="Cadre_Fil_Informations">
                <div class="row">
                    <div class="col-lg-8">
                        <table class="table table-condensed" style="margin-bottom: 0px; border-collapse: collapse;">
                            <tr>
                                <td style="border-top: 0px;">Ticket gérer par </td>
                                <td style="border-top: 0px;"><?php echo $objAccount->getPseudoMessagerie(); ?></td>
                            </tr>
                            <tr>
                                <td>Début du ticket </td> 
                                <td><?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportDiscussion->getDate()); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <table class="table table-condensed" style="margin-bottom: 0px; border-collapse: collapse;">
                            <tr>
                                <td style="border-top: 0px;">Nombre</td> 
                                <td style="border-top: 0px;" id="Nombre_De_Message"><?php echo count($arrObjSupportMessages); ?></td>
                            </tr>
                            <tr>
                                <td>Objet</td>
                                <td><?php echo $objSupportObjet->getObjet(); ?></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

            <div class="box box-warning direct-chat direct-chat-danger" style="margin-bottom: 0px;">

                <div class="box-body" style="min-height: 400px;">
                    <div class="direct-chat-messages" id="Cadre_Fil_Discussion" style="min-height: 400px;">

                        <?php foreach ($arrObjSupportMessages AS $objSupportMessages) { ?>

                            <?php if ($objSupportMessages->getIdCompte() == $this->objAccount->getId()) { ?>

                                <div class="direct-chat-msg right" id="Message_<?php echo $objSupportMessages->getId(); ?>" style="margin-bottom: 18px;">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right"><?php echo $this->objAccount->getPseudoMessagerie() ?></span>
                                        <span class="direct-chat-timestamp pull-left"><?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDate()); ?></span>
                                    </div>
                                    <i class="material-icons md-icon-person md-48 pull-right"></i>
                                    <div class="direct-chat-text  bg-red">

                                        <?php echo nl2br($objSupportMessages->getMessage()); ?>

                                        <?php if ($objSupportMessages->getEtat() == \Site\SupportEtatMessageHelper::LU) { ?>
                                            <div class="Etat_de_Visionnage"><?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDatechangementEtat()); ?></div>
                                        <?php } else { ?>
                                            <div class="Etat_de_Visionnage">Non-Lu</div>
                                        <?php } ?>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="direct-chat-msg" id="Message_<?php echo $objSupportMessages->getId(); ?>" style="margin-bottom: 18px;">

                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left"><?php echo $this->objAccount->getPseudoMessagerie(); ?></span>
                                        <span class="direct-chat-timestamp pull-right"><?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDate()); ?></span>

                                        <?php if ($objSupportMessages->getEtat() == \Site\SupportEtatMessageHelper::LU) { ?>
                                            <div id="Message_<?php echo $objSupportMessages->getId(); ?>" style="padding-top: 18px;">
                                            </div>
                                        <?php } else { ?>
                                            <div id="Message_<?php echo $objSupportMessages->getId(); ?>" style="padding-top: 18px;">
                                            </div>
                                        <?php } ?>


                                        <i class="material-icons md-icon-person md-48 pull-left"></i>
                                        <div class="direct-chat-text bg-blue">

                                            <?php echo nl2br($objSupportMessages->getMessage()); ?>
                                            <?php if ($objSupportMessages->getEtat() == \Site\SupportEtatMessageHelper::LU) { ?>
                                                <div class="Etat_de_Visionnage"><?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDatechangementEtat()); ?></div>
                                            <?php } else { ?>
                                                <div class="Etat_de_Visionnage">Non-Lu</div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <script type="text/javascript">

                                $('#Message_<?php echo $objSupportMessages->getId(); ?>').bind('inview', function (event, isVisible) {

                                    if ($(this).hasClass("NonVue"))) {

                                        if (isVisible) {
                                            $.ajax({
                                                type: "POST",
                                                url: "ajax/ajaxMessageIsView.php",
                                                data: "etat=NonVue&id=" + this.id,
                                                success: function (etat) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "ajax/ajaxMessageGetDateView.php",
                                                        data: "id=<?php echo $objSupportMessages->getId(); ?>",
                                                        success: function (date) {

                                                            $("#Message_<?php echo $objSupportMessages->getId(); ?> .Etat_de_Visionnage").html("" + date);
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
                            <textarea id="Contenue_Reponse_Ticket" type="text" name="message" placeholder="Message ..." class="form-control"></textarea>
                            <span class="input-group-btn">
                                <button type="button" onclick="addMessage()" class="btn btn-primary btn-flat">Send</button>
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
                                Barre_De_Statut("Suppression annulé.");
                                Icone_Chargement(0);
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
                                Barre_De_Statut("Suppression annulé.");
                                Icone_Chargement(0);
                            }
                        }
                    });

                });

                function Ouverture_Dialogue(id_message) {

                    Barre_De_Statut("En attente de la confirmation...");
                    Icone_Chargement(1);

                    $("#Id_Tempo_Message").val(id_message);
                    $("#dialog_Confirmation_Suppression_Message").dialog("open");
                }

                function Ouverture_Dialogue_Archivage(id_message) {

                    Barre_De_Statut("En attente de la confirmation...");
                    Icone_Chargement(1);

                    $("#Id_Tempo_Message2").val(id_message);
                    $("#dialog_Confirmation_Archivage_Fil").dialog("open");
                }

                function Suppression_Message_Fil() {

                    Barre_De_Statut("Suppression du message en cours...");
                    Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Messagerie/ajax/ajaxMessageDelete.php",
                        data: "id_message=" + $("#Id_Tempo_Message").val(),
                        success: function (msg) {

                            if (msg == "NON") {

                                Barre_De_Statut("Ce message ne vous appartient pas.");
                                Icone_Chargement(2);

                            } else {
                                $("#Message_" + msg).fadeOut("slow", function () {
                                    $("#Message_" + msg).remove();
                                    Barre_De_Statut("Suppression du message réussi.");
                                    Icone_Chargement(0);
                                });

                                var nombre_tempo = parseInt($("#Nombre_De_Message").html());
                                nombre_tempo--;
                                $("#Nombre_De_Message").html(nombre_tempo);
                            }
                        }
                    });
                }

                function Archivage_Fil() {

                    Barre_De_Statut("Archivage en cours...");
                    Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Messagerie/ajax/ajaxDiscussionArchivage.php",
                        data: "id=" + $("#Id_Tempo_Message2").val(),
                        success: function (msg) {

                            if (msg == "NON") {

                                Barre_De_Statut("Cette discussion ne vous appartient pas.");
                                Icone_Chargement(2);

                            } else {
                                Barre_De_Statut("Discussion archivé.");
                                Icone_Chargement(0);

                                Ajax_Appel_Messagerie("pages/Messagerie/Messagerie_Boite_De_Reception.php");
                            }
                        }
                    });
                }

            </script>

            <script type="text/javascript">

                var idCompte = "<?php echo $this->objAccount->getId(); ?>";
                var idDiscussion = "<?php echo $objSupportDiscussion->getId(); ?>";

                function addMessage() {

                    Barre_De_Statut("Envoie du message...");
                    Icone_Chargement(1);

                    if ($("#Contenue_Reponse_Ticket").val() != "") {
                        $.ajax({
                            type: "POST",
                            url: "pages/Messagerie/ajax/ajaxMessageAdd.php",
                            data: "idCompte=" + idCompte + "&idDiscussion=" + idDiscussion + "&message=" + $("#Contenue_Reponse_Ticket").val(),
                            success: function (msg) {

                                var json = JSON.parse(msg);

                                $("#Cadre_Fil_Discussion").append('<div class="direct-chat-msg right" id="Message_' + json.id + '" style="margin-bottom: 18px;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right"><?php echo $_SESSION["Pseudo_Messagerie"] ?></span><span class="direct-chat-timestamp pull-left">' + json.date + '</span></div><i class="material-icons md-icon-person md-48 pull-right"></i><div class="direct-chat-text bg-red">' + json.message + '<div class="Etat_de_Visionnage">Non-Lu</div></div></div>');

                                $("#Contenue_Reponse_Ticket").val("");
                                $("#Cadre_Fil_Discussion").animate({scrollTop: $("#Cadre_Fil_Discussion")[0].scrollHeight}, 300);

                                var nombre_tempo = parseInt($("#Nombre_De_Message").html());
                                nombre_tempo++;
                                $("#Nombre_De_Message").html(nombre_tempo);

                                $("#Cadre_Fil_Discussion").animate({scrollTop: $("#Cadre_Fil_Discussion")[0].scrollHeight}, 1);

                                Barre_De_Statut("Message envoyé");
                                Icone_Chargement(0);

                            }
                        });
                    } else {
                        Barre_De_Statut("Message vide.");
                        Icone_Chargement(2);
                        return false;
                    }
                }
            </script>
        <?php } else { ?>
            Le message n'existe plus.
        <?php
        }
    }

}

$class = new Messagerie_Lecture();
$class->run();
