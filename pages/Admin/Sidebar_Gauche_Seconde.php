<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Serveur</h3>
    </div>
    <div class="box-body no-padding hidden-sm hidden-xs">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->arrAdminRights["rechercheJoueurs"]) { ?>
                <tr onclick="Ajax('pages/Admin/Recherche_Joueurs.php')"><td>Recherche de joueurs [SGM]</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheJoueursAdmin"]) { ?>
                <tr onclick="Ajax('pages/Admin/Recherche_Joueurs_Admin.php')"><td>Recherche de joueurs [Admin]</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheComptes"]) { ?>
                <tr onclick="Ajax('pages/Admin/Recherche_Comptes.php')"><td>Recherche de comptes</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheEmails"]) { ?>
                <tr onclick="Ajax('pages/Admin/Recherche_Emails.php')"><td>Recherche d'emails</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["rechercheIps"]) { ?>
                <tr onclick="Ajax('pages/Admin/Recherche_IP.php')"><td>Recherche par ip</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["historiqueCommandes"]) { ?>
                <tr onclick="Ajax('pages/Admin/Commandes.php')"><td>Historiques des commandes</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["historiqueMp"]) { ?>
                <tr onclick="Ajax('pages/Admin/Messages_Prives.php')"><td>Historiques des messages privés</td></tr>
            <?php } ?>
        </table>
    </div>
</div>