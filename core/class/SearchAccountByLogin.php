<?php

require '../initialize.php';

class SearchAccountByLogin extends \ScriptHelper {

    public function run() {

        $arrObjAccount = \Account\AccountHelper::getAccountRepository()->finByLoginForAjaxSelect($_GET["term"]);

        $arrResult[] = array(
            'label' => "",
            'ID' => "",
        );

        if (count($arrObjAccount) > 0) {

            foreach ($arrObjAccount as $objAccount) {
                $arrResult[] = array(
                    'label' => $objAccount['login'],
                    'ID' => $objAccount['id'],
                );
            }
        }

        echo json_encode($arrResult);
        exit;
    }

}

$objAjax = new SearchAccountByLogin();
$objAjax->run();
