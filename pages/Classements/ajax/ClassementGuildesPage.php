<?php

namespace Pages\Classements\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementGuildesPage extends \PageHelper {

    public $strTemplate = "ClassementGuildesPage.html5.twig";
    
    public function run() {
        
        global $request;
        
        $numPage = $request->query->get("page");
        $intervalStart = ($numPage * 10);

        $arrObjGuilds = \Player\PlayerHelper::getGuildRepository()->findClassement($intervalStart, 10);
        $totalObjGuilds = \Player\PlayerHelper::getGuildRepository()->countGuildClassement();

        $totalPage = (($totalObjGuilds / 10) - 1);
        $i = $intervalStart + 1;
        
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

$class = new ClassementGuildesPage();
$class->run();
