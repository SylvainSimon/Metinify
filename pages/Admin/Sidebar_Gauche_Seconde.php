<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Serveur</h3>
    </div>
    <div class="box-body no-padding">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_JOUEUR)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RecherchePlayer.php')"><td>Recherche de joueurs</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_COMPTE)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RechercheAccount.php')"><td>Recherche de comptes</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_BANNISSEMENT)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RechercheBanned.php')"><td>Liste des bannis</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_COMMANDE)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/Commandes.php')"><td>Historiques des commandes</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_MP)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/Messages_Prives.php')"><td>Historiques des messages privés</td></tr>
            <?php } ?>
        </table>
    </div>
</div>