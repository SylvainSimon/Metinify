<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Lecture extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Fonctions_Utiles.php'; ?>
        <?php
        if (empty($_SESSION['ID'])) {

            echo "Vous n'êtes pas connecté";
            exit();
        }
        ?>
        <?php
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
                <table id="Table_Fil_Information">
                    <tr>
                        <td width="140">Vous discutez avec :</td> 
                        <td><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></td>
                    </tr>
                    <tr>
                        <td width="140">Début du ticket : </td>
                        <td><?php echo Formatage_Date($Donnees_Recuperation_Premier_Message->date); ?></td>
                    </tr>
                </table>

                <table id="Table_Fil_Information2">
                    <tr>
                        <td width="140">Nombre de message :</td> 
                        <td id="Nombre_De_Message"><?php echo $Nombre_De_Resultat_Recuperation_Fil; ?></td>
                    </tr>
                    <tr>
                        <td width="140">Objet : </td>
                        <td><?php echo $Donnees_Recuperation_Premier_Message->objet_message; ?></td>
                    </tr>
                </table>

                <div id="Bouton_Archiver_Discussion" onclick="Ouverture_Dialogue_Archivage(<?php echo $Donnees_Recuperation_Premier_Message->id; ?>);">
                    Archiver le fil
                </div>

            </div>
            <div id="Cadre_Fil_Discussion">

                <?php while ($Donnees_Recuperation_Fil = $Parametres_Recuperation_Fil->fetch()) { ?>

                <?php if ($Donnees_Recuperation_Fil->id_emmeteur == $_SESSION["ID"]) { ?>

                        <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" class="Message_Droite" onmouseover="Apparition_Option_Message('#Croix_Suppression_<?php echo $Donnees_Recuperation_Fil->id; ?>');" onmouseout="Disparition_Option_Message('#Croix_Suppression_<?php echo $Donnees_Recuperation_Fil->id; ?>');">
                            <img title="Supprimer ce message" class="Logo_Croix_Suppression_Message" onclick="Ouverture_Dialogue(<?php echo $Donnees_Recuperation_Fil->id; ?>)" id="Croix_Suppression_<?php echo $Donnees_Recuperation_Fil->id; ?>" src="../../images/croix.png" width="13" />
                            <span><?php echo $_SESSION["Pseudo_Messagerie"] ?></span> : <?php echo nl2br(htmlentities($Donnees_Recuperation_Fil->contenue_message)); ?>
                            <br/>
                            <hr/>
                            <div class="Date_Du_Message"><?php echo Formatage_Date($Donnees_Recuperation_Fil->date); ?></div>
                            <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                                <div class="Etat_de_Visionnage"><?php echo Formatage_Date_Vue($Donnees_Recuperation_Fil->date_vue); ?></div>
                            <?php } else { ?>
                                <div class="Etat_de_Visionnage">Non-Lu</div>
                    <?php } ?>
                        </div>

                    <?php } else { ?>

                            <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                            <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" class="Message_Gauche Vue">
                                <?php } else { ?>
                                <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" class="Message_Gauche NonVue">
                    <?php } ?>

                                <span><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></span> : <?php echo nl2br(htmlentities($Donnees_Recuperation_Fil->contenue_message)); ?>
                                <br/>
                                <hr/>
                                <div class="Date_Du_Message"><?php echo Formatage_Date($Donnees_Recuperation_Fil->date); ?></div>
                                <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                                    <div class="Etat_de_Visionnage"><?php echo Formatage_Date_Vue($Donnees_Recuperation_Fil->date_vue); ?></div>
                                <?php } else { ?>
                                    <div class="Etat_de_Visionnage">Non-Lu</div>
                            <?php } ?>
                            </div>
                <?php } ?>

                        <script type="text/javascript">
                            $('#Message_<?php echo $Donnees_Recuperation_Fil->id; ?>').bind('inview', function (event, isVisible) {

                                if (hasClassName(this, "NonVue")) {

                                    if (isVisible) {
                                        $.ajax({
                                            type: "POST",
                                            url: "SQL_Actualiser_Vue.php",
                                            data: "etat=NonVue&id=" + this.id,
                                            success: function (etat) {

                                                $.ajax({
                                                    type: "POST",
                                                    url: "SQL_Recuperation_Date_Vue.php",
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

                    <a style="display: none;" id="Lien_Cache" href="#Message_<?php echo $_POST["id_ticket"]; ?>" title="Vers élément contact">lien vers l'élément contact</a>

                </div>

                <div id="dialog_Confirmation_Suppression_Message" title="Une confirmation est requise">Confirmer la suppression du message ?</div>
                <input style="display: none;" id="Id_Tempo_Message" value="" />

                <div id="dialog_Confirmation_Archivage_Fil" title="Une confirmation est requise">Confirmer l'archive du fil ?</div>
                <input style="display: none;" id="Id_Tempo_Message2" value="" />

                <script type="text/javascript">
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
                            url: "SQL_Suppression_Message.php",
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
                            url: "SQL_Archivage_Fil.php",
                            data: "id=" + $("#Id_Tempo_Message2").val(),
                            success: function (msg) {

                                if (msg == "NON") {

                                    window.parent.Barre_De_Statut("Cette discussion ne vous appartient pas.");
                                    window.parent.Icone_Chargement(2);

                                } else {
                                    window.parent.Barre_De_Statut("Discussion archivé.");
                                    window.parent.Icone_Chargement(0);

                                    Ajax_Appel_Messagerie("Messagerie_Boite_De_Reception.php");
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

                    function Defilement(lien) {

                        id = $(lien).attr("href");
                        offset = $(id).offset().top
                        $('#Cadre_Fil_Discussion').animate({scrollTop: offset - 166}, 'slow');
                    }
                    setTimeout(function () {
                        Defilement("#Lien_Cache")
                    }, 500);
                </script>

                <div id="Cadre_Fil_Reponse">
                    <textarea autofocus="autofocus" id="Contenue_Reponse_Ticket" class="Textarea_Reponse_Ticket"></textarea>
                    <div onclick="Envoyer_Message_Ticket()" class="button_Envoyer_Reponse_Ticket" >
                        Envoyer
                    </div>
                </div>

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
                                url: "SQL_Envoie_Reponse.php",
                                data: "ID_Emmeteur=" + ID_Emmeteur + "&ID_Recepteur=" + ID_Recepteur + "&Num_Discussion=" + Num_Discussion + "&Objet_Message=" + Objet_Message + "&Type_message=" + Type_message + "&Contenue_message=" + $("#Contenue_Reponse_Ticket").val(),
                                success: function (msg) {

                                    $("#Cadre_Fil_Discussion").append('<div id="Message_' + msg + '" class="Message_Droite" onmouseover="Apparition_Option_Message(\'#Croix_Suppression_' + msg + '\');" onmouseout="Disparition_Option_Message(\'#Croix_Suppression_' + msg + '\');">   <img title="Supprimer ce message" onclick="Ouverture_Dialogue(' + msg + ')" class="Logo_Croix_Suppression_Message" id="Croix_Suppression_' + msg + '" src="../../images/croix.png" width="13" />  <span><?php echo $_SESSION["Pseudo_Messagerie"] ?></span> : ' + nl2br($("#Contenue_Reponse_Ticket").val()) + '  <br/><hr/> <div class="Date_Du_Message"> Envoie... </div>   <div class="Etat_de_Visionnage">Non-Lu</div>   </div>');

                                    $("#Contenue_Reponse_Ticket").val("");

                                    $("#Cadre_Fil_Discussion").animate({scrollTop: $("#Cadre_Fil_Discussion")[0].scrollHeight}, 300);

                                    var nombre_tempo = parseInt($("#Nombre_De_Message").html());
                                    nombre_tempo++;
                                    $("#Nombre_De_Message").html(nombre_tempo);

                                    $.ajax({
                                        type: "POST",
                                        url: "SQL_Recuperation_Date.php",
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
    