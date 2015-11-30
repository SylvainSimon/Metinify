<?php

class FonctionsUtilesExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'findIconEmpire' => new \Twig_SimpleFunction('findIconEmpire', array($this, 'findIconEmpire')),
            'findIconJob' => new \Twig_SimpleFunction('findIconJob', array($this, 'findIconJob')),
            'findSkillGroup' => new \Twig_SimpleFunction('findSkillGroup', array($this, 'findSkillGroup')),
            'findIconStatus' => new \Twig_SimpleFunction('findIconStatus', array($this, 'findIconStatus')),
            'findIconOnline' => new \Twig_SimpleFunction('findIconOnline', array($this, 'findIconOnline')),
        );
    }

    public function getName() {
        return 'fonctions_utiles_extension';
    }

    public function findIconEmpire($idEmpire = 0) {
        return \FonctionsUtiles::findIconEmpire($idEmpire);
    }

    public function findIconJob($job = 0) {
        return \FonctionsUtiles::findIconJob($job);
    }

    public function findSkillGroup($job = 0, $skillGroup = 0) {
        return \FonctionsUtiles::findSkillGroup($job, $skillGroup);
    }

    public function findIconStatus($status = "") {
        return \FonctionsUtiles::findIconStatus($status);
    }

    public function findIconOnline($online = false) {
        return \FonctionsUtiles::findIconOnline($online);
    }

}
