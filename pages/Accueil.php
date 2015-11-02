<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Accueil extends \PageHelper {

    public function run() {

        include '../pages/Fonctions_Utiles.php';

        /* ------------------------ Vérification Données ---------------------------- */
        $Recuperation_News = "SELECT * 
                      FROM site.admin_news
                      ORDER BY date DESC
                      LIMIT 0, 4";
        $Parametres_Recuperation_News = $this->objConnection->prepare($Recuperation_News);
        $Parametres_Recuperation_News->execute();
        $Parametres_Recuperation_News->setFetchMode(\PDO::FETCH_OBJ);
        /* -------------------------------------------------------------------------- */

        /* ------------------------ Recherche Auteur ---------------------------- */
        $Recherche_Auteur = "SELECT pseudo_messagerie 
                      FROM account.account
                      WHERE id = ?
                      LIMIT 1";
        $Parametres_Recherche_Auteur = $this->objConnection->prepare($Recherche_Auteur);
        /* -------------------------------------------------------------------------- */

        $Variable_De_Merde = 0;

        while ($Donnees_Recuperation_News = $Parametres_Recuperation_News->fetch()) {
            ?>
            <?php
            $Variable_De_Merde++;
            $Parametres_Recherche_Auteur->execute(array($Donnees_Recuperation_News->auteur));
            $Parametres_Recherche_Auteur->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Recherche_Auteur = $Parametres_Recherche_Auteur->fetch();
            ?>

            <div class="box box-default flat">

                <div class="box-header">
                    <h3 class="box-title"><?= $Donnees_Recuperation_News->titre_message; ?></h3>

                    <div class="box-tools" style="padding-top: 5px;">
                        <i data-tooltip-position="left" data-tooltip="<?= Formatage_Date_News($Donnees_Recuperation_News->date); ?>" class="material-icons md-icon-event md-20"></i>
                    </div>
                </div>

                <div class="box-body">

                    <?php if ($Donnees_Recuperation_News->lien_illustration != "") { ?>
                        <div class="Texte_News">
                            <img class="Image_News" style="float: left;" height="100" src="<?= $Donnees_Recuperation_News->lien_illustration; ?>" />
                            <div style="position: relative; padding-right: 4px; left:4px;"><?= $Donnees_Recuperation_News->contenue_message; ?></div>
                        </div>
                    <?php } else { ?>
                        <?= $Donnees_Recuperation_News->contenue_message; ?>
                    <?php } ?>


                    <div style="position: absolute; bottom: 2px; right: 6px; color: grey;">
                        <small>Publié par <?= $Donnees_Recherche_Auteur->pseudo_messagerie; ?></small>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}

$class = new Accueil();
$class->run();