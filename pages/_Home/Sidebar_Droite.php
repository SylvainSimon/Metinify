<?php
$cacheManager = \CacheHelper::getCacheManager();
if ($cacheManager->isExisting("arrObjGuildsTop")) {
    $arrObjGuilds = $cacheManager->get("arrObjGuildsTop");
} else {
    $arrObjGuilds = Player\PlayerHelper::getGuildRepository()->findTop(6);
    $cacheManager->set("arrObjGuildsTop", $arrObjPlayers, 21600);
}
$templateTop = $this->objTwig->loadTemplate("ClassementGuildesTop.html5.twig");
$view = $templateTop->render(["arrObjGuilds" => $arrObjGuilds]);
echo $view;

include 'pages/_Home/includes/StatutServer.php';
include 'pages/Votes/includes/Vote.php';
