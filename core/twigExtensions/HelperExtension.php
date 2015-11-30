<?php

class HelperExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'helpBanRaison' => new \Twig_SimpleFunction('helpBanRaison', array($this, 'helpBanRaison')),
            'helpBanDuree' => new \Twig_SimpleFunction('helpBanDuree', array($this, 'helpBanDuree')),
            'helpDevise' => new \Twig_SimpleFunction('helpDevise', array($this, 'helpDevise')),
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

}
