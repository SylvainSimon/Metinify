<?php

namespace Account;

use \Shared\DoctrineHelper;

class AccountHelper {

    /**
     * @return \Account\Repository\AccountRepository
     */
    public static function getAccountRepository() {
        return DoctrineHelper::getRepository('\Account\Entity\Account');
    }

}
