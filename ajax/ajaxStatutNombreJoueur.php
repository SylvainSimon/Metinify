<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class ajaxStatutNombreJoueur extends \ScriptHelper {

    public function run() {

        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("resultcountPlayerOnline")) {
            $resultcountPlayerOnline = $cacheManager->get("resultcountPlayerOnline");
        } else {
            $resultcountPlayerOnline = \Player\PlayerHelper::getPlayerRepository()->countPlayerOnline(90);
            $cacheManager->set("resultcountPlayerOnline", $resultcountPlayerOnline, 60);
        }

        echo $resultcountPlayerOnline;
    }

}

$class = new ajaxStatutNombreJoueur();
$class->run();
