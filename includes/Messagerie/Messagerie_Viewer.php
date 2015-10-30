<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php include '../../pages/Tableaux_Arrays.php'; ?>
<?php include '../../pages/Fonctions_Utiles.php'; ?>
<?php
if (empty($_SESSION['ID'])) {

    echo "Vous n'êtes pas connecté";
    exit();
}
?>

<?php
/* ------------------------ Informations de Base ---------------------------- */
$Informations_De_Base = "SELECT * FROM $BDD_Site.support_ticket_archives
                                  WHERE id = ?
                                  LIMIT 1";
$Parametres_Informations_De_Base = $Connexion->prepare($Informations_De_Base);
$Parametres_Informations_De_Base->execute(array(
    $_POST["id"]));
$Parametres_Informations_De_Base->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Informations_De_Base = $Parametres_Informations_De_Base->rowCount();
/* -------------------------------------------------------------------------- */
?>
<?php if ($Nombre_De_Resultat_Informations_De_Base != 0) { ?>

    <?php $Donnees_Informations_De_Base = $Parametres_Informations_De_Base->fetch(); ?>
    <?php
    /* ------------------------ Recuperation pseudo chat  --------------------------- */
    $Pseudo_Messagerie = "SELECT pseudo_messagerie 
                          FROM $BDD_Account.account
                          WHERE id = ?
                          LIMIT 1";
    $Parametres_Pseudo_Messagerie = $Connexion->prepare($Pseudo_Messagerie);
    $Parametres_Pseudo_Messagerie->execute(array(
        $Donnees_Informations_De_Base->id_emmeteur));
    $Parametres_Pseudo_Messagerie->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch();
    /* ------------------------------------------------------------------------------ */

    /* ----------------------------- Recuperation Fil  ------------------------------ */
    $Recuperation_Fil = "SELECT * 
                              FROM $BDD_Site.support_ticket_archives
                              WHERE numero_discussion = ?
                              ORDER BY date ASC";
    /* ----------------------------- Recuperation Fil ------------------------------- */
    $Parametres_Recuperation_Fil = $Connexion->prepare($Recuperation_Fil);
    $Parametres_Recuperation_Fil->execute(array(
        $Donnees_Informations_De_Base->numero_discussion));
    $Parametres_Recuperation_Fil->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Recuperation_Fil = $Parametres_Recuperation_Fil->rowCount();
    /* ------------------------------------------------------------------------------ */
    /* ----------------------------- Recuperation premier message ------------------- */
    $Parametres_Recuperation_Premier_Message = $Connexion->prepare($Recuperation_Fil);
    $Parametres_Recuperation_Premier_Message->execute(array(
        $Donnees_Informations_De_Base->numero_discussion));
    $Parametres_Recuperation_Premier_Message->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Recuperation_Premier_Message = $Parametres_Recuperation_Premier_Message->fetch();
    /* ------------------------------------------------------------------------------ */

    /* ----------------------------- Recuperation Fil Inverse ------------------------------ */
    $Recuperation_Fil_Inverse = "SELECT * 
                              FROM $BDD_Site.support_ticket_archives
                              WHERE numero_discussion = ?
                              ORDER BY date DESC";
    /* ----------------------------- Recuperation Fil Inverse ------------------------------- */
    /* ----------------------------- Recuperation dernier message ------------------- */
    $Parametres_Recuperation_Dernier_Message = $Connexion->prepare($Recuperation_Fil_Inverse);
    $Parametres_Recuperation_Dernier_Message->execute(array(
        $Donnees_Informations_De_Base->numero_discussion));
    $Parametres_Recuperation_Dernier_Message->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Recuperation_Dernier_Message = $Parametres_Recuperation_Dernier_Message->fetch();
    /* ------------------------------------------------------------------------------ */
    ?>

    <div id="Cadre_Fil_Informations">
        <table id="Table_Fil_Information">
            <tr>
                <td width="140">Premier Message : </td>
                <td><?php echo Formatage_Date($Donnees_Recuperation_Premier_Message->date); ?></td>
            </tr>
            <tr>
                <td width="140">Dernier Message :</td> 
                <td><?php echo Formatage_Date($Donnees_Recuperation_Dernier_Message->date); ?></td>
            </tr>
        </table>

        <table id="Table_Fil_Information2">
            <tr>
                <td width="140">Nombre de message :</td> 
                <td id="Nombre_De_Message"><?php echo $Nombre_De_Resultat_Recuperation_Fil; ?></td>
            </tr>
            <tr>
                <td width="140">Objet : </td>
                <td><?php echo $Donnees_Recuperation_Premier_Message->objet_message; ?></td>
            </tr>
        </table>

    </div>

    <div id="Cadre_Fil_Discussion_Viewer">

        <?php while ($Donnees_Recuperation_Fil = $Parametres_Recuperation_Fil->fetch()) { ?>

            <?php if ($Donnees_Recuperation_Fil->id_emmeteur == $_SESSION["ID"]) { ?>

                <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" class="Message_Droite">
                    <span><?php echo $_SESSION["Pseudo_Messagerie"] ?></span> : <?php echo nl2br(htmlentities($Donnees_Recuperation_Fil->contenue_message)); ?>
                    <br/>
                    <hr/>
                    <div class="Date_Du_Message"><?php echo Formatage_Date($Donnees_Recuperation_Fil->date); ?></div>
                    <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                        <div class="Etat_de_Visionnage"><?php echo Formatage_Date_Vue($Donnees_Recuperation_Fil->date_vue); ?></div>
                    <?php } else { ?>
                        <div class="Etat_de_Visionnage">Non-Lu</div>
                    <?php } ?>
                </div>

            <?php } else { ?>

                <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                    <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" class="Message_Gauche Vue">
                    <?php } else { ?>
                        <div id="Message_<?php echo $Donnees_Recuperation_Fil->id; ?>" class="Message_Gauche NonVue">
                        <?php } ?>

                        <span><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></span> : <?php echo nl2br(htmlentities($Donnees_Recuperation_Fil->contenue_message)); ?>
                        <br/>
                        <hr/>
                        <div class="Date_Du_Message"><?php echo Formatage_Date($Donnees_Recuperation_Fil->date); ?></div>
                        <?php if ($Donnees_Recuperation_Fil->etat == "Lu") { ?>
                            <div class="Etat_de_Visionnage"><?php echo Formatage_Date_Vue($Donnees_Recuperation_Fil->date_vue); ?></div>
                        <?php } else { ?>
                            <div class="Etat_de_Visionnage">Non-Lu</div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <a style="display: none;" id="Lien_Cache" href="#Message_<?php echo $_POST["id"]; ?>" title="Vers élément contact">lien vers l'élément contact</a>
        </div>
    </div>

    <script type="text/javascript">
        function Defilement(lien){
                                                                                                                                                                                                                                                                                                    
            id = $(lien).attr("href");
            offset = $(id).offset().top 
            $('#Cadre_Fil_Discussion_Viewer').animate({scrollTop: offset-166}, 'slow');  
        }    
        setTimeout(function(){Defilement("#Lien_Cache")},500);
    </script>

<?php } else { ?>
    Le message n'existe plus.
<?php } ?>