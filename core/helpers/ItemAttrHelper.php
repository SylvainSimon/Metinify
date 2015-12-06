<?php

class ItemAttrHelper {
    
    const MAX_PV = 1;
    const MAX_PM = 2;
    const VITALITE = 3;
    const INTELLIGENCE = 4;
    const FORCE = 5;
    const DEXTERITE = 6;
    const VITESSE_ATTAQUE = 7;
    const VITESSE_DEPLACEMENT = 8;
    const VITESSE_SORT = 9;
    const REGENERATION_PV = 10;
    const REGENERATION_PM = 11;
    const CHANCE_EMPOISONNEMENT = 12;
    const CHANCE_ETOURDISSEMENT = 13;
    const CHANCE_RALENTISSEMENT = 14;
    const CHANCE_COUP_CRITIQUE = 15;
    const CHANCE_COUP_PERCANT = 16;
    const BONUS_CONTRE_DEMI_HOMME = 17;
    const BONUS_CONTRE_ANIMAUX = 18;
    const BONUS_CONTRE_ORC = 19;
    const BONUS_CONTRE_ESOTERIQUE = 20;
    const BONUS_CONTRE_MORT_VIVANT = 21;
    const BONUS_CONTRE_DEMON = 22;
    const DEGAT_ABSORBE_PV = 23;
    const DEGAT_ABSORBE_PM = 24;
    const CHANCE_PRENDRE_PM = 25;
    const CHANCE_RECUP_PM = 26;
    const CHANCE_BLOQUE_ATTAQUE_PHYSIQUE = 27;
    const CHANCE_EVITE_FLECHE = 28;
    const DEFENSE_EPEE = 29;
    const DEFENSE_EPEE_2_MAINS = 30;
    const DEFENSE_DAGUE = 31;
    const DEFENSE_GONG = 32;
    const RESISTANCE_SPECIALISTE = 33;
    const RESISTANCE_FLECHE = 34;
    const RESISTANCE_FEU = 35;
    const RESISTANCE_LUMIERE = 36;
    const RESISTANCE_MAGIE = 37;
    const RESISTANCE_VENT = 38;
    const CHANCE_DETOURNE_ATTAQUE_PHYSIQUE = 39;
    const CHANCE_DETOURNE_MALEDICTION = 40;
    const RESISTANCE_POISON = 41;
    const CHANCE_RESTAURER_PM = 42;
    const CHANCE_BONUS_XP = 43;
    const CHANCE_DOUBLE_YANG = 44;
    const CHANCE_DOUBLE_OBJET = 45;
    const ANTI_ETOURDISSEMENT = 48;
    const ANTI_RALENTISSEMENT = 49;
    const VALEUR_ATTAQUE = 53;
    const VALEUR_DEFENSE = 54;
    const BONUS_CONTRE_GUERRIER = 59;
    const BONUS_CONTRE_NINJA = 60;
    const BONUS_CONTRE_SURA = 61;
    const BONUS_CONTRE_SHAMAN = 62;
    const BONUS_CONTRE_MONSTRE = 63;
    const DEGAT_COMPETENCE = 71;
    const DEGAT_MOYEN = 72;
    const CHANCE_BLOQUE_ATTAQUE_GUERRIER = 78;
    const CHANCE_BLOQUE_ATTAQUE_NINJA = 79;
    const CHANCE_BLOQUE_ATTAQUE_SURA = 80;
    const CHANCE_BLOQUE_ATTAQUE_SHAMAN = 81;
    
    public static function getAll($sort = true) {
        
        global $translator;

        $arrAttr = array(
            self::MAX_PV => $translator->trans('itemAttr.maxPv', array(), 'itemAttr'),
            self::MAX_PM => $translator->trans('itemAttr.maxPm', array(), 'itemAttr'),
            self::VITALITE => $translator->trans('itemAttr.vitalite', array(), 'itemAttr'),
            self::INTELLIGENCE => $translator->trans('itemAttr.intelligence', array(), 'itemAttr'),
            self::FORCE => $translator->trans('itemAttr.force', array(), 'itemAttr'),
            self::DEXTERITE => $translator->trans('itemAttr.dexterite', array(), 'itemAttr'),
            self::VITESSE_ATTAQUE => $translator->trans('itemAttr.vitAttaque', array(), 'itemAttr'),
            self::VITESSE_DEPLACEMENT => $translator->trans('itemAttr.vitDeplacement', array(), 'itemAttr'),
            self::VITESSE_SORT => $translator->trans('itemAttr.vitSort', array(), 'itemAttr'),
            self::REGENERATION_PV => $translator->trans('itemAttr.regenPV', array(), 'itemAttr'),
            self::REGENERATION_PM => $translator->trans('itemAttr.regenPM', array(), 'itemAttr'),
            self::CHANCE_EMPOISONNEMENT => $translator->trans('itemAttr.chanceEmpoisonnement', array(), 'itemAttr'),
            self::CHANCE_ETOURDISSEMENT => $translator->trans('itemAttr.chanceEtourdissement', array(), 'itemAttr'),
            self::CHANCE_RALENTISSEMENT => $translator->trans('itemAttr.chanceRalentissement', array(), 'itemAttr'),
            self::CHANCE_COUP_CRITIQUE => $translator->trans('itemAttr.chanceCoupCritique', array(), 'itemAttr'),
            self::CHANCE_COUP_PERCANT => $translator->trans('itemAttr.chanceCoupPercant', array(), 'itemAttr'),
            self::BONUS_CONTRE_DEMI_HOMME => $translator->trans('itemAttr.bonusContreDemiHomme', array(), 'itemAttr'),
            self::BONUS_CONTRE_ANIMAUX => $translator->trans('itemAttr.bonusContreAnimaux', array(), 'itemAttr'),
            self::BONUS_CONTRE_ORC => $translator->trans('itemAttr.bonusContreOrc', array(), 'itemAttr'),
            self::BONUS_CONTRE_ESOTERIQUE => $translator->trans('itemAttr.bonusContreEsoterique', array(), 'itemAttr'),
            self::BONUS_CONTRE_MORT_VIVANT => $translator->trans('itemAttr.bonusContreMortVivant', array(), 'itemAttr'),
            self::BONUS_CONTRE_DEMON => $translator->trans('itemAttr.bonusContreDemon', array(), 'itemAttr'),
            self::DEGAT_ABSORBE_PV => $translator->trans('itemAttr.degatAbsorbePv', array(), 'itemAttr'),
            self::DEGAT_ABSORBE_PM => $translator->trans('itemAttr.degatAbsorbePm', array(), 'itemAttr'),
            self::CHANCE_PRENDRE_PM => $translator->trans('itemAttr.chancePrendrePm', array(), 'itemAttr'),
            self::CHANCE_RECUP_PM => $translator->trans('itemAttr.chanceRecupPm', array(), 'itemAttr'),
            self::CHANCE_BLOQUE_ATTAQUE_PHYSIQUE => $translator->trans('itemAttr.chanceBloqueAttaquePhysique', array(), 'itemAttr'),
            self::CHANCE_EVITE_FLECHE => $translator->trans('itemAttr.chanceEviteFleche', array(), 'itemAttr'),
            self::DEFENSE_EPEE => $translator->trans('itemAttr.defenseEpee', array(), 'itemAttr'),
            self::DEFENSE_EPEE_2_MAINS => $translator->trans('itemAttr.defenseEpee2Mains', array(), 'itemAttr'),
            self::DEFENSE_DAGUE => $translator->trans('itemAttr.defenseDague', array(), 'itemAttr'),
            self::DEFENSE_GONG => $translator->trans('itemAttr.defenseGong', array(), 'itemAttr'),
            self::RESISTANCE_SPECIALISTE => $translator->trans('itemAttr.resistanceSpecialiste', array(), 'itemAttr'),
            self::RESISTANCE_FLECHE => $translator->trans('itemAttr.resistanceFleche', array(), 'itemAttr'),
            self::RESISTANCE_FEU => $translator->trans('itemAttr.resistanceFeu', array(), 'itemAttr'),
            self::RESISTANCE_LUMIERE => $translator->trans('itemAttr.resistanceLumiere', array(), 'itemAttr'),
            self::RESISTANCE_MAGIE => $translator->trans('itemAttr.resistanceMagie', array(), 'itemAttr'),
            self::RESISTANCE_VENT => $translator->trans('itemAttr.resistanceVent', array(), 'itemAttr'),
            self::CHANCE_DETOURNE_ATTAQUE_PHYSIQUE => $translator->trans('itemAttr.chanceDetournerAttaquePhysique', array(), 'itemAttr'),
            self::CHANCE_DETOURNE_MALEDICTION => $translator->trans('itemAttr.chanceDetournerMalediction', array(), 'itemAttr'),
            self::RESISTANCE_POISON => $translator->trans('itemAttr.resistancePoison', array(), 'itemAttr'),
            self::CHANCE_RESTAURER_PM => $translator->trans('itemAttr.chanceRestaurerPm', array(), 'itemAttr'),
            self::CHANCE_BONUS_XP => $translator->trans('itemAttr.chanceBonusXp', array(), 'itemAttr'),
            self::CHANCE_DOUBLE_YANG => $translator->trans('itemAttr.chanceDoubleYang', array(), 'itemAttr'),
            self::CHANCE_DOUBLE_OBJET => $translator->trans('itemAttr.chanceDoubleObjet', array(), 'itemAttr'),
            self::ANTI_ETOURDISSEMENT => $translator->trans('itemAttr.antiEtourdissement', array(), 'itemAttr'),
            self::ANTI_RALENTISSEMENT => $translator->trans('itemAttr.antiRalentissement', array(), 'itemAttr'),
            self::VALEUR_ATTAQUE => $translator->trans('itemAttr.valeurAttaque', array(), 'itemAttr'),
            self::VALEUR_DEFENSE => $translator->trans('itemAttr.valeurDefense', array(), 'itemAttr'),
            self::BONUS_CONTRE_GUERRIER => $translator->trans('itemAttr.bonusContreGuerrier', array(), 'itemAttr'),
            self::BONUS_CONTRE_NINJA => $translator->trans('itemAttr.bonusContreNinja', array(), 'itemAttr'),
            self::BONUS_CONTRE_SURA => $translator->trans('itemAttr.bonusContreSura', array(), 'itemAttr'),
            self::BONUS_CONTRE_SHAMAN => $translator->trans('itemAttr.bonusContreShaman', array(), 'itemAttr'),
            self::BONUS_CONTRE_MONSTRE => $translator->trans('itemAttr.bonusContreMonstre', array(), 'itemAttr'),
            self::DEGAT_COMPETENCE => $translator->trans('itemAttr.degatCompetence', array(), 'itemAttr'),
            self::DEGAT_MOYEN => $translator->trans('itemAttr.degatMoyen', array(), 'itemAttr'),
            self::CHANCE_BLOQUE_ATTAQUE_GUERRIER => $translator->trans('itemAttr.chanceBloquerAttaqueGuerrier', array(), 'itemAttr'),
            self::CHANCE_BLOQUE_ATTAQUE_NINJA => $translator->trans('itemAttr.chanceBloquerAttaqueNinja', array(), 'itemAttr'),
            self::CHANCE_BLOQUE_ATTAQUE_SURA => $translator->trans('itemAttr.chanceBloquerAttaqueSura', array(), 'itemAttr'),
            self::CHANCE_BLOQUE_ATTAQUE_SHAMAN => $translator->trans('itemAttr.chanceBloquerAttaqueShaman', array(), 'itemAttr'),
        );

        if ($sort) {
            asort($arrAttr);
        }

        return $arrAttr;
    }

    public static function getLibelle($idAttr = 0) {
        
        $arrAttr = self::getAll();

        if (array_key_exists($idAttr, $arrAttr)) {
            return $arrAttr[$idAttr];
        } else {
            return "inconnu";
        }
    }

    public static function getForDatatableSelect() {

        $arrResult = [];
        $arrAttr = self::getAll();

        foreach ($arrAttr AS $idAttr => $attr) {
            $arrResult[] = "{value:'" . $idAttr . "', label:'" . $attr . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}
