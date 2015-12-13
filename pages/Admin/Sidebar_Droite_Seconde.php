<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Outils</h3>
    </div>
    <div class="box-body no-padding">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->HaveTheRight(\DroitsHelper::RADAR)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/Radar.php')"><td>Radar</td></tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Gestion</h3>
    </div>
    <div class="box-body no-padding">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->HaveTheRight(\DroitsHelper::GERER_NEWS)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/GererNews.php')"><td> Actualités</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::GERER_MONNAIES)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/GererMonnaies.php');"><td> Monnaies</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::GERER_EQUIPE_JEU)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/modules/GererEquipeJeu/GererEquipeJeu.php')"><td> Équipe du jeu</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::GERER_EQUIPE_SITE)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/modules/GererEquipeSite/GererEquipeSite.php')"><td> Équipe du site</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::GERER_ITEMSHOP)) { ?>
                <tr class="pointer" onclick="Ajax('pages/Admin/modules/GererItemShop/GererItemShop.php')"><td> Item-shop</td></tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php
if ($cacheManager->isExisting("resultcountPlayerOnline")) {
    $resultcountPlayerOnline = $cacheManager->get("resultcountPlayerOnline");
} else {
    $resultcountPlayerOnline = \Player\PlayerHelper::getPlayerRepository()->countPlayerOnline(90);
    $cacheManager->set("resultcountPlayerOnline", $resultcountPlayerOnline, 60);
}
?>

<div class="box box-default flat  hidden-sm hidden-xs">
    <div class="box-header">
        <h3 class="box-title">Serveur</h3>

        <div class="box-tools" style="padding-top: 3px; padding-right: 1px;">
            <span class="iconStatutServer"></span>
        </div>
    </div>

    <div class="box-body">

        <span data-tooltip="Connectés ou téléportés les 15 dernières minutes." id="nombrePlayerConnected"><?php echo $resultcountPlayerOnline ?></span> joueur connectés

        <script type="text/javascript">
            ServeurClassyd();
            setInterval("ServeurClassyd()", "60000");
            setInterval("JoueursConnectes()", "30000");
        </script>

    </div>
</div>