<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Telechargement extends \PageHelper {

    public $arrayTemplate = [];
    public $strTemplate = "Telechargement.html5.twig";

    public function run() {

        $url = 'http://vamosmt2.org:81/Installateur%20VamosMT2%20Client%20officiel%202014-2015.exe';
        $headers = get_headers($url, true);

        if (isset($headers['Content-Length'])) {
            $size = $headers['Content-Length'];
        } else {
            $size = 0;
        }

        $this->arrayTemplate["urlClient"] = $url;
        $this->arrayTemplate["urlClientTorrent"] = "http://vamosmt2.org:81/VamosMT2%20Client%20officiel%202014-2015.exe.torrent";
        $this->arrayTemplate["tailleClient"] = \FonctionsUtiles::Formatage_Taille($size);
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Telechargement();
$class->run();
