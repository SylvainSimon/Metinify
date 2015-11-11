<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieCreate extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        global $session;

        $nombreDiscussionOuverte = \Site\SiteHelper::getSupportDiscussionsRepository()->countDiscussionActiveByIdAccount($this->objAccount->getId());
        ?>

        <div class="row">
            <div class="col-lg-12">

                <input id="Input_Id_Expediteur_Message" style="display: none;" type="text" value="<?php echo $this->objAccount->getId(); ?>">

                <?php if ($nombreDiscussionOuverte >= 3) { ?>

                    <div class="Message_Trop_De_Ticket">
                        <div class="Titre_Message_Trop_De_Ticket">
                            <?php if ($nombreDiscussionOuverte >= 3) { ?>
                                Trop de tickets en cours
                            <?php } else { ?>
                                <?php if ($nombreDiscussionOuverte >= 3) { ?>
                                    Trop de tickets en attente
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="Contenue_Message_Trop_De_Ticket">
                            <?php if ($nombreDiscussionOuverte >= 3) { ?>
                                Il semble que possédiez trop de ticket en attente et en cours de traitement.<br/><br/>
                                Veuillez modéré le nombre de vos tickets.<br/><br/>
                                Cordialement, l'équipe VamosMt2.
                            <?php } else { ?>
                                <?php if ($nombreDiscussionOuverte >= 3) { ?>
                                    Il semble que possédiez trop de ticket en cours de traitement.<br/><br/>
                                    Veuillez archivez les tickets qui sont résolus.<br/><br/>
                                    Cordialement, l'équipe VamosMt2.
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>

                <?php } else { ?>

                    <?php
                    $arrObjBanword = \Player\PlayerHelper::getBanwordRepository()->findAll();

                    if (count($arrObjBanword) > 0) {
                        $Tableau_Mots_Bannis = [];
                        foreach ($arrObjBanword AS $objBanword) {
                            $Tableau_Mots_Bannis[] = $objBanword->getWord();
                        }
                    }
                    $session->set("Tableau_Mots_Bannis", $Tableau_Mots_Bannis);
                    ?>

                    <script type="text/javascript" src="pages/Messagerie/js/Controle_Nouveau_Ticket.js"></script>

                    <form type="POST" action="javascript:void(0)" id="Formulaire_Nouveau_Ticket">
                        <div class="col-lg-12" style="margin-top: 15px; margin-bottom: 15px;">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group ">
                                        <label for="Input_Pseudo_Expediteur_Message">
                                            Demandeur
                                        </label>
                                        <div class="input-group col-xs-12">
                                            <input class="form-control input-sm" id="Input_Pseudo_Expediteur_Message" name="Input_Expediteur_Message" type="text" disabled="disabled" value="<?php echo $session->get("Pseudo_Messagerie"); ?>">                           
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="Selecteur_Objet_Ticket">
                                        Objet
                                    </label>
                                    <div class="input-group col-xs-12">
                                        <?php $arrObjSupportObjets = \Site\SiteHelper::getSupportObjetsRepository()->findAll(); ?>
                                        <select class="select2" onchange="Objet_selectionner();" id="Selecteur_Objet_Ticket" name="Selecteur_Objet_Ticket">
                                            <option selected="selected" value="0"> -- </option>
                                            <?php foreach ($arrObjSupportObjets AS $objSupportObjets) { ?>
                                                <option value="<?php echo $objSupportObjets->getId(); ?>"><?php echo $objSupportObjets->getObjet(); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group ">
                                        <label for="Textarea_Nouveau_Ticket">
                                            Message
                                        </label>
                                        <div class="input-group col-xs-12">
                                            <textarea maxlength="1024" style="min-height: 170px; resize: none;" id="Textarea_Nouveau_Ticket" class="form-control input-sm" onblur="Fonction_Remplacement(this.value);" onkeyup="document.getElementById('Nombre_Caracteres_Nouveau_Ticket').innerHTML = (this.value.length + this.value.replace(/[^\n]+/g, '').length);"></textarea>
                                            <span id="Nombre_Caracteres_Nouveau_Ticket">0</span>/1024
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-success btn-flat pull-right" type="button" onclick="Valider_Formulaire_Nouveau_Ticket();">
                                Envoyer
                            </button>
                        </div>
                    </form>

                <?php } ?>
            </div>
            <script type="text/javascript">
                function Fonction_Remplacement(montexte) {

                    window.parent.Barre_De_Statut("Vérification des mots utilisés...");
                    window.parent.Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Messagerie/ajax/ajaxVerificationBadWord.php",
                        data: "Message_Texte=" + montexte,
                        success: function (msg) {

                            window.parent.Barre_De_Statut("Chargement terminé.");
                            window.parent.Icone_Chargement(0);

                            $("#Textarea_Nouveau_Ticket").val == "";
                            $("#Textarea_Nouveau_Ticket").val(msg);
                        }
                    });

                }

            </script>
            <?php
        }

    }

    $class = new MessagerieCreate();
    $class->run();
    