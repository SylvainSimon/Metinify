<?php

namespace Player;

use \Shared\DoctrineHelper;

class PlayerHelper {

    public static function haveGuild($idPlayer = 0) {
        $objGuildMember = self::getGuildMemberRepository()->countByIdPlayer($idPlayer);
        if ($objGuildMember > 0) {
            return true;
        } else {
            return false;
        }
    }

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
     * @return \Player\Repository\PlayerIndexRepository
     */
    public static function getPlayerIndexRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\PlayerIndex');
    }

    /**
     * @return \Player\Repository\GuildRepository
     */
    public static function getGuildRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\Guild');
    }

    /**
     * @return \Player\Repository\GuildMemberRepository
     */
    public static function getGuildMemberRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\GuildMember');
    }

    /**
     * @return \Player\Repository\SafeboxRepository
     */
    public static function getSafeboxRepository() {
        return DoctrineHelper::getRepository('\Player\Entity\Safebox');
    }

}
