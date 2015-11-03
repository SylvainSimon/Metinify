<?php

namespace Includes;

require __DIR__ . '../../core/initialize.php';

class Marche_Detail_Personnage extends \PageHelper {

    public function run() {
        ?>
        
        <?php
        /* -------------------- Recuperation_Marche_Personnage ---------------------- */
        $Recuperation_Marche_Personnage = "SELECT id_personnage
                                   FROM site.marche_personnages
                                   WHERE id = ?
                                   LIMIT 1";
        $Parametres_Recuperation_Marche_Personnage = $this->objConnection->prepare($Recuperation_Marche_Personnage);
        $Parametres_Recuperation_Marche_Personnage->execute(array(
            $_GET["id_marche_perso"]));
        $Parametres_Recuperation_Marche_Personnage->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recuperation_Marche_Personnage = $Parametres_Recuperation_Marche_Personnage->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>

        <?php if ($Nombre_De_Resultat_Recuperation_Marche_Personnage != 0) { ?>
            <?php $Donnees_Recuperation_Marche_Personnage = $Parametres_Recuperation_Marche_Personnage->fetch(); ?>
            <?php
            /* --------------------------- Appel Joueur Page ---------------------------- */
            $Appel_Joueur_Page = "SELECT *
                            FROM player.player
                            WHERE player.id = :id_personnage
                            LIMIT 1";

            $Parametres_Appel_Joueur_Page = $this->objConnection->prepare($Appel_Joueur_Page);
            $Parametres_Appel_Joueur_Page->execute(array(
                "id_personnage" => $Donnees_Recuperation_Marche_Personnage->id_personnage));
            $Parametres_Appel_Joueur_Page->setFetchMode(\PDO::FETCH_OBJ);
            /* --------------------------------------------------------------------------- */

            $Donnees_Appel_Joueurs_Page = $Parametres_Appel_Joueur_Page->fetch();
            ?>

            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <link rel="stylesheet" href="../css/demos.css">
                    <link rel="stylesheet" href="../css/jquery-ui-1.8.23.custom.css">
                <script src='../components/jquery/jquery.min.js' type='text/javascript'></script>
                <script src='../components/jquery-ui/jquery-ui.min.js' type='text/javascript'></script>
                </head>
                <body>

                    <div id="Detail_Vente_Partie_Haute">
                        <span class="Titre_Fenetre_Detail_Vente">Détails de l'article</span>
                        <div class="Bouton_Fermer_Fenetre Pointer" onclick="window.parent.jQuery.superbox.close();"></div>
                    </div>

                    <table class="Tableau_Informations_Detail_Vente">
                        <tr>
                            <th colspan="2">Informations générales : </th>
                        </tr>
                        <tr>
                            <td class="Colonne_Gauche">Pseudo : </td>
                            <td><?= $Donnees_Appel_Joueurs_Page->name; ?></td>
                        </tr>
                        <tr>
                            <td class="Colonne_Gauche">Level : </td>
                            <td><?= $Donnees_Appel_Joueurs_Page->level; ?></td>
                        </tr>
                        <tr>
                            <td class="Colonne_Gauche">Race : </td>
                            <td><img class="Images_Recherches" height="16" title="<?= \FonctionsUtiles::Find_Name_Race($Donnees_Appel_Joueurs_Page->job); ?>"  src="../<?= \FonctionsUtiles::Find_Image_Race($Donnees_Appel_Joueurs_Page->job); ?>" /></td>
                        </tr>
                        <tr>
                            <td class="Colonne_Gauche">Yangs : </td>
                            <td><?= \FonctionsUtiles::Formatage_Yangs($Donnees_Appel_Joueurs_Page->gold); ?></td>
                        </tr>
                    </table>

                    <?php
                    $lHeure = floor($Donnees_Appel_Joueurs_Page->playtime / 60);
                    $lesMinutes = (($Donnees_Appel_Joueurs_Page->playtime) % 60);
                    $lJours = floor($lHeure / 24);

                    $lHeure = ($lHeure - ($lJours * 24));

                    if ($lesMinutes < 10) {

                        $lesMinutes = "0" . $lesMinutes;
                    }
                    ?>

                    <table class="Tableau_Informations_Temps_de_Jeux_Vente">
                        <tr>
                            <th colspan="2" class="Colonne_Gauche">Temps de jeu : </th>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $lJours . " jours et " . $lHeure . "h" . $lesMinutes . "min."; ?></td>
                        </tr>
                    </table>

                </div>

                <div id="Inventaire" style="position: absolute; left:228px;">

                    <div class="Bouton_Inventaire_1 Cursor" onclick="Page_Inventaire(1);"> I </div>
                    <div class="Bouton_Inventaire_2 Cursor" onclick="Page_Inventaire(2);"> II </div>
                    <div class="Bouton_Inventaire_3 Cursor" onclick="Page_Inventaire(3);"> III </div>
                    <div class="Bouton_Inventaire_4 Cursor" onclick="Page_Inventaire(4);"> IV </div>

                    <script type="text/javascript">

                        function Page_Inventaire(page) {

                            window.parent.parent.Barre_De_Statut("Chargement de l'inventaire...");
                            window.parent.parent.Icone_Chargement(1);

                            $.ajax({
                                type: "POST",
                                url: "pages/MonPersonnage/ajax/ajaxInventairePage" + page + ".php",
                                data: "id=<?php echo $Donnees_Recuperation_Marche_Personnage->id_personnage; ?>", // données à transmettre
                                success: function (msg) {

                                    $("#Conteneur_Inventaire").fadeOut("slow", function () {
                                        $("#Conteneur_Inventaire").html(msg);
                                        window.parent.parent.Barre_De_Statut("Inventaire chargé.");
                                        window.parent.parent.Icone_Chargement(0);
                                        $("#Conteneur_Inventaire").fadeIn("slow");
                                    });
                                }
                            });
                            return false;

                        }

                        Page_Inventaire(1);

                    </script>

                    <div id="Conteneur_Inventaire">


                    </div>

                </div>

                <div id="Conteneur_Bonus" style="position: absolute; left:421px;">
                    <div id="Haut_Bonus"></div>
                    <div id="Milieu_Bonus">
                        <div id="Contenue_Milieu_Bonus" style="min-height:100px;">

                        </div>
                    </div>
                    <div id="Bas_Bonus"></div>
                </div>

                <?php include '../../../pages/MonPersonnage/ajax/ajaxEquipement.php'; ?>

                <?php
                /* -------------------------- Preparation des Requetes ------------------------------- */
                $Appel_Case_Equipement = "SELECT item.vnum,
                                         item.count,
                                         item.id AS item_id,
                                         item_proto.locale_name,
                                         item_proto.flag,
                                         item_proto.size
                                  FROM player.item
                                  LEFT JOIN player.item_proto
                                  ON item_proto.vnum = item.vnum
 
                                  WHERE pos = :pos
                                  AND owner_id = :owner_id
                                  AND window = :window
                                  LIMIT 1";

                $Parametres_Appel_Case_Equipement = $this->objConnection->prepare($Appel_Case_Equipement);

                /* ------------------------------------------------------------------------------------ */

                $Chercher_Chemin = "SELECT item_list.chemin
                                       FROM player.item_list
                                       WHERE item = :item
                                       LIMIT 1";

                $Parametres_Chercher_Chemin = $this->objConnection->prepare($Chercher_Chemin);
                /* ------------------------------------------------------------------------------------- */
                ?>

                <div id="Equipement" style="position: absolute; left:767px;">

                    <div class="Case_Equipement Case_Arme">
                        <?php CheckEquipement(4, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Armure">
                        <?php CheckEquipement(0, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Casque">
                        <?php CheckEquipement(1, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Bouclier">
                        <?php CheckEquipement(10, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Bracelet">
                        <?php CheckEquipement(3, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Boucles">
                        <?php CheckEquipement(6, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Collier">
                        <?php CheckEquipement(5, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Chaussure">
                        <?php CheckEquipement(2, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Fleche">
                        <?php CheckEquipement(9, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>

                    <div class="Case_Equipement Case_Special1">
                        <?php CheckEquipement(7, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>
                    <div class="Case_Equipement Case_Special2">
                        <?php CheckEquipement(8, $Donnees_Recuperation_Marche_Personnage->id_personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
                    </div>

                </div>

            </body>
            </html>

        <?php } else { ?>
            <?php include 'Marcher_Description_Interdiction.php'; ?>
        <?php } ?>
        <?php
    }

}

$class = new Marche_Detail_Personnage();
$class->run();
