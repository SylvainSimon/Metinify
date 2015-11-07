<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Serveur</h3>
    </div>
    <div class="box-body no-padding hidden-sm hidden-xs">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->arrAdminRights["rechercheJoueurs"]) { ?>
                <tr onclick="Ajax('administration/Recherche_Joueurs.php')"><td>Recherche de joueurs sgm</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheJoueursAdmin"]) { ?>
                <tr onclick="Ajax('administration/Recherche_Joueurs_Admin.php')"><td>Recherche de joueurs admin</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheComptes"]) { ?>
                <tr onclick="Ajax('administration/Recherche_Comptes.php')"><td>Recherche de comptes</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheEmails"]) { ?>
                <tr onclick="Ajax('administration/Recherche_Emails.php')"><td>Recherche d'emails</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheIps"]) { ?>
                <tr onclick="Ajax('administration/Recherche_IP.php')"><td>Recherche par ip</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["historiqueCommandes"]) { ?>
                <tr onclick="Ajax('administration/Commandes.php')"><td>Historiques des commandes</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["historiqueMp"]) { ?>
                <tr onclick="Ajax('administration/Messages_Prives.php')"><td>Historiques des messages privés</td></tr>
            <?php } ?>
        </table>
    </div>
</div>