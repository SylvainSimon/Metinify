<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class Marche_Mes_Ventes extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Tableaux_Arrays.php'; ?>
        
        <?php if (!empty($_SESSION['ID'])) { ?>


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
                        url: "SQL_Generation_Liste_Mes_Ventes.php",
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

        <?php } else { ?>

            <?php include 'Marche_Non_Connecter.php'; ?>

        <?php } ?>
        <?php
    }

}

$class = new Marche_Mes_Ventes();
$class->run();
