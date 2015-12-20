<?php

namespace Ajax;

require __DIR__ . '../../../core/initialize.php';

class ajaxStatutServeur extends \ScriptHelper {

    public function run() {

        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("resultTestServer")) {
            $resultTest = $cacheManager->get("resultTestServer");
        } else {
            $resultTest = \ServerHelper::testServer();
            $cacheManager->set("resultTestServer", $resultTest, 60);
        }

        if (!$resultTest) {
            echo '<i class="text-red material-icons md-icon-public md-22" data-tooltip="Hors-Ligne" data-tooltip-position="left"></i>';
        } else {
            echo '<i class="text-green material-icons md-icon-public md-22" data-tooltip="En ligne" data-tooltip-position="left"></i>';
        }
    }

}

$class = new ajaxStatutServeur();
$class->run();
