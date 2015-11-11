<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Lecture extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        global $request;

        $objSupportDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($request->request->get("id_ticket"));
        $objAccount = \Account\AccountHelper::getAccountRepository()->find($objSupportDiscussion->getIdCompte());
        $objAccountAdmin = \Account\AccountHelper::getAccountRepository()->find($objSupportDiscussion->getIdAdmin());
        $objSupportObjet = \Site\SiteHelper::getSupportObjetsRepository()->find($objSupportDiscussion->getIdObjet());
        $arrObjSupportMessages = \Site\SiteHelper::getSupportMessagesRepository()->findMessages($this->objAccount->getId(), $request->request->get("id_ticket"));

        if (count($arrObjSupportMessages) > 0) {
            ?>

            <div class="row">
                <div class="col-lg-3">


                    <table class="table table-condensed" style="margin-bottom: 0px; border-collapse: collapse;">
                        <tr>
                            <td style="border-top: 0px;">Gérant</td>
                            <td style="border-top: 0px;"><?php echo $objAccountAdmin->getPseudoMessagerie(); ?></td>
                        </tr>
                        <tr>
                            <td>Début</td> 
                            <td><?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportDiscussion->getDate()); ?></td>
                        </tr>
                        <tr>
                            <td>Message</td> 
                            <td id="Nombre_De_Message"><?php echo count($arrObjSupportMessages); ?></td>
                        </tr>
                        <tr>
                            <td>Objet</td>
                            <td><?php echo $objSupportObjet->getObjet(); ?></td>
                        </tr>
                    </table>


                    <div style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px;">
                        <button type="button" class="btn btn-sm btn-flat btn-warning" onclick="DiscussionArchivage(<?= $objSupportDiscussion->getId(); ?>);">
                            Archiver
                        </button>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="box box-warning direct-chat direct-chat-danger" style="margin-bottom: 0px; border-top: 0px; border-bottom: 0px; border-collapse: collapse;">

                        <div class="box-body" style="min-height: 400px;">
                            <div class="direct-chat-messages" id="Cadre_Fil_Discussion" style="min-height: 400px;">

                                <?php foreach ($arrObjSupportMessages AS $objSupportMessages) { ?>

                                    <?php if ($objSupportMessages->getIdCompte() == $this->objAccount->getId()) { ?>

                                        <div class="direct-chat-msg right" id="Message_<?php echo $objSupportMessages->getId(); ?>" style="margin-bottom: 18px;">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right"><?php echo $this->objAccount->getPseudoMessagerie() ?></span>
                                                <span class="direct-chat-timestamp pull-left">
                                                    <?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDate()); ?>
                                                    <?php if ($objSupportMessages->getEtat() == \Site\SupportEtatMessageHelper::LU) { ?>
                                                        <div class="dateEtatChange" style="display: inline;"><i data-tooltip="Vu <?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDatechangementEtat()); ?>" class="material-icons md-icon-done text-green"></i></div>
                                                    <?php } else { ?>
                                                        <div class="dateEtatChange" style="display: inline;"></div>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <i class="material-icons md-icon-person md-48 pull-right"></i>
                                            <div class="direct-chat-text  bg-red">
                                                <?php echo nl2br($objSupportMessages->getMessage()); ?>
                                            </div>
                                        </div>

                                    <?php } else { ?>

                                        <div class="direct-chat-msg" id="Message_<?php echo $objSupportMessages->getId(); ?>" style="margin-bottom: 18px;">

                                            <div class="direct-chat-info clearfix">

                                                <?php if ($objAccount->getId() == $this->objAccount->getId()) { ?>
                                                    <span class="direct-chat-name pull-left"><?php echo $objAccountAdmin->getPseudoMessagerie(); ?></span>
                                                <?php } else { ?>
                                                    <span class="direct-chat-name pull-left"><?php echo $objAccount->getPseudoMessagerie(); ?></span>
                                                <?php } ?>

                                                <span class="direct-chat-timestamp pull-right">
                                                    <?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDate()); ?>
                                                    <?php if ($objSupportMessages->getEtat() == \Site\SupportEtatMessageHelper::LU) { ?>
                                                        <div class="dateEtatChange" style="display: inline;"><i data-tooltip="Vu <?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportMessages->getDatechangementEtat()); ?>" class="material-icons md-icon-done text-green"></i></div>
                                                    <?php } else { ?>
                                                        <div class="dateEtatChange NonLu" style="display: inline;"></div>
                                                    <?php } ?>
                                                </span>
                                            </div>

                                            <i class="material-icons md-icon-person md-48 pull-left"></i>
                                            <div class="direct-chat-text bg-blue">
                                                <?php echo nl2br($objSupportMessages->getMessage()); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>

                            </div>
                        </div>

                        <div class="box-footer">
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-lg-10 col-md-9 col-xs-8">
                                        <textarea id="Contenue_Reponse_Ticket" type="text" name="message" placeholder="Message..." class="form-control input-sm"></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-4">
                                        <button type="button" onclick="addMessage()" class="btn btn-primary btn-flat btn-sm" style="width: 100%">
                                            Envoyer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <script type="text/javascript">
                var idCompte = "<?php echo $this->objAccount->getId(); ?>";
                var idDiscussion = "<?php echo $objSupportDiscussion->getId(); ?>";

                var objDiv = document.getElementById("Cadre_Fil_Discussion");
                objDiv.scrollTop = objDiv.scrollHeight;


                $('.dateEtatChange').bind('inview', function (event, isVisible) {

                    if ($(this).hasClass("NonLu")) {

                        if (isVisible) {
                            $.ajax({
                                type: "POST",
                                url: "pages/Messagerie/ajax/ajaxMessageIsView.php",
                                data: "idMessage=" + $(this).parent(".direct-chat-timestamp").parent(".direct-chat-info").parent(".direct-chat-msg").attr("id"),
                                success: function (etat) {

                                    Actualisation_Messages_Sans_Boucle();
                                    $(this).removeClass("NonLu");

                                }
                            });
                        }
                    }
                });

                function DiscussionArchivage(idDiscussion) {

                    Barre_De_Statut("Archivage en cours...");
                    Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Messagerie/ajax/ajaxDiscussionArchivage.php",
                        data: "idDiscussion=" + idDiscussion,
                        success: function (msg) {

                            if (msg == "NON") {

                                Barre_De_Statut("Cette discussion ne vous appartient pas.");
                                Icone_Chargement(2);

                            } else {
                                Ajax_Appel_Messagerie("pages/Messagerie/Messagerie_Boite_De_Reception.php");
                            }
                        }
                    });
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

                                $("#Cadre_Fil_Discussion").append('<div class="direct-chat-msg right" id="Message_' + json.id + '" style="margin-bottom: 18px;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right"><?php echo $_SESSION["Pseudo_Messagerie"] ?></span><span class="direct-chat-timestamp pull-left">' + json.date + '</span></div><i class="material-icons md-icon-person md-48 pull-right"></i><div class="direct-chat-text bg-red">' + json.message + '</div></div>');

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
