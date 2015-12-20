<?php

namespace Pages\Inscription\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxVerifLoginAvailable extends \ScriptHelper {

    public function run() {

        global $request;
        $login = $request->query->get("pseudo");

        $countAccount = \Account\AccountHelper::getAccountRepository()->findAccountByLogin($login);
        if ($countAccount !== null) {
            echo "1";
        } else {
            echo "2";
        }
    }

}

$class = new ajaxVerifLoginAvailable();
$class->run();
