<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php @include_once '../configPDO.php'; ?>
<?php @include_once '../pages/Fonctions_Utiles.php'; ?>

<?php
include '../pages/Tableaux_Arrays.php';

$date = Date("d/m/Y H:i:s");
$Date_Actuel_En_Seconde = time();

$Appel_Compte_Id = $_POST['id'];

/* ------------------------------ Vérification connecte ---------------------------------------------- */
$Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 30 MINUTE)
                          LIMIT 1";
$Parametres_Verification_Connecte = $Connexion->prepare($Verification_Connecte);
/* -------------------------------------------------------------------------------------------------- */

/* ------------------------ Recuperation Compte ----------------------------- */
$Appel_Compte = "SELECT account.login,
                        account.id,
                        account.social_id,
                        account.ip_creation,
                        account.email,
                        account.status,
                        account.gold_expire,
                        account.silver_expire,
                        account.safebox_expire,
                        account.autoloot_expire,
                        account.fish_mind_expire,
                        account.marriage_fast_expire,
                        account.money_drop_rate_expire,
                        account.create_time,
                        safebox.size AS Safebox_Size,
                        safebox.password AS Safebox_Password,
                        player_index.empire
                        FROM account.account
                        LEFT JOIN player.player_index
                        ON player_index.id = account.id
                        LEFT JOIN player.safebox
                        ON account.id = safebox.account_id
                        WHERE account.id = ?
                        LIMIT 1";
$Parametres_Appel_Compte = $Connexion->prepare($Appel_Compte);
$Parametres_Appel_Compte->execute(array(
    $Appel_Compte_Id));
$Parametres_Appel_Compte->setFetchMode(PDO::FETCH_OBJ);
/* -------------------------------------------------------------------------- */

$Resultat_Appel_Compte = $Parametres_Appel_Compte->fetch();

/* ------------------------ Recuperation transaction ----------------------------- */
$Nombre_Transaction = "SELECT id
                          FROM site.logs_rechargements
                          WHERE ip = ?
                          AND compte = ''";
$Parametres_Nombre_Transaction = $Connexion->prepare($Nombre_Transaction);
$Parametres_Nombre_Transaction->execute(array(
    $_SERVER['REMOTE_ADDR']));
$Parametres_Nombre_Transaction->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Transaction = $Parametres_Nombre_Transaction->rowCount();

/* -------------------------------------------------------------------------- */
?>

<div id="Onglets">

    <ul>

        <li><a href="#Onglet_InformationGeneral">Informations générales</a></li>
        <li><a href="#Onglet_Entrepot">Entrepôt</a></li>
        <li><a href="#Onglet_Entrepot_IS">Entrepot Item-Shop</a></li>
        <li><a href="#Historiques_Paiements">Historique Paiements</a></li>
        <li><a href="#Historiques_Achats">Historique Achats</a></li>

        <div class="Bouton_Fermer_Fenetre Pointer" title="Fermer cette fenêtre" onclick="window.parent.$.fancybox.close();"></div>

    </ul>

    <?php include 'Appel_Compte/Onglet_Informations_General.php'; ?>
    <?php include 'Appel_Compte/Onglet_Entrepot.php'; ?>
    <?php include 'Appel_Compte/Onglet_Entrepot_IS.php'; ?>
    <?php include 'Appel_Compte/Onglet_Historiques_Paiements.php'; ?>
    <?php include 'Appel_Compte/Onglet_Historiques_Achats.php'; ?>

</div>


<script>
    $(function() {
        $( "#Onglets" ).tabs({
            event: "click"
        });
    });

</script>