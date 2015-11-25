<?php

class HelperExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'helpBanRaison' => new \Twig_SimpleFunction('helpBanRaison', array($this, 'helpBanRaison')),
            'helpBanDuree' => new \Twig_SimpleFunction('helpBanDuree', array($this, 'helpBanDuree')),
        );
    }

    public function getName() {
        return 'help_extension';
    }

    public function helpBanRaison($raison) {
        return BanRaisonHelper::getLibelle($raison);
    }

    public function helpBanDuree($duree) {
        return BanDureeHelper::getLibelle($duree);
    }

}
