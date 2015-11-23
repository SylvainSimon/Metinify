<?php

require '../initialize.php';

class SearchPlayerByName extends \ScriptHelper {

    public function run() {

        $arrObjPlayer = \Player\PlayerHelper::getPlayerRepository()->findByNameForAjaxSelect($_GET["term"]);

        $arrResult[] = array(
            'label' => "",
            'ID' => "",
        );

        if (count($arrObjPlayer) > 0) {

            foreach ($arrObjPlayer as $objPlayer) {
                $arrResult[] = array(
                    'label' => $objPlayer['name'],
                    'ID' => $objPlayer['id'],
                );
            }
        }

        echo json_encode($arrResult);
        exit;
    }

}

$objAjax = new SearchPlayerByName();
$objAjax->run();
