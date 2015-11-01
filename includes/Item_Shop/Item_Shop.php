<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>

<?php $Sauvegarder_ID = $_SESSION['ID']; ?>
<?php $Sauvegarder_Login = $_SESSION['Utilisateur']; ?>

<?php
if (empty($_SESSION['ID'])) {

    echo "Vous n'êtes pas connecté";
    exit();
}
?>

<link rel="stylesheet" href="../../css/Item_Shop.css">

<div class="box box-default flat">

    <div class="box-header">
        <h3 class="box-title">Magasin d'items</h3>

        <div class="box-tools">
            <button onclick="Ajax('./includes/Item_Shop/Item_Shop_Rechargement_Accueil.php?idcompte=<?php echo $Sauvegarder_ID; ?>&nomCompte=<?php echo $Sauvegarder_Login; ?>');" class="btn btn-primary btn-flat">
                Recharger mon compte
            </button>
        </div>
    </div>

    <div class="box-body no-padding">

        <div class="row">
            
            <div class="col-lg-3" style="padding-left: 25px; padding-top: 10px;">
                <div id="ItemShop_Partie_Menu">
                    <?php include_once 'Item_Shop_Categories.php'; ?>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div id="Item_Shop_Contenue">
                    <?php include 'Partie_ItemShop.php'; ?>
                </div>
            </div>

        </div>
    </div>
</div>