<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>
<?php include '../pages/Fonctions_Utiles.php'; ?>
<?php
/* ------------------------ Vérification Données ---------------------------- */
$Recuperation_News = "SELECT * 
                      FROM $BDD_Site.admin_news
                      ORDER BY date DESC
                      LIMIT 0, 4";
$Parametres_Recuperation_News = $Connexion->prepare($Recuperation_News);
$Parametres_Recuperation_News->execute();
$Parametres_Recuperation_News->setFetchMode(PDO::FETCH_OBJ);
/* -------------------------------------------------------------------------- */

/* ------------------------ Recherche Auteur ---------------------------- */
$Recherche_Auteur = "SELECT pseudo_messagerie 
                      FROM $BDD_Account.account
                      WHERE id = ?
                      LIMIT 1";
$Parametres_Recherche_Auteur = $Connexion->prepare($Recherche_Auteur);
/* -------------------------------------------------------------------------- */

$Variable_De_Merde = 0;
?>


<?php while ($Donnees_Recuperation_News = $Parametres_Recuperation_News->fetch()) { ?>
    <?php
    $Variable_De_Merde++;
    $Parametres_Recherche_Auteur->execute(array($Donnees_Recuperation_News->auteur));
    $Parametres_Recherche_Auteur->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Recherche_Auteur = $Parametres_Recherche_Auteur->fetch();
    ?>

    <div class="box box-default flat">

        <div class="box-header">
            <h3 class="box-title"><?= $Donnees_Recuperation_News->titre_message; ?></h3>

            <div class="box-tools" style="padding-top: 5px;">
                <i title="<?= Formatage_Date_News($Donnees_Recuperation_News->date); ?>" class="material-icons md-icon-event md-20"></i>
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
<?php } ?>