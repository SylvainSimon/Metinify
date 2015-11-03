<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class payement_false extends \PageHelper {

    public function run() {
        ?>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <script src='../../components/jquery/jquery.min.js' type='text/javascript'></script>
                <script src='../../components/jquery-ui/jquery-ui.min.js' type='text/javascript'></script>

                <link rel="stylesheet" href="../../css/Item_Shop.css">

            </head>
            <body>
                <div id="Rechargement_Resultat_Titre">
                    Résultat du rechargement
                </div>
                <div class="Contenue_Resultat_Rechargement">
                    <div class="Texte_Resultat_Rechargement">

                        Le code Allopass que vous avez saisie est non-valide.<br/><br/>
                        Votre rechargement a été annulé, pensez à conserver ce code si vous souhaitez faire
                        une réclamation auprès du support de VamosMT2.
                    </div>
                </div>
            </body>
        </html>
        <?php
    }

}

$class = new payement_false();
$class->run();
