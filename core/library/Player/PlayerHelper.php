<?php

namespace Player;

use \Shared\DoctrineHelper;

class PlayerHelper {

    /**
     * @return \Player\Repository\BanwordRepository
     */
    public static function getBanwordRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\Banword');
    }
    
    /**
     * @return \Player\Repository\ItemRepository
     */
    public static function getItemRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\Item');
    }
    
    /**
     * @return \Player\Repository\ItemProtoRepository
     */
    public static function getItemProtoRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\ItemProto');
    }
    
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
    
    /**
     * @return \Player\Repository\SafeboxRepository
     */
    public static function getSafeboxRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\Safebox');
    }

}
