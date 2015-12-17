<?php

class HelperExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'helpBanRaison' => new \Twig_SimpleFunction('helpBanRaison', array($this, 'helpBanRaison')),
            'helpBanDuree' => new \Twig_SimpleFunction('helpBanDuree', array($this, 'helpBanDuree')),
            'helpDevise' => new \Twig_SimpleFunction('helpDevise', array($this, 'helpDevise')),
            'helpLevel' => new \Twig_SimpleFunction('helpLevel', array($this, 'helpLevel')),
            'helpEmpire' => new \Twig_SimpleFunction('helpEmpire', array($this, 'helpEmpire')),
            'helpGrade' => new \Twig_SimpleFunction('helpGrade', array($this, 'helpGrade')),
            'helpItemAttr' => new \Twig_SimpleFunction('helpItemAttr', array($this, 'helpItemAttr')),
            'helpDroit' => new \Twig_SimpleFunction('helpDroit', array($this, 'helpDroit')),
            'helpSupportObjet' => new \Twig_SimpleFunction('helpSupportObjet', array($this, 'helpSupportObjet')),
        );
    }

    public function getName() {
        return 'help_extension';
    }

    public function helpBanRaison($raison = 0) {
        return BanRaisonHelper::getLibelle($raison);
    }

    public function helpBanDuree($duree = 0) {
        return BanDureeHelper::getLibelle($duree);
    }

    public function helpDevise($devise = 0) {
        return DeviseHelper::getLibelle($devise);
    }
    
    public function helpLevel($level = 0) {
        return LevelHelper::getValue($level);
    }
    
    public function helpEmpire($empire = 0) {
        return EmpireHelper::getLibelle($empire);
    }
    
    public function helpGrade($grade = 0) {
        return GradeHelper::getLibelle($grade);
    }
    
    public function helpItemAttr($itemAttr = 0) {
        return ItemAttrHelper::getLibelle($itemAttr);
    }
    
    public function helpDroit($droit = 0) {
        return DroitsHelper::getLibelle($droit);
    }
    
    public function helpSupportObjet($objet = 0) {
        return SupportObjetsHelper::getLibelle($objet);
    }

}
