
<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Gestion</h3>
    </div>
    <div class="box-body no-padding hidden-sm hidden-xs">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->HaveTheRight(\DroitsHelper::GERER_MONNAIES)) { ?>
                <tr onclick="Ajax('pages/Admin/Gestion_Monnaies.php');"><td> Gestion des monnaies</td></tr>
            <?php } ?>
            <?php if ($this->HaveTheRight(\DroitsHelper::GERER_NEWS)) { ?>
                <tr onclick="Ajax('pages/Admin/Gestion_News.php')"><td> Gestion des news</td></tr>
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