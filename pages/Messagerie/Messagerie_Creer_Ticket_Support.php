<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Creer_Ticket_Support extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {


        /* ---------------------- Ticket En Attente --------------------------- */
        $Ticket_En_Attente = "SELECT numero_discussion
                          FROM site.support_ticket_attente
                          WHERE id_compte = ?";
        $Parametres_Ticket_En_Attente = $this->objConnection->prepare($Ticket_En_Attente);
        $Parametres_Ticket_En_Attente->execute(array(
            $_SESSION['ID']));
        $Parametres_Ticket_En_Attente->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Ticket_En_Attente = $Parametres_Ticket_En_Attente->rowCount();
        /* -------------------------------------------------------------------- */

        /* ---------------------- Ticket En Attente --------------------------- */
        $Ticket_En_Traitement = "SELECT id
                          FROM site.support_ticket_traitement
                          WHERE id_emmeteur = ?
                          AND etat = 'Non-Lu'
                          GROUP BY numero_discussion";
        $Parametres_Ticket_En_Traitement = $this->objConnection->prepare($Ticket_En_Traitement);
        $Parametres_Ticket_En_Traitement->execute(array(
            $_SESSION['ID']));
        $Parametres_Ticket_En_Traitement->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Ticket_En_Traitement = $Parametres_Ticket_En_Traitement->rowCount();
        /* -------------------------------------------------------------------- */
        ?>

        <div class="row">
            <div class="col-lg-8">

                <input id="Input_Id_Expediteur_Message" style="display: none;" type="text" value="<?php echo $_SESSION['ID']; ?>">

                <?php if ($Nombre_De_Ticket_En_Attente >= 3 || $Nombre_De_Ticket_En_Traitement >= 3) { ?>

                    <div class="Message_Trop_De_Ticket">
                        <div class="Titre_Message_Trop_De_Ticket">
                            <?php if ($Nombre_De_Ticket_En_Attente >= 3 && $Nombre_De_Ticket_En_Traitement >= 3) { ?>
                                Trop de tickets en cours
                            <?php } else { ?>
                                <?php if ($Nombre_De_Ticket_En_Attente >= 3) { ?>
                                    Trop de tickets en attente
                                <?php } else if ($Nombre_De_Ticket_En_Traitement >= 3) { ?>
                                    Trop de tickets en cours de traitement
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="Contenue_Message_Trop_De_Ticket">
                            <?php if ($Nombre_De_Ticket_En_Attente >= 3 && $Nombre_De_Ticket_En_Traitement >= 3) { ?>
                                Il semble que possédiez trop de ticket en attente et en cours de traitement.<br/><br/>
                                Veuillez modéré le nombre de vos tickets.<br/><br/>
                                Cordialement, l'équipe VamosMt2.
                            <?php } else { ?>
                                <?php if ($Nombre_De_Ticket_En_Attente >= 3) { ?>
                                    Il semble que possédiez trop de ticket en attente de traitement.<br/><br/>
                                    Veuillez modéré le nombre de vos tickets.<br/><br/>
                                    Cordialement, l'équipe VamosMt2.
                                <?php } else if ($Nombre_De_Ticket_En_Traitement >= 3) { ?>
                                    Il semble que possédiez trop de ticket en cours de traitement.<br/><br/>
                                    Veuillez archivez les tickets qui sont résolus.<br/><br/>
                                    Cordialement, l'équipe VamosMt2.
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>

                <?php } else { ?>

                    <?php
                    /* ---------------------- Recuperation des mot bannis --------------------------- */
                    $Mots_Bannis = "SELECT word FROM player.banword";
                    $Parametres_Mots_Bannis = $this->objConnection->prepare($Mots_Bannis);
                    $Parametres_Mots_Bannis->execute();
                    $Parametres_Mots_Bannis->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Mots_Bannis = $Parametres_Mots_Bannis->rowCount();
                    /* ------------------------------------------------------------------------------- */

                    if ($Nombre_De_Mots_Bannis > 0) {

                        $Position_Tableau_Mots_Bannis = 0;
                        $Tableau_Mots_Bannis = array();

                        while ($Donnees_Mots_Bannis = $Parametres_Mots_Bannis->fetch()) {

                            $Tableau_Mots_Bannis[$Position_Tableau_Mots_Bannis] = $Donnees_Mots_Bannis->word;

                            $Position_Tableau_Mots_Bannis++;
                        }
                    }

                    $_SESSION['Tableau_Mots_Bannis'] = $Tableau_Mots_Bannis;
                    ?>

                    <script type="text/javascript" src="pages/Messagerie/js/Controle_Nouveau_Ticket.js"></script>

                    <form type="POST" action="javascript:void(0)" id="Formulaire_Nouveau_Ticket">
                        <div class="col-lg-12" style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group ">
                                        <label for="Input_Pseudo_Expediteur_Message">
                                            Expéditeur
                                        </label>
                                        <div class="input-group col-xs-12">
                                            <input class="form-control input-sm" id="Input_Pseudo_Expediteur_Message" name="Input_Expediteur_Message" type="text" disabled="disabled" value="<?php echo $_SESSION['Pseudo_Messagerie']; ?>">                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group ">
                                        <label for="Input_Pseudo_Expediteur_Message">
                                            Objet
                                        </label>
                                        <div class="input-group col-xs-12">
                                            <select class="form-control input-sm" onchange="Objet_selectionner();" id="Selecteur_Objet_Ticket" name="Selecteur_Objet_Ticket">
                                                <option selected="selected" value="--"> -- </option>
                                                <?php
                                                /* ------------------------ Liste_Objets ------------------------------ */
                                                $Liste_Objets = "SELECT objets 
                                         FROM site.support_ticket_objets
                                         ORDER by objets ASC";
                                                $Parametres_Liste_Objets = $this->objConnection->prepare($Liste_Objets);
                                                $Parametres_Liste_Objets->execute();
                                                $Parametres_Liste_Objets->setFetchMode(\PDO::FETCH_OBJ);
                                                /* -------------------------------------------------------------------- */
                                                ?>

                                                <?php while ($Donnees_Objets = $Parametres_Liste_Objets->fetch()) { ?>
                                                    <option value="<?php echo $Donnees_Objets->objets; ?>"><?php echo $Donnees_Objets->objets; ?></option>
                                                <?php } ?>
                                                <option value="Autres...">Autres...</option>
                                            </select>
                                        </div>
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
                                            <textarea maxlength="1024" style="min-height: 170px;" id="Textarea_Nouveau_Ticket" class="form-control input-sm" onblur="Longueur_minimal();
                                                                Fonction_Remplacement(this.value);" onkeyup="document.getElementById('Nombre_Caracteres_Nouveau_Ticket').innerHTML = (this.value.length + this.value.replace(/[^\n]+/g, '').length);"></textarea>                                </div>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-success btn-flat pull-right" type="button" onclick="Valider_Formulaire_Nouveau_Ticket();">
                                Envoyer la demande
                            </button>

                        </div>
                    </form>

                <?php } ?>
            </div>
            <div class="col-lg-4">

                <table class="table table-condensed" style="border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 0px;">
                            Adresse Ip
                        </td>
                        <td style="border-top: 0px;">
                            <?php echo $_SERVER["REMOTE_ADDR"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tickets en attente
                        </td>
                        <td>
                            <?php echo $Nombre_De_Ticket_En_Attente; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tickets actifs
                        </td>
                        <td>
                            <?php echo $Nombre_De_Ticket_En_Traitement; ?>
                        </td>
                    </tr>
                </table>


                <span id="Nombre_Caracteres_Nouveau_Ticket">0</span>/1024 caractères.
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

    $class = new Messagerie_Creer_Ticket_Support();
    $class->run();
    