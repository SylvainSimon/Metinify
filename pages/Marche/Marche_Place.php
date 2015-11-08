<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class Marche_Place extends \PageHelper {

    public $isProtected = true;

    public function run() {

        include '../../pages/Tableaux_Arrays.php';
        ?>

        <div class="row">
            <div class="col-lg-3">
                <table class="table table-condensed" style="border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 0px;">
                            <select id="Selecteur_Filtre_Ventes_Race" class="select2" onchange="Ajax_Appel_Liste()">
                                <option value="*">Toutes races</option>
                                <option value="gu">Guerriers</option>
                                <option value="ni">Ninjas</option>
                                <option value="sh">Shamans</option>
                                <option value="su">Suras</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 0px;">
                            <select id="Selecteur_Filtre_Ventes_Sexe" class="select2" onchange="Ajax_Appel_Liste()">
                                <option value="*">Tous sexe</option>
                                <option value="1">Hommes</option>
                                <option value="0">Femmes</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 0px;">
                            <select id="Selecteur_Filtre_Ventes_Level" class="select2" onchange="Ajax_Appel_Liste()">
                                <option value="*">De 100 à 270</option>
                                <option value="1">De 1 à 100</option>
                                <option value="2">De 101 à 200</option>
                                <option value="3">De 201 à 270</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 0px;">
                            <select id="Selecteur_Filtre_Ventes_Ordre" class="select2" onchange="Ajax_Appel_Liste()">
                                <option value="*">Aléatoire</option>
                                <option value="1">Croissant</option>
                                <option value="2">Décroissant</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 0px;">
                            <select id="Selecteur_Filtre_Ventes_Monnaie" class="select2" onchange="Ajax_Appel_Liste()">
                                <option value="*">Peu importe</option>
                                <option value="1">Vamonaies</option>
                                <option value="2">Tananaies</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 0px;">
                            <select id="Selecteur_Filtre_Ventes_Date" class="select2" onchange="Ajax_Appel_Liste()">
                                <option value="*">Ordre aléatoires</option>
                                <option value="1">Plus récentes</option>
                                <option value="2">Plus anciennes</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-9" style="">
                <div id="Tableau_Liste_Article" style="padding: 10px;">

                </div>
            </div>
        </div>
        <script type="text/javascript">

            function Ajax_Appel_Liste(param) {

                window.parent.Barre_De_Statut("Génération de la liste...");
                window.parent.Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "pages/Marche/ajax/SQL_Generation_Liste.php",
                    data: "race=" + $("#Selecteur_Filtre_Ventes_Race").val()
                            + "&sexe=" + $("#Selecteur_Filtre_Ventes_Sexe").val()
                            + "&level=" + $("#Selecteur_Filtre_Ventes_Level").val()
                            + "&ordre=" + $("#Selecteur_Filtre_Ventes_Ordre").val()
                            + "&monnaie=" + $("#Selecteur_Filtre_Ventes_Monnaie").val()
                            + "&date=" + $("#Selecteur_Filtre_Ventes_Date").val(),
                    success: function (msg) {

                        $("#Tableau_Liste_Article").html(msg);
                        window.parent.Barre_De_Statut("Liste d'articles généré.");
                        window.parent.Icone_Chargement(0);
                        
                        redraw();

                    }
                });
                return false;
            }

            Ajax_Appel_Liste(0);
        </script>

        <?php
    }

}

$class = new Marche_Place();
$class->run();
