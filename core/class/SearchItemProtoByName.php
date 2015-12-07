<?php

require '../initialize.php';

class SearchItemProtoByName extends \ScriptHelper {

    public function run() {

        $arrObjItemProto = \Player\PlayerHelper::getItemProtoRepository()->findByNameForAjaxSelect($_GET["term"]);

        $arrResult[] = array(
            'label' => "",
            'ID' => "",
        );

        if (count($arrObjItemProto) > 0) {

            foreach ($arrObjItemProto as $objItemProto) {
                $arrResult[] = array(
                    'label' => $objItemProto['localeName'],
                    'ID' => $objItemProto['vnum'],
                );
            }
        }

        echo json_encode($arrResult);
        exit;
    }

}

$objAjax = new SearchItemProtoByName();
$objAjax->run();
