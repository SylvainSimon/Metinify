<?php include '../configPDO.php'; ?>
<?php include '../pages/Tableaux_Arrays.php'; ?>

<?php
/* --------------------------- Chercher Infos Item --------------------------------- */
$Chercher_Infos = "SELECT item.vnum,
                          item.id AS item_id,
                          item.socket0,
                          item.socket1,
                          item.socket2,
                          item.socket3,
                          item.socket4,
                          item.socket5,
                          item_proto.locale_name,
                          item_proto.limitvalue0,
                          item_proto.applytype0,
                          item_proto.applyvalue0,
                          item_proto.applytype1,
                          item_proto.applyvalue1,
                          item_proto.applytype2,
                          item_proto.applyvalue2,
                                                               
                          item.attrtype0,
                          item.attrvalue0,
                          item.attrtype1,
                          item.attrvalue1,
                          item.attrtype2,
                          item.attrvalue2,
                          item.attrtype3,
                          item.attrvalue3,
                          item.attrtype4,
                          item.attrvalue4,
                          item.attrtype5,
                          item.attrvalue5,
                          item.attrtype6,
                          item.attrvalue6
                                                        
                   FROM player.item
                   LEFT JOIN player.item_proto
                   ON item_proto.vnum = item.vnum
                   WHERE item.id = " . $_POST['id'] . "
                   LIMIT 1";

$Parametres_Chercher_Infos = $Connexion->query($Chercher_Infos);
$Parametres_Chercher_Infos->setFetchMode(PDO::FETCH_OBJ);

$Resultat_Chercher_Infos = $Parametres_Chercher_Infos->fetch();

/* ------------------------------------------------------------------------------------ */

$Nom_Item = "<span class='Couleur_Nom_Item'>" . utf8_encode($Resultat_Chercher_Infos->locale_name) . "</span>";
$Level_Minimum = "<span class='Couleur_Level_Item'>Level : " . htmlentities($Resultat_Chercher_Infos->limitvalue0) . "</span>";

$Bonus_De_Base_1 = $Resultat_Chercher_Infos->applytype0;
if ($Resultat_Chercher_Infos->applyvalue0 < 0) {
    $Valeur_Bonus_De_Base_1 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_De_Base_1] . " : " . htmlentities($Resultat_Chercher_Infos->applyvalue0) . "</span>";
} else {
    $Valeur_Bonus_De_Base_1 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_De_Base_1] . " : " . htmlentities($Resultat_Chercher_Infos->applyvalue0) . "</span>";
}

$Bonus_De_Base_2 = $Resultat_Chercher_Infos->applytype1;
if ($Resultat_Chercher_Infos->applyvalue1 < 0) {
    $Valeur_Bonus_De_Base_2 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_De_Base_2] . " : " . htmlentities($Resultat_Chercher_Infos->applyvalue1) . "</span>";
} else {
    $Valeur_Bonus_De_Base_2 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_De_Base_2] . " : " . htmlentities($Resultat_Chercher_Infos->applyvalue1) . "</span>";
}

$Bonus_De_Base_3 = $Resultat_Chercher_Infos->applytype2;
if ($Resultat_Chercher_Infos->applyvalue2 < 0) {
    $Valeur_Bonus_De_Base_3 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_De_Base_3] . " : " . htmlentities($Resultat_Chercher_Infos->applyvalue2) . "</span>";
} else {
    $Valeur_Bonus_De_Base_3 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_De_Base_3] . " : " . htmlentities($Resultat_Chercher_Infos->applyvalue2) . "</span>";
}

$Bonus_Ajouter_1 = $Resultat_Chercher_Infos->attrtype0;
if ($Resultat_Chercher_Infos->attrvalue0 < 0) {
    $Valeur_Bonus_Ajouter_1 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_Ajouter_1] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue0) . "</span>";
} else {
    $Valeur_Bonus_Ajouter_1 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_Ajouter_1] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue0) . "</span>";
}

$Bonus_Ajouter_2 = $Resultat_Chercher_Infos->attrtype1;
if ($Resultat_Chercher_Infos->attrvalue1 < 0) {
    $Valeur_Bonus_Ajouter_2 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_Ajouter_2] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue1) . "</span>";
} else {
    $Valeur_Bonus_Ajouter_2 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_Ajouter_2] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue1) . "</span>";
}

$Bonus_Ajouter_3 = $Resultat_Chercher_Infos->attrtype2;
if ($Resultat_Chercher_Infos->attrvalue2 < 0) {
    $Valeur_Bonus_Ajouter_3 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_Ajouter_3] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue2) . "</span>";
} else {
    $Valeur_Bonus_Ajouter_3 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_Ajouter_3] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue2) . "</span>";
}

$Bonus_Ajouter_4 = $Resultat_Chercher_Infos->attrtype3;
if ($Resultat_Chercher_Infos->attrvalue3 < 0) {
    $Valeur_Bonus_Ajouter_4 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_Ajouter_4] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue3) . "</span>";
} else {
    $Valeur_Bonus_Ajouter_4 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_Ajouter_4] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue3) . "</span>";
}
$Bonus_Ajouter_5 = $Resultat_Chercher_Infos->attrtype4;
if ($Resultat_Chercher_Infos->attrvalue4 < 0) {
    $Valeur_Bonus_Ajouter_5 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_Ajouter_5] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue4) . "</span>";
} else {
    $Valeur_Bonus_Ajouter_5 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_Ajouter_5] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue4) . "</span>";
}
$Bonus_Ajouter_6 = $Resultat_Chercher_Infos->attrtype5;
if ($Resultat_Chercher_Infos->attrvalue5 < 0) {
    $Valeur_Bonus_Ajouter_6 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_Ajouter_6] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue5) . "</span>";
} else {
    $Valeur_Bonus_Ajouter_6 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_Ajouter_6] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue5) . "</span>";
}
$Bonus_Ajouter_7 = $Resultat_Chercher_Infos->attrtype6;
if ($Resultat_Chercher_Infos->attrvalue6 < 0) {
    $Valeur_Bonus_Ajouter_7 = "<span class='Couleur_Malus_Item'>" . $Bonus_Item[$Bonus_Ajouter_7] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue6) . "</span>";
} else {
    $Valeur_Bonus_Ajouter_7 = "<span class='Couleur_Bonus_Item'>" . $Bonus_Item[$Bonus_Ajouter_7] . " : " . htmlentities($Resultat_Chercher_Infos->attrvalue6) . "</span>";
}
?>

<?php echo $Nom_Item ?><br/>
<?php echo $Level_Minimum ?><br/>

<?php if ($Bonus_De_Base_1 != 0 && $Resultat_Chercher_Infos->applyvalue0 != 0) { ?>
    <?php echo $Valeur_Bonus_De_Base_1 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_De_Base_2 != 0 && $Resultat_Chercher_Infos->applyvalue1 != 0) { ?>
    <?php echo $Valeur_Bonus_De_Base_2 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_De_Base_3 != 0 && $Resultat_Chercher_Infos->applyvalue2 != 0) { ?>
    <?php echo $Valeur_Bonus_De_Base_3 . "<br/>"; ?>
<?php } ?>
<br/>
<?php if ($Resultat_Chercher_Infos->socket0 != 0) { ?>
    <?php echo @$Pierre_Item[$Resultat_Chercher_Infos->socket0] . "<br/>"; ?>
<?php } ?>
<?php if ($Resultat_Chercher_Infos->socket1 != 0) { ?>
    <?php echo @$Pierre_Item[$Resultat_Chercher_Infos->socket1] . "<br/>"; ?>
<?php } ?>
<?php if ($Resultat_Chercher_Infos->socket2 != 0) { ?>
    <?php echo @$Pierre_Item[$Resultat_Chercher_Infos->socket2] . "<br/>"; ?>
<?php } ?>
<?php if ($Resultat_Chercher_Infos->socket3 != 0) { ?>
    <?php echo @$Pierre_Item[$Resultat_Chercher_Infos->socket3] . "<br/>"; ?>
<?php } ?>
<?php if ($Resultat_Chercher_Infos->socket4 != 0) { ?>
    <?php echo @$Pierre_Item[$Resultat_Chercher_Infos->socket4] . "<br/>"; ?>
<?php } ?>
<?php if ($Resultat_Chercher_Infos->socket5 != 0) { ?>
    <?php echo @$Pierre_Item[$Resultat_Chercher_Infos->socket5] . "<br/>"; ?>
<?php } ?>
<br/>

<?php if ($Bonus_Ajouter_1 != 0 && $Resultat_Chercher_Infos->attrvalue0 != 0) { ?>
    <?php echo $Valeur_Bonus_Ajouter_1 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_Ajouter_2 != 0 && $Resultat_Chercher_Infos->attrvalue1 != 0) { ?>
    <?php echo $Valeur_Bonus_Ajouter_2 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_Ajouter_3 != 0 && $Resultat_Chercher_Infos->attrvalue2 != 0) { ?>
    <?php echo $Valeur_Bonus_Ajouter_3 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_Ajouter_4 != 0 && $Resultat_Chercher_Infos->attrvalue3 != 0) { ?>
    <?php echo $Valeur_Bonus_Ajouter_4 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_Ajouter_5 != 0 && $Resultat_Chercher_Infos->attrvalue4 != 0) { ?>
    <?php echo $Valeur_Bonus_Ajouter_5 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_Ajouter_6 != 0 && $Resultat_Chercher_Infos->attrvalue5 != 0) { ?>
    <?php echo $Valeur_Bonus_Ajouter_6 . "<br/>"; ?>
<?php } ?>
<?php if ($Bonus_Ajouter_7 != 0 && $Resultat_Chercher_Infos->attrvalue6 != 0) { ?>
    <?php echo $Valeur_Bonus_Ajouter_7 . "<br/>"; ?>
<?php } ?>