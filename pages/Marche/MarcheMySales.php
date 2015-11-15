<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class MarcheMySales extends \PageHelper {

    public $isProtected = true;

    public function run() {

        include '../../pages/Tableaux_Arrays.php';
        ?>

        <div id="Div_Marche_Filtres" class="Div_Marche_Filtres">


            <div class="Texte_Vente_Place">
                Vous pouvez retirer un de vos personnages de la vente depuis cette interface de gestion.<br />
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
                    url: "pages/Marche/ajax/SQL_Generation_Liste_Mes_Ventes.php",
                    data: "race=" + $("#Selecteur_Filtre_Ventes_Race").val()
                            + "&sexe=" + $("#Selecteur_Filtre_Ventes_Sexe").val()
                            + "&level=" + $("#Selecteur_Filtre_Ventes_Level").val()
                            + "&ordre=" + $("#Selecteur_Filtre_Ventes_Ordre").val()
                            + "&monnaie=" + $("#Selecteur_Filtre_Ventes_Monnaie").val(),
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

        <?php
    }

}

$class = new MarcheMySales();
$class->run();
