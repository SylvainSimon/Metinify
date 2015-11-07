<?php

namespace Home;

require __DIR__ . '../../../../core/initialize.php';

class Barre_Superieur_Connectes extends \PageHelper {

    public function run() {
        ?>

        <div class="col-md-7 col-sm-7 col-xs-7">

            <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-5" style="padding-left: 40px;">
                    Bienvenue <span onclick="Ajax('pages/MonCompte/HistoryConnexion.php')" data-tooltip="Historique des connexions" class="Bold Pointer"><?php echo $_SESSION['Utilisateur'] ?></span>
                </div>

                <div style="position: relative; left:-4px; top: -1px;"  class="col-lg-5 col-md-6 col-sm-6">
                    <span data-tooltip="VamoNaies">
                        <img class="inline" src="images/rectopiece.png" height="35"/>
                        <div class="inline" id="Nombre_De_Vamonaies"><?php echo $_SESSION['VamoNaies']; ?></div>
                    </span>

                    <span data-tooltip="TanaNaies">
                        <img class="inline" src="images/versopiece.png" height="35"/>
                        <div class="inline" id="Nombre_De_Tananaies"><?php echo $_SESSION['TanaNaies']; ?></div>
                    </span>
                </div>
            </div>
        </div>

        <div class="" style="margin-right: 10px;">

            <div class="pull-right">

                <span class="iconStatutServer visible-xs-inline visible-sm-inline" style="top: 7px; position: relative; margin-left: 7px;"></span>

                <?php include BASE_ROOT . '/pages/Messagerie/includes/Messagerie_Notifications.php'; ?>

                <i data-tooltip="Activer/Désactiver le son" data-tooltip-position='left' style="top: 7px; position: relative; margin-left: 7px;" id="Icone_Sons" class="" onclick="SoundNotificationToggle(0)"></i>
                <script type="text/javascript">

                    SoundNotificationToggle(1);

                    setTimeout("Actualisation_Messages()", 20000);

                </script>


                <a data-tooltip="Déconnexion" data-tooltip-position='left' class="pull-right" style="cursor: pointer; margin-left: 7px;" onclick="Ajax_Connexion('pages/_Home/includes/Barre_Deconnexion.php')">
                    <i style="top: 7px; position: relative;" class="material-icons md-icon-power md-24 text-red"></i>
                </a>
            </div>
        </div>

        <?php
    }

}

$class = new Barre_Superieur_Connectes();
$class->run();