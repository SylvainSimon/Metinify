<?php
if ($cacheManager->isExisting("arrObjGuildsTop")) {
    $arrObjGuilds = $cacheManager->get("arrObjGuildsTop");
} else {
    $arrObjGuilds = Player\PlayerHelper::getGuildRepository()->findTop(6);
    $cacheManager->set("arrObjGuildsTop", $arrObjPlayers, 21600);
}
$templateTop = $this->objTwig->loadTemplate("ClassementGuildesTop.html5.twig");
$view = $templateTop->render(["arrObjGuilds" => $arrObjGuilds]);
echo $view;


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

        <span data-tooltip="Connectés ou téléportés les 15 dernières minutes." id="nombrePlayerConnected"><?php echo $resultcountPlayerOnline ?> joueur connectés</span>

        <script type="text/javascript">
            ServeurClassyd();
            setInterval("ServeurClassyd()", "60000");
            setInterval("JoueursConnectes()", "30000");
        </script>

    </div>
</div>
<?php
include 'pages/Votes/includes/Vote.php';
