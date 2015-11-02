<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class Marche_Place extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Tableaux_Arrays.php'; ?>
        <?php include '../../pages/Fonctions_Utiles.php'; ?>
        <?php if (!empty($_SESSION['ID'])) { ?>


            <div id="Div_Marche_Filtres" class="Div_Marche_Filtres">
                <table class="Tableau_Filtre">
                    <tr>
                        <th colspan="2">Filtres de recherche</th>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche">Race : </td>
                        <td>
                            <select id="Selecteur_Filtre_Ventes_Race" onchange="Ajax_Appel_Liste()">
                                <option value="*">Toutes races</option>
                                <option value="gu">Guerriers</option>
                                <option value="ni">Ninjas</option>
                                <option value="sh">Shamans</option>
                                <option value="su">Suras</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche">Sexe : </td>
                        <td>
                            <select id="Selecteur_Filtre_Ventes_Sexe" onchange="Ajax_Appel_Liste()">
                                <option value="*">Tous sexe</option>
                                <option value="1">Hommes</option>
                                <option value="0">Femmes</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche">Niveau : </td>
                        <td>
                            <select id="Selecteur_Filtre_Ventes_Level" onchange="Ajax_Appel_Liste()">
                                <option value="*">De 100 à 270</option>
                                <option value="1">De 1 à 100</option>
                                <option value="2">De 101 à 200</option>
                                <option value="3">De 201 à 270</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche">Prix : </td>
                        <td>
                            <select id="Selecteur_Filtre_Ventes_Ordre" onchange="Ajax_Appel_Liste()">
                                <option value="*">Aléatoire</option>
                                <option value="1">Croissant</option>
                                <option value="2">Décroissant</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche">Monnaie : </td>
                        <td>
                            <select id="Selecteur_Filtre_Ventes_Monnaie" onchange="Ajax_Appel_Liste()">
                                <option value="*">Peu importe</option>
                                <option value="1">Vamonaies</option>
                                <option value="2">Tananaies</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche">Date annonces : </td>
                        <td>
                            <select id="Selecteur_Filtre_Ventes_Date" onchange="Ajax_Appel_Liste()">
                                <option value="*">Aléatoires</option>
                                <option value="1">Récentes</option>
                                <option value="2">Anciennes</option>
                            </select>
                        </td>
                    </tr>
                </table>

                <div class="Texte_Vente_Place">
                    Depuis cette interface, vous pouvez acheter un personnage contre des monnaies.<br/>
                    Toutes fraudes seront sévèrement sanctionnés.
                </div>
            </div>


            <div id="Div_Marche_Articles" class="Div_Marche_Articles">
                <table id="Tableau_Liste_Article">

                </table>
            </div>

            <script type="text/javascript">

                function Ajax_Appel_Liste(param) {

                    window.parent.Barre_De_Statut("Génération de la liste...");
                    window.parent.Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "SQL_Generation_Liste.php",
                        data: "race=" + $("#Selecteur_Filtre_Ventes_Race").val()
                                + "&sexe=" + $("#Selecteur_Filtre_Ventes_Sexe").val()
                                + "&level=" + $("#Selecteur_Filtre_Ventes_Level").val()
                                + "&ordre=" + $("#Selecteur_Filtre_Ventes_Ordre").val()
                                + "&monnaie=" + $("#Selecteur_Filtre_Ventes_Monnaie").val()
                                + "&date=" + $("#Selecteur_Filtre_Ventes_Date").val(),
                        success: function (msg) {

                            $("#Tableau_Liste_Article").fadeOut("medium", function () {
                                $("#Tableau_Liste_Article").html(msg);
                                window.parent.Barre_De_Statut("Liste d'articles généré.");
                                window.parent.Icone_Chargement(0);
                                $("#Tableau_Liste_Article").fadeIn("medium");
                            });

                        }
                    });
                    return false;
                }

                Ajax_Appel_Liste(0);
            </script>

        <?php } else { ?>

            <?php include 'Marche_Non_Connecter.php'; ?>

        <?php } ?>
        <?php
    }

}

$class = new Marche_Place();
$class->run();
