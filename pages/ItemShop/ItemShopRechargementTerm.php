<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class ItemShopRechargementTerm extends \PageHelper {

    public $isProtected = true;
    
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

                        <?php
                        if ($_GET['Resultat'] == "Reussi") {
                            ?>

                            <?php if ($_GET['compteur'] == "oui") { ?>
                                <script type="text/javascript">

                                    window.parent.Barre_De_Statut("Achat effectué.");
                                    window.parent.Icone_Chargement(0);

                                    window.parent.Fonction_Reteneuse_Vamonaies(<?php echo $_SESSION['VamoNaies']; ?>);
                                </script>
                            <?php } ?>

                            Votre rechargement s'est effectué avec succès.<br/><br/>
                            Votre numéro unique de transaction est le : <span class="user_select"><?php echo $_GET['id']; ?></span><br/><br/>
                            Conservez le précieusement il vous servira en cas de réclamation auprès du support.<br/>

                        <?php } else if ($_GET["Resultat"] == "Rate") { ?>

                        <?php } ?>

                    </div>
                </div>
            </body>
        </html>
        <?php
    }

}

$class = new ItemShopRechargementTerm();
$class->run();
