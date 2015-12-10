<?php

namespace Administration;

require __DIR__ . '../../../../../../core/initialize.php';

class ajaxGererEquipeSiteEditSave extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE_SITE);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idAdministrationUsers = $request->request->get("idAdministrationUsers");
        $idCompte = $request->request->get("idCompte");
        $arrDroitsParam = json_decode($request->request->get("arrDroits"));
        $arrDroitsNew = [];

        if ($idAdministrationUsers > 0) {
            $objAdministrationUsers = \Site\SiteHelper::getAdministrationUsersRepository()->find($idAdministrationUsers);
            $arrDroitsOld = $objAdministrationUsers->getDroits();
        } else {
            $objAdministrationUsers = new \Site\Entity\AdministrationUsers();
            $objAdministrationUsers->setPannelAdmin(0);
            $arrDroitsOld = [];
        }

        $objAdministrationUsers->setIdCompte($idCompte);

        foreach ($arrDroitsParam AS $idDroit => $droitParam) {
            if ($droitParam) {
                $arrDroitsNew[] = $idDroit;
            } else {
                unset($arrDroitsOld[$idDroit]);
            }
        }

        $objAdministrationUsers->setDroits($arrDroitsNew + $arrDroitsOld);
        $em->persist($objAdministrationUsers);
        $em->flush();
    }

}

$objAjax = new ajaxGererEquipeSiteEditSave();
$objAjax->run();
