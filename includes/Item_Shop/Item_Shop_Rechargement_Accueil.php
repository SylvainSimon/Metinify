<?php @session_write_close(); ?>
<?php @session_start(); ?>

<link rel="stylesheet" href="../../css/Item_Shop.css">


<div id="Rechargement_Titre_Allopass">
    Recharger par Allopass
</div>

<?php
if (empty($_SESSION["ID"])) {
    if (!empty($_POST['idcompte'])) {

        $Id_Compte = $_POST['idcompte'];
        $Login_Utilisateur = $_POST['nomCompte'];
    } else {

        $Id_Compte = "NON";
        exit();
    }
} else {
    $Id_Compte = $_SESSION["ID"];
    $Login_Utilisateur = $_SESSION["Utilisateur"];
}
?>

<div class="Position_Rechargement_Allopass">

    <div id="Description_Allopass" class="Description_Rechargement_Allopass">
        <div class="Texte_Rechargement">
            Le rechargement par Allopass n'a pas de délais et il est crédité immédiatement quand la paiement est validé par le service.
        </div>
    </div>

    <div id="Position_Bouton_Allopass">

        <a id="Lien_Item_Shop" href="https://payment.allopass.com/buy/buy.apu?ids=227909&idd=898935&forward_target=current&data=<?= $Id_Compte ?>" class="fancybox_ItemShop" data-fancybox-type="iframe">
            <input type="button" class="Bouton_Paypal" value="1 350 Vamonaies"/>
        </a>
    </div>
</div> 

<div id="Rechargement_Titre_Paypal">
    Recharger par Paypal
</div>

<div class="Position_Rechargement_Paypal">

    <div id="Description_Paypal" class="Description_Rechargement_Paypal">
        <div class="Texte_Rechargement">
            Le rechargement par Paypal est plus lent que les autres car il est vérifié manuellement par un administrateur.
            <br/><br/><br/><br/><br/>
            Le rechargement sera crédité dans un délais de 24 heures ou moins.
        </div>
    </div>

    <form id="Bouton_Acheter_5000" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">

        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="RX9W8ULCKZ3HY">

        <input type="hidden" name="on0" value="Choisissez le nombre:">
        <input type="hidden" name="os0" value="5000 VamoNaies">

        <input type="hidden" name="on1" value="Identifiant">
        <input type="hidden" value="<?= $Login_Utilisateur ?>" name="os1" maxlength="200">

        <input type="hidden" name="currency_code" value="EUR">
        <input class="Bouton_Paypal" type="submit" border="0" value="5 000 Vamonaies  (5€)" name="submit" alt="Payer par Paypal">
    </form>
    <form id="Bouton_Acheter_20000" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">

        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="RX9W8ULCKZ3HY">

        <input type="hidden" name="on0" value="Choisissez le nombre:">
        <input type="hidden" name="os0" value="20000 VamoNaies">

        <input type="hidden" name="on1" value="Identifiant">
        <input type="hidden" value="<?= $Login_Utilisateur ?>" name="os1" maxlength="200">

        <input type="hidden" name="currency_code" value="EUR">
        <input class="Bouton_Paypal" type="submit" border="0" value="20 000 Vamonaies (15€)" name="submit" alt="Payer par Paypal">
    </form>
    <form id="Bouton_Acheter_50000" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">

        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="RX9W8ULCKZ3HY">

        <input type="hidden" name="on0" value="Choisissez le nombre:">
        <input type="hidden" name="os0" value="50000 VamoNaies">

        <input type="hidden" name="on1" value="Identifiant">
        <input type="hidden" value="<?= $Login_Utilisateur ?>" name="os1" maxlength="200">

        <input type="hidden" name="currency_code" value="EUR">
        <input class="Bouton_Paypal" type="submit" border="0" value="50 000 Vamonaies (35€)" name="submit" alt="Payer par Paypal">
    </form>
</div>