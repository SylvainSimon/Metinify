<?php

       $objAccount = Account\AccountHelper::getAccountRepository()->find(1);
        $arrObjPlayers = Player\PlayerHelper::getPlayerRepository()->findPlayers($objAccount->getId());

        \Debug::log($objAccount->getLogin());

        foreach ($arrObjPlayers as $objPlayer) {
            \Debug::log($objPlayer->getName());
        }