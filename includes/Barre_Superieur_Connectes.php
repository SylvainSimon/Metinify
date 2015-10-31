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

<div class="col-md-7 col-sm-7 col-xs-7">

    <div class="row">

        <div class="col-lg-3 col-md-4 col-sm-4">
            Bienvenue <span onclick="Ajax('pages/Logs_Connexion.php')" title="Voir l'historique de vos connexions" class="Bold Pointer"><?php echo $_SESSION['Utilisateur'] ?></span>
        </div>

        <div style="position: relative; left:-4px;"  class="col-lg-5 col-md-6 col-sm-6">
            <img class="inline" src="images/rectopiece.png" height="35" title="VamoNaies"/>
            <div class="inline" id="Nombre_De_Vamonaies"><?php echo $_SESSION['VamoNaies']; ?></div>

            <img class="inline" src="images/versopiece.png" height="35" title="TanaNaies"/>
            <div class="inline" id="Nombre_De_Tananaies"><?php echo $_SESSION['TanaNaies']; ?></div>
        </div>
    </div>
</div>

<div class="col-md-5 col-sm-5 col-xs-5">

    <div class="pull-right">

        <?php include 'Messagerie/Messagerie_Notifications.php'; ?>

        <i style="top: 7px; position: relative; margin-left: 7px;" id="Icone_Sons" class="" onclick="Clique_Bouton_Sons()"></i>
        <script type="text/javascript">

            if (getCookie("cookieAudio") != null) {

                if (getCookie("cookieAudio") == "On") {

                    $("#Icone_Sons").attr("class", "material-icons md-icon-volume-up md-24 text-blue");

                } else if (getCookie("cookieAudio") == "Off") {

                    $("#Icone_Sons").attr("class", "material-icons md-icon-volume-off md-24 text-red");

                }
            } else {

                setCookie("cookieAudio", "On");
                $("#Icone_Sons").attr("class", "material-icons md-icon-volume-up md-24 text-blue");
            }

            setTimeout("Actualisation_Messages()", 20000);

        </script>


        <a title="Se déconnecter" class="pull-right" style="cursor: pointer; margin-left: 7px;" onclick="Ajax_Connexion('includes/Barre_Deconnexion.php')">
            <i style="top: 7px; position: relative;" class="material-icons md-icon-power md-24 text-red"></i>
        </a>
    </div>
</div>