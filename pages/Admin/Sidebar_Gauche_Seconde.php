<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Recherches</h3>
    </div>
    <div class="box-body no-padding">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_JOUEUR)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RecherchePlayer.php')"><td>Recherche de joueur</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_COMPTE)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RechercheAccount.php')"><td>Recherche de compte</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_GUILDE)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RechercheGuilde.php')"><td>Recherche de guilde</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_BANNISSEMENT)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RechercheBanned.php')"><td>Liste des bannis</td></tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Historiques</h3>
    </div>
    <div class="box-body no-padding">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_GUILDE_GUERRE)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/RechercheGuildeWar.php')"><td>Guerres des guildes</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_COMMANDE)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/Commandes.php')"><td>Commandes</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_MP)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/Messages_Prives.php')"><td>Messages privés</td></tr>
            <?php } ?>
        </table>
    </div>
</div>