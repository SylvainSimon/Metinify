<?php

namespace Common;

use \Shared\DoctrineHelper;

class CommonHelper {

    /**
     * @return \Player\Repository\GmlistRepository
     */
    public static function getGmlistRepository() {
        return DoctrineHelper::getRepository('\Common\Entity\Gmlist');
    }

}
