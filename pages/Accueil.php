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
<div class="Cadre_Principal">

    <?php while ($Donnees_Recuperation_News = $Parametres_Recuperation_News->fetch()) { ?>
        <?php
        $Variable_De_Merde++;
        $Parametres_Recherche_Auteur->execute(array($Donnees_Recuperation_News->auteur));
        $Parametres_Recherche_Auteur->setFetchMode(PDO::FETCH_OBJ);
        $Donnees_Recherche_Auteur = $Parametres_Recherche_Auteur->fetch();
        ?>

        <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal(<?= $Variable_De_Merde ?>);">                  
            <h1><?= $Donnees_Recuperation_News->titre_message; ?></h1>
        </div>
        <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_<?= $Variable_De_Merde ?>"> 

            <hr style="margin-bottom: 4px;"/>
            <?php if ($Donnees_Recuperation_News->lien_illustration != "") { ?>
                <div class="Texte_News" style="min-height: 100px;">
                    <img class="Image_News" style="float: left;" height="100" src="<?= $Donnees_Recuperation_News->lien_illustration; ?>" />
                    <div style="position: relative; padding-right: 4px; left:4px;"><?= $Donnees_Recuperation_News->contenue_message; ?></div>
                </div>
            <?php } else { ?>
                <?= $Donnees_Recuperation_News->contenue_message; ?>
            <?php } ?>

            <hr style="margin-top: 7px;"/>
            <img src="images/icones/calendrier.png" height="14" style="position: relative; top:3px;"/>&nbsp;<?= Formatage_Date_News($Donnees_Recuperation_News->date); ?>
            <span class="Auteur_News"><img style="position: relative; top:3px;" src="images/icones/utilisateur.png" height="14" />&nbsp;<?= $Donnees_Recherche_Auteur->pseudo_messagerie; ?></span>
        </div>
    <?php } ?>
</div>