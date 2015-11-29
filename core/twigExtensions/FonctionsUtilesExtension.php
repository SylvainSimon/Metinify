<?php

class FonctionsUtilesExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'findIconEmpire' => new \Twig_SimpleFunction('findIconEmpire', array($this, 'findIconEmpire')),
            'findIconJob' => new \Twig_SimpleFunction('findIconJob', array($this, 'findIconJob')),
        );
    }

    public function getName() {
        return 'fonctions_utiles_extension';
    }

    public function findIconEmpire($idEmpire = 0) {
        return \FonctionsUtiles::findIconEmpire($idEmpire);
    }

    public function findIconJob($idJob = 0) {
        return \FonctionsUtiles::findIconJob($idJob);
    }

}
