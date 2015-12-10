<?php

class DroitsHelper {

    const SUPPORT_TICKET = 1;
    const RECHERCHE_JOUEUR = 2;
    const RECHERCHE_COMPTE = 4;
    const RECHERCHE_GUILDE = 5;
    const RECHERCHE_EMAIL = 6;
    const RECHERCHE_IP = 7;
    
    const RECHERCHE_PECHEUR = 8;
    const RECHERCHE_MARIAGE = 9;
    const RECHERCHE_ITEM = 10;
    
    const RECHERCHE_BANNISSEMENT = 11;
    
    const RECHERCHE_RENOMMAGE = 12;
    const RECHERCHE_COMMANDE = 13;
    const RECHERCHE_MP = 14;
    
    const BANNISSEMENT = 15;
    const BANNISSEMENT_IP = 16;
    const DEBANNISSEMENT = 17;
    const BANNISSEMENT_EMAIL = 18;
    
    const VIEW_PLAYER = 19;
    const VIEW_ACCOUNT = 20;
    
    const GERER_MONNAIES = 21;
    const GERER_NEWS = 22;
    const GERER_EQUIPE_JEU = 23;
    const GERER_EQUIPE_SITE = 30;

    const RADAR = 25;
    const RECHERCHE_GUILDE_GUERRE = 26;
    
    const GERER_ITEMSHOP = 27;
    const GERER_ITEMSHOP_CATEGORIE = 28;
    const GERER_ITEMSHOP_LOGS_ACHATS = 29;

    public static function getAll($sort = true) {

        $arr = array(
            self::SUPPORT_TICKET => "Réponse aux tickets",
            self::RECHERCHE_JOUEUR => "Rechercher un joueur",
            self::RECHERCHE_COMPTE => "Rechercher un compte",
            self::RECHERCHE_GUILDE => "Rechercher une guilde",
            self::RECHERCHE_EMAIL => "Rechercher par e-mail",
            self::RECHERCHE_IP => "Rechercher par IP",
            self::RECHERCHE_PECHEUR => "",
            self::RECHERCHE_MARIAGE => "",
            self::RECHERCHE_ITEM => "",
            self::RECHERCHE_BANNISSEMENT => "Rechercher des bannis",
            self::RECHERCHE_RENOMMAGE => "",
            self::RECHERCHE_COMMANDE => "",
            self::RECHERCHE_MP => "",
            self::BANNISSEMENT => "Bannir les comptes",
            self::BANNISSEMENT_IP => "Bannir par IP",
            self::DEBANNISSEMENT => "Lever un bannissement",
            self::BANNISSEMENT_EMAIL => "Bannir par e-mail",
            self::VIEW_PLAYER => "",
            self::VIEW_ACCOUNT => "",
            self::GERER_MONNAIES => "Gérer les monnaies",
            self::GERER_NEWS => "Gérer les actualités",
            self::GERER_EQUIPE_JEU => "Gestion l'équipe du jeu",
            self::RADAR => "Radar des cartes",
            self::RECHERCHE_GUILDE_GUERRE => "Historique des guerres de guilde",
            self::GERER_ITEMSHOP => "Gérer les articles",
            self::GERER_ITEMSHOP_CATEGORIE => "Gérer les catégories",
            self::GERER_ITEMSHOP_LOGS_ACHATS => "Historique des achats",
            self::GERER_EQUIPE_SITE => "Gérer l'équipe du site",
        );

        if ($sort) {
            asort($arr);
        }

        return $arr;
    }

    public static function getLibelle($id = 0) {

        $arr = self::getAll();

        if (array_key_exists($id, $arr)) {
            return $arr[$id];
        } else {
            return "Droit inconnu";
        }
    }

    public static function getForDatatableSelect($sort = true) {

        $arrResult = [];
        $arr = self::getAll($sort);

        foreach ($arr AS $id => $libelle) {
            $arrResult[] = "{value:'" . $id . "', label:'" . $libelle . "'}";
        }

        return implode(", ", $arrResult);
    }

}
