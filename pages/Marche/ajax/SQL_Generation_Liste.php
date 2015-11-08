<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Generation_Liste extends \ScriptHelper {

    public $isProtected = true;

    public function run() {
        ?>

        <?php
        $Filtre_Race = $_POST["race"];
        $Filtre_Sexe = $_POST["sexe"];
        $Filtre_Level = $_POST["level"];
        $Filtre_Ordre = $_POST["ordre"];
        $Filtre_Monnaie = $_POST["monnaie"];
        $Filtre_Date = $_POST["date"];

        $Tableau_Race = array("gu", "ni", "sh", "su");
        $Tableau_Sexe = array("0", "1");
        $Tableau_Level = array("1", "2", "3");

        $Tableau_Ordre = array("1", "2");
        $Tableau_Monnaie = array("1", "2");

        $Variable_Race = "";
        $Variable_Sexe = "";
        $Variable_Level = "";
        $Variable_Ordre = "ORDER BY RAND()";
        $Variable_Monnaie = "";
        $Variable_Date = "";

        if (in_array($Filtre_Race, $Tableau_Race)) {
            if ($Filtre_Race == "gu") {
                $Variable_Race = " AND (player.job LIKE 0 OR player.job LIKE 4) ";
            } else if ($Filtre_Race == "ni") {
                $Variable_Race = " AND (player.job LIKE 1 OR player.job LIKE 5) ";
            } else if ($Filtre_Race == "sh") {
                $Variable_Race = " AND (player.job LIKE 3 OR player.job LIKE 7) ";
            } else if ($Filtre_Race == "su") {
                $Variable_Race = " AND (player.job LIKE 2 OR player.job LIKE 6) ";
            } else {
                $Variable_Race = "";
            }
        } else {
            $Variable_Race = "";
        }

        if (in_array($Filtre_Sexe, $Tableau_Sexe)) {
            if ($Filtre_Sexe == "0") {
                $Variable_Sexe = " AND (player.job LIKE 1 OR player.job LIKE 3 OR player.job LIKE 4 OR player.job LIKE 6) ";
            } else if ($Filtre_Sexe == "1") {
                $Variable_Sexe = " AND (player.job LIKE 0 OR player.job LIKE 2 OR player.job LIKE 5 OR player.job LIKE 7) ";
            } else {
                $Variable_Sexe = "";
            }
        } else {
            $Variable_Sexe = "";
        }

        if (in_array($Filtre_Level, $Tableau_Level)) {
            if ($Filtre_Level == "1") {
                $Variable_Level = " AND player.level >= 1 AND player.level <= 100";
            } else if ($Filtre_Level == "2") {
                $Variable_Level = " AND player.level >= 101 AND player.level <= 200";
            } else if ($Filtre_Level == "3") {
                $Variable_Level = " AND player.level >= 201 AND player.level <= 270";
            } else {
                $Variable_Level = "";
            }
        } else {
            $Variable_Level = " AND player.level >= 100 AND player.level <= 270";
        }

        if (in_array($Filtre_Ordre, $Tableau_Ordre)) {
            if ($Filtre_Ordre == "1") {
                $Variable_Ordre = " ORDER BY marche_articles.prix ASC ";
            } else if ($Filtre_Ordre == "2") {
                $Variable_Ordre = " ORDER BY marche_articles.prix DESC ";
            } else {
                $Variable_Ordre = "ORDER BY RAND()";
            }
        } else {
            $Variable_Ordre = "ORDER BY RAND()";
        }

        if (in_array($Filtre_Monnaie, $Tableau_Monnaie)) {
            if ($Filtre_Monnaie == "1") {
                $Variable_Monnaie = " AND marche_articles.devise = 1 ";
            } else if ($Filtre_Monnaie == "2") {
                $Variable_Monnaie = " AND marche_articles.devise = 2 ";
            } else {
                $Variable_Monnaie = "";
            }
        } else {
            $Variable_Monnaie = "";
        }


        /* ----------------------- Recuperation Date ------------------------------- */
        $Recuperation_Articles = "SELECT 
            marche_articles.designation, 
            marche_articles.description, 
            marche_articles.devise AS id_devise, 
            marche_articles.prix, 
            marche_categories.nom_categorie, 
            marche_devises.devise, 
            marche_personnages.id_proprietaire, 
            marche_personnages.id AS id_marche_personnage, 
            player.level, 
            player.name, 
            player.job
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
                          $Variable_Sexe 
                          $Variable_Race
                          $Variable_Level
                          $Variable_Monnaie
						  $Variable_Date
                          $Variable_Ordre
                          LIMIT 100";


        $Parametres_Recuperation_Articles = $this->objConnection->prepare($Recuperation_Articles);
        $Parametres_Recuperation_Articles->execute();
        $Parametres_Recuperation_Articles->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recuperation_Articles = $Parametres_Recuperation_Articles->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>
        <?php if ($Nombre_De_Resultat_Recuperation_Articles != 0) { ?>
            <?php while ($Donnees_Recuperation_Articles = $Parametres_Recuperation_Articles->fetch()) { ?>


                <div class="Article_Marche" data-tooltip="<?php echo $Donnees_Recuperation_Articles->description; ?>" data-tooltip-isItemMetin="1" data-tooltip-track="1" id="Article_Vente_<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>">

                    <div class="Nom_Article_Marche">
                        
                        <?php echo htmlentities($Donnees_Recuperation_Articles->designation); ?>
                        
                        <?php if ($Donnees_Recuperation_Articles->id_proprietaire == $_SESSION["ID"]) { ?>
                            <img data-tooltip="Annuler la vente de <?= $Donnees_Recuperation_Articles->name; ?>" onclick="Retirer_De_La_Vente(<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>)" class="Bouton_Supprimer_Vente" src="../../images/invalid.gif" width="12" />
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
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Guerrier_Homme.png" height="90" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "1") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Ninja_Femme.png" height="90" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "2") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Sura_Homme.png" height="90" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "3") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Chaman_Femme.png" height="90" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "4") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Guerrier_Femme.png" height="90" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "5") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Ninja_Homme.png" height="90" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "6") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Sura_Femme.png" height="90" />
                        <?php } else if ($Donnees_Recuperation_Articles->job == "7") { ?> 
                            <img class="Position_Icone_Article_Personnage" src="../../images/races/Chaman_Homme.png" height="90" />
                        <?php } ?>

                    </div>

                    <div>
                        <a rel="superbox[iframe][950x500]" href="pages/Marche/Marche_Detail_Personnage.php?id_marche_perso=<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>">
                            <i data-tootlip="Voir les informations de l'article" class="material-icons md-icon-help md-48"></i>
                        </a>

                        <a onclick="Acquisition_Article(<?= $Donnees_Recuperation_Articles->id_marche_personnage; ?>);">
                            <i data-tootlip="Acheter cette article" class="material-icons md-icon-shopping_cart md-48"></i>
                        </a>

                    </div>
                </div>
            <?php } ?>

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

                function Ouverture_Dialogue_Achat(id_message) {

                    window.parent.Barre_De_Statut("En attente de la confirmation...");
                    window.parent.Icone_Chargement(1);

                    $("#dialog_Confirmation_Acheter_Article").dialog("open");
                }

                function Acquisition_Article(id) {

                    bootbox.dialog({
                        message: "Confirmez-vous l'achat de ce personnage ?",
                        animate: false,
                        className: "myBootBox",
                        title: 'Confirmation de la demande',
                        buttons: {
                            danger: {
                                label: "Annuler",
                                className: "btn-danger",
                                callback: function () {

                                }
                            },
                            success: {
                                label: "Confirmer",
                                className: "btn-primary",
                                callback: function () {

                                    window.parent.Barre_De_Statut("Réalisation de l'achat...");
                                    window.parent.Icone_Chargement(1);

                                    $.ajax({
                                        type: "POST",
                                        url: "pages/Marche/ajax/SQL_Procedure_Achat_Personnage.php",
                                        data: "id_marche_personnage=" + id,
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

                                                    Ajax_Appel_Marche('Marche_Place.php');

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
                                }
                            }
                        }
                    });



                }


                function Retirer_De_La_Vente(id) {

                    bootbox.dialog({
                        message: "Confirmez-vous l'annulation de la vente de ce personnage ?",
                        animate: false,
                        className: "myBootBox",
                        title: 'Confirmation de la demande',
                        buttons: {
                            danger: {
                                label: "Annuler",
                                className: "btn-danger",
                                callback: function () {

                                }
                            },
                            success: {
                                label: "Confirmer",
                                className: "btn-primary",
                                callback: function () {

                                    window.parent.Barre_De_Statut("Annulation de la vente...");
                                    window.parent.Icone_Chargement(1);

                                    $.ajax({
                                        type: "POST",
                                        url: "pages/Marche/ajax/SQL_Retirer_Vente.php",
                                        data: "id_marche_personnage=" + id,
                                        success: function (msg) {
                                            try {

                                                Parse_Json = JSON.parse(msg);

                                                if (Parse_Json.result == "WIN") {

                                                    Ajax_Appel_Marche('Marche_Place.php');

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
                                }
                            }
                        }
                    });
                }
            </script>

        <?php } else { ?>
            <div>
                Aucun personnage n'a été trouvé.
            </div>
        <?php } ?>
        <?php
    }

}

$class = new SQL_Generation_Liste();
$class->run();
