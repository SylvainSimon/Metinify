<?php

namespace Pages\Classements;

require __DIR__ . '../../../core/initialize.php';

class ClassementGuildes extends \PageHelper {

    public $strTemplate = "ClassementGuildes.html5.twig";

    public function run() {

        $numPage = 0;
        $i = $numPage + 1;
        
        $arrObjGuilds = \Player\PlayerHelper::getGuildRepository()->findClassement(0, 10);
        $totalObjGuilds = \Player\PlayerHelper::getGuildRepository()->countGuildClassement();

        $totalPage = (($totalObjGuilds / 10) - 1);
        
        $this->arrayTemplate["arrObjGuilds"] = $arrObjGuilds;
        $this->arrayTemplate["totalObjGuilds"] = $totalObjGuilds;
        $this->arrayTemplate["totalPage"] = $totalPage;
        $this->arrayTemplate["numPage"] = $numPage;
        $this->arrayTemplate["place"] = $i;
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ClassementGuildes();
$class->run();
