<?php

namespace Pages\Classements\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementGuildesSearch extends \PageHelper {

    public $strTemplate = "ClassementGuildesSearch.html5.twig";
    
    public function run() {

        global $request;
        
        $index = 0;
        $guildName = $request->request->get("recherche");

        $arrObjGuildsSearch = \Player\PlayerHelper::getGuildRepository()->findClassement(0, 0, true);

        foreach ($arrObjGuildsSearch AS $objGuildsSearch) {
            $index++;
            if ($objGuildsSearch["name"] == $guildName) {
                break;
            }
        }

        if (count($arrObjGuildsSearch) != $index) {

            $intervalStartSearch = ($index - 5);
            if($intervalStartSearch < 0 ){
                $intervalStartSearch = 0;
            }

            $arrObjGuilds = \Player\PlayerHelper::getGuildRepository()->findClassement($intervalStartSearch, 10);

            $this->arrayTemplate["finded"] = true;
            $this->arrayTemplate["arrObjGuilds"] = $arrObjGuilds;
            $this->arrayTemplate["search"] = $guildName;
            $this->arrayTemplate["place"] = $intervalStartSearch + 1;
            
        } else {
            $this->arrayTemplate["finded"] = false;
        }

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ClassementGuildesSearch();
$class->run();
