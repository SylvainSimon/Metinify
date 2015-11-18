<?php

namespace Player;

use \Shared\DoctrineHelper;

class PlayerHelper {

    public static function isConnected($objPlayer = null, $interval = 0) {

        $dt2 = \Carbon\Carbon::now();
        $difference = $dt2->diffInMinutes(\Carbon\Carbon::instance($objPlayer->getLastPlay()));

        if ($difference > $interval) {
            return false;
        } else {
            return true;
        }
    }

    public static function calculateGrade($alignement = 0) {
        
        $alignement = ($alignement / 10);
        
        if ($alignement >= 0 && $alignement < 1000) {
            $grade = 0;
        } else if ($alignement >= 1000 && $alignement < 4000) {
            $grade = 1;
        } else if ($alignement >= 4000 && $alignement < 8000) {
            $grade = 2;
        } else if ($alignement >= 8000 && $alignement < 12000) {
            $grade = 3;
        } else if ($alignement >= 12000 && $alignement <= 30000) {
            $grade = 4;
        }

        if ($alignement <= -1 && $alignement > -4000) {
            $grade = -1;
        } else if ($alignement <= -4000 && $alignement > -8000) {
            $grade = -2;
        } else if ($alignement <= -8000 && $alignement > -12000) {
            $grade = -3;
        } else if ($alignement <= -12000 && $alignement >= -30000) {
            $grade = -4;
        }
        
        return $grade;
    }

    public static function haveGuild($idPlayer = 0) {
        $arrObjGuildMember = self::getGuildMemberRepository()->findByIdPlayer($idPlayer);
        if (count($arrObjGuildMember) > 0) {
            return $arrObjGuildMember[0];
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
