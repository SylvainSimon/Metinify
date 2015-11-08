<?php

namespace pages\Marche;

require __DIR__ . '../../../core/initialize.php';

class Marche extends \PageHelper {

    public $isProtected = true;

    public function run() {
        ?>               
        <link rel="stylesheet" href="../../css/Marche.css">

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Marché des personnages</h3>
            </div>

            <div class="box-body no-padding">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="javascript:void(0)" onclick="Ajax_Appel_Marche('pages/Marche/Marche_Place.php', this)">Acheter</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Marche('pages/Marche/Marche_Vendre_Personnage.php', this)">Vendre</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Marche('pages/Marche/Marche_Mes_Ventes.php', this)">Mes ventes</a></li>
                    </ul>
                    <div id="Contenue_Cadre_Marche" class="tab-content"></div>
                </div>

                <div class="clear"></div>
            </div>
        </div>

        <script type="text/javascript">

            function Ajax_Appel_Marche(url, objet) {

                window.parent.Barre_De_Statut("Appel de l'onglet...");
                window.parent.Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "" + url,
                    success: function (msg) {

                        $("#Contenue_Cadre_Marche").html(msg);
                        window.parent.Barre_De_Statut("Chargement terminé.");
                        window.parent.Icone_Chargement(0);

                        if (objet !== false) {
                            $(".nav-tabs-custom li").attr("class", "");
                            $(objet).parent("li").attr("class", "active");
                        }
                        
                        redraw();

                    }
                });
                return false;

            }

            Ajax_Appel_Marche("pages/Marche/Marche_Place.php", false);

        </script>

        <?php
    }

}

$class = new Marche();
$class->run();
