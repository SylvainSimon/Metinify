<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Gestion_News extends \PageHelper {

    public function run() {
        ?>
        
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link rel="stylesheet" href="../css/Administration.css">
                <link rel="stylesheet" href="../../css/jquery-ui-1.8.23.custom.css">
                <script type="text/javascript" src="../../js/Jquery 1.8.0.js"></script>
            </head>
            <body>
                <?php if (!empty($_SESSION["Administration_PannelAdmin_Jeton"])) { ?>

                    <?php
                    /* ------------------------ Vérification Données ---------------------------- */
                    $Recuperation_Droits = "SELECT * 
                                    FROM site.administration_users
                                    WHERE id_compte = :id_compte
                                    LIMIT 1";
                    $Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
                    $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
                    $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
                    /* -------------------------------------------------------------------------- */
                    ?>
                    <?php if ($Nombre_De_Resultat_Recuperation_Droits != 0) { ?>
                        <?php $Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch(); ?>

                        <?php if ($Donnees_Recuperation_Droits->gerer_news == 1) { ?>
                            <div class="Administration_Header">
                                Gestion des news
                            </div>

                        <?php } else { ?>
                            <?php include 'Interdiction_Acces_Grand.php'; ?>
                        <?php } ?>

                    <?php } else { ?>
                        <?php include 'Interdiction_Acces_Grand.php'; ?>
                    <?php } ?>

                <?php } else { ?>
                    <?php include 'Interdiction_Acces_Grand.php'; ?>
                <?php } ?>
            </body>
        </html>
        <?php
    }

}

$class = new Gestion_News();
$class->run();
