<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Generation_Liste_Mes_Ventes extends \ScriptHelper {

    public $isProtected = true;
    
    public function run() {
        ?>
        
        <?php
        /* ----------------------- Recuperation Date ------------------------------- */
        $Compte = $this->objAccount->getId();
        $Recuperation_Articles = "SELECT marche_articles.designation, marche_articles.description, marche_articles.devise AS id_devise, marche_articles.prix, marche_categories.nom_categorie, marche_devises.devise, marche_personnages.id_proprietaire, marche_personnages.id AS id_marche_personnage, player.level, player.name, player.job
                          FROM site.marche_articles
                          LEFT JOIN site.marche_categories
                          ON marche_categories.id = marche_articles.categorie
                          LEFT JOIN site.marche_devises
                          ON marche_devises.id = marche_articles.devise
                          LEFT JOIN site.marche_personnages
                          ON marche_personnages.id = marche_articles.identifiant_article
                          LEFT JOIN player.player
                          ON player.id = marche_personnages.id_personnage
                          WHERE marche_articles.designation != 'kdsghflvbsiudvbhkslfiuhslfdbx'
						  AND id_proprietaire =  '" . $Compte . "'
                          LIMIT 100";


        $Parametres_Recuperation_Articles = $this->objConnection->prepare($Recuperation_Articles);
        $Parametres_Recuperation_Articles->execute();
        $Parametres_Recuperation_Articles->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recuperation_Articles = $Parametres_Recuperation_Articles->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>
        <?php if ($Nombre_De_Resultat_Recuperation_Articles != 0) { ?>
            <?php while ($Donnees_Recuperation_Articles = $Parametres_Recuperation_Articles->fetch()) { ?>
                <div class="Article_Marche" id="Article_Vente_<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>">
                    <div class="Nom_Article">

                        <div class="Type_Article"><?= $Donnees_Recuperation_Articles->nom_categorie; ?></div>

                        <?php echo htmlentities($Donnees_Recuperation_Articles->designation); ?>
                        <?php if ($Donnees_Recuperation_Articles->id_proprietaire == $this->objAccount->getId()) { ?>
                            <img title="Annuler la vente de <?= $Donnees_Recuperation_Articles->name; ?>" onclick="Ouverture_Dialogue(<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>)" class="Bouton_Supprimer_Vente" src="../../images/invalid.gif" width="12" />
                        <?php } ?>
                        <div class="Level_Personnage">Niveau <?= $Donnees_Recuperation_Articles->level; ?></div>
                    </div>
                    <div class="Prix_Article">
                        <div class="Position_Label_Prix">Prix :</div>
                        <div class="Position_Prix"><?php echo \FonctionsUtiles::Formatage_Yangs($Donnees_Recuperation_Articles->prix); ?></div>
                        <?php if ($Donnees_Recuperation_Articles->id_devise == "1") { ?>
                            <div class="Icone_Piece"><img src="../../images/rectopiece.png" title="Vamonaies" width="16" height="16" /></div>
                        <?php } else if ($Donnees_Recuperation_Articles->id_devise == "2") { ?>
                            <div class="Icone_Piece"><img src="../../images/versopiece.png" title="Tananaies" width="16" height="16" /></div>
                        <?php } ?>
                    </div>
                    <div class="Icone_Article">

                        <?php if ($Donnees_Recuperation_Articles->job == "0") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Guerrier_Homme.png" height="68" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "1") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Ninja_Femme.png" height="68" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "2") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Sura_Homme.png" height="68" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "3") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Chaman_Femme.png" height="68" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "4") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Guerrier_Femme.png" height="68" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "5") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Ninja_Homme.png" height="68" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "6") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Sura_Femme.png" height="68" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "7") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Chaman_Homme.png" height="68" />
                        <?php } ?>

                    </div>
                    <div class="Description_Article">
                        <?php echo htmlentities($Donnees_Recuperation_Articles->description); ?>
                    </div>
                    <div class="Detail_Article">
                        <a rel="superbox[iframe][950x500]" href="pages/Marche/MarchePlayerInfo.php?id_marche_perso=<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>"><img title="Voir les informations de l'article" style="display: inline; width: 63px; border-right: 1px solid grey; margin-right: -1px; padding: 0px;"  class="Position_Loupe_Detail" src="../../images/icones/marche_infos.png" width="65" height="43"/></a>
                        <img title="Acheter cette article" onclick="Ouverture_Dialogue_Achat(<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>);" style="display: inline; width: 63px; border-left: 1px solid grey; margin-left: -2px; padding: 0px;" class="Position_Loupe_Detail" src="../../images/icones/marche_buy.png" width="65" height="43"/>
                    </div>
                </div>
            <?php } ?>

            <div id="dialog_Confirmation_Acheter_Article" title="Une confirmation est requise">Confirmer votre achat ?</div>
            <input style="display: none;" id="Id_Tempo_Message2" value="" />

            <div id="dialog_Confirmation_Annuler_Vente" title="Une confirmation est requise">Confirmer l'annulation de la vente ?</div>
            <input style="display: none;" id="Id_Tempo_Message" value="" />

            <script type="text/javascript">

                $(function () {
                    $.superbox.settings = {
                        closeTxt: "Fermer",
                        loadTxt: "Chargement...",
                        boxWidth: "400",
                        boxHeight: "300"
                    };
                    $.superbox();
                });

                $(function () {
                    $("#dialog_Confirmation_Annuler_Vente").dialog({
                        resizable: false,
                        autoOpen: false,
                        modal: true,
                        buttons: {
                            "Je confirme": function () {
                                $(this).dialog("close");
                                Retirer_De_La_Vente();

                            },
                            "Annuler": function () {
                                $(this).dialog("close");
                                window.parent.Barre_De_Statut("Annulation annulé.");
                                window.parent.Icone_Chargement(2);
                            }
                        }
                    });

                });

                $(function () {
                    $("#dialog_Confirmation_Acheter_Article").dialog({
                        resizable: false,
                        autoOpen: false,
                        modal: true,
                        buttons: {
                            "Je confirme": function () {
                                $(this).dialog("close");
                                Acquisition_Article();

                            },
                            "Annuler": function () {
                                $(this).dialog("close");
                                window.parent.Barre_De_Statut("Achat annulé.");
                                window.parent.Icone_Chargement(2);
                            }
                        }
                    });

                });

                function Ouverture_Dialogue_Achat(id_message) {

                    window.parent.Barre_De_Statut("En attente de la confirmation...");
                    window.parent.Icone_Chargement(1);

                    $("#Id_Tempo_Message2").val(id_message);
                    $("#dialog_Confirmation_Acheter_Article").dialog("open");
                }

                function Acquisition_Article() {

                    window.parent.Barre_De_Statut("Réalisation de l'achat...");
                    window.parent.Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Marche/ajax/SQL_Procedure_Achat_Personnage.php",
                        data: "id_marche_personnage=" + $("#Id_Tempo_Message2").val(),
                        success: function (msg) {

                            try {

                                Parse_Json = JSON.parse(msg);

                                if (Parse_Json.result == "WIN") {

                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/Update_Vamonaies.php",
                                        success: function (msg) {
                                            window.parent.Fonction_Reteneuse_Vamonaies(msg);
                                        }
                                    });

                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/Update_Tananaies.php",
                                        success: function (msg) {
                                            window.parent.Fonction_Reteneuse_Tananaies(msg);
                                        }
                                    });

                                    Ajax_Appel_Marche('pages/Marche/MarcheMySales.php');

                                } else if (Parse_Json.result == "FAIL") {

                                    window.parent.Barre_De_Statut(Parse_Json.reasons);
                                    window.parent.Icone_Chargement(2);
                                }

                            } catch (e) {

                                window.parent.Barre_De_Statut("Annulation échoué.");
                                window.parent.Icone_Chargement(2);
                            }
                        }
                    });
                    return false;
                }

                function Ouverture_Dialogue(id_message) {

                    window.parent.Barre_De_Statut("En attente de la confirmation...");
                    window.parent.Icone_Chargement(1);

                    $("#Id_Tempo_Message").val(id_message);
                    $("#dialog_Confirmation_Annuler_Vente").dialog("open");
                }

                function Retirer_De_La_Vente() {

                    window.parent.Barre_De_Statut("Annulation de la vente...");
                    window.parent.Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Marche/ajax/SQL_Retirer_Vente.php",
                        data: "id_marche_personnage=" + $("#Id_Tempo_Message").val(),
                        success: function (msg) {
                            try {

                                Parse_Json = JSON.parse(msg);

                                if (Parse_Json.result == "WIN") {

                                    Ajax_Appel_Marche('pages/Marche/MarcheMySales.php');

                                } else if (Parse_Json.result == "FAIL") {

                                    window.parent.Barre_De_Statut(Parse_Json.reasons);
                                    window.parent.Icone_Chargement(2);
                                }

                            } catch (e) {

                                window.parent.Barre_De_Statut("Annulation échoué.");
                                window.parent.Icone_Chargement(2);
                            }
                        }
                    });
                    return false;
                }
            </script>
        <?php } else { ?>
            <div class="Article_Marche" style="color: #FFFFFF; height: 27px; padding-top: 4px; text-indent: 6px; padding-left: 2px;">
                Vous n'avez pas de personnages en vente actuellement.
            </div>
        <?php } ?>
        <?php
    }

}

$class = new SQL_Generation_Liste_Mes_Ventes();
$class->run();
