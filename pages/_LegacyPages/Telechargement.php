<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Telechargement extends \PageHelper {

    public $arrayTemplate = [];
    public $strTemplate = "Telechargement.html5.twig";

    public function run() {

        global $config;

        $urlClient = $config->linkClient;
        $urlClientTorrent = $config->linkClientTorrent;

        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("sizeOfClient")) {
            $size = $cacheManager->get("sizeOfClient");
        } else {
            $size = \FonctionsUtiles::sizeOfFileExt($urlClient);
            $cacheManager->set("sizeOfClient", $size, 21600);
        }

        $this->arrayTemplate["urlClient"] = $urlClient;
        $this->arrayTemplate["urlClientTorrent"] = $urlClientTorrent;
        $this->arrayTemplate["tailleClient"] = \FonctionsUtiles::Formatage_Taille($size);

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Telechargement();
$class->run();
