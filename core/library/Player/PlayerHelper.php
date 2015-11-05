<?php

namespace Player;

use \Shared\DoctrineHelper;

class PlayerHelper {

    /**
     * @return \Player\Repository\PlayerRepository
     */
    public static function getPlayerRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\Player');
    }
    
    /**
     * @return \Player\Repository\GuildRepository
     */
    public static function getGuildRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\Guild');
    }

}
