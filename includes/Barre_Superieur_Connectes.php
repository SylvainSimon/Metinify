<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php @include_once '../configPDO.php'; ?>
<?php
if (!empty($_SESSION['ID'])) {

    $Verification_Donnees = "SELECT cash, mileage 
                             FROM account.account
                             WHERE id = :id
                             LIMIT 1";
    $Parametres_Verification_Donnees = $Connexion->prepare($Verification_Donnees);
    $Parametres_Verification_Donnees->execute(array(
        ":id" => $_SESSION['ID']));
    $Parametres_Verification_Donnees->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Verification_Donnees = $Parametres_Verification_Donnees->fetch();
    
    $_SESSION["VamoNaies"] = $Donnees_Verification_Donnees->cash;
    $_SESSION["TanaNaies"] = $Donnees_Verification_Donnees->mileage;
}
?>

<div id="Zone_Identité">
    <span>Bienvenue <span onclick="Ajax('pages/Logs_Connexion.php')" title="Voir l'historique de vos connexions" class="Bold Pointer"><?php echo $_SESSION['Utilisateur'] ?></span> (<?php echo $_SERVER["REMOTE_ADDR"]; ?>)</span>

</div>

<div class="Separateur_Vertical Separateur_Vertical_1"></div>

<div id="Zone_Centrale">

    <img class="Piece_Recto Ombre" src="images/rectopiece.png" title="VamoNaies"/>
    <div class="Position_VamoNaies Ombre_Interieur" id="Nombre_De_Vamonaies"><?php echo $_SESSION['VamoNaies']; ?></div>


    <img class="Piece_Verso Ombre" src="images/versopiece.png" title="TanaNaies"/>
    <div class="Position_TanaNaies Ombre_Interieur" id="Nombre_De_Tananaies"><?php echo $_SESSION['TanaNaies']; ?></div>

</div>
<div class="Separateur_Vertical Separateur_Vertical_3"></div>
<div class="Separateur_Vertical Separateur_Vertical_2"></div>

<?php include 'Messagerie/Messagerie_Notifications.php'; ?>

<div class="Zone_Deconnexion Pointer" title="Se déconnecter" onclick="Ajax_Connexion('includes/Barre_Deconnexion.php')"></div>