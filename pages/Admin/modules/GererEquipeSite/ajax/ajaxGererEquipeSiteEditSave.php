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

        $idAdmins = $request->request->get("idAdmins");
        $idCompte = $request->request->get("idCompte");
        $arrDroitsParam = json_decode($request->request->get("arrDroits"));
        $arrDroitsNew = [];

        if ($idAdmins > 0) {
            $objAdmins = \Site\SiteHelper::getAdminsRepository()->find($idAdmins);
            $arrDroitsOld = $objAdmins->getDroits();
        } else {
            $objAdmins = new \Site\Entity\Admins();
            $objAdmins->setEstActif(1);
            $arrDroitsOld = [];
        }

        $objAdmins->setIdCompte($idCompte);

        foreach ($arrDroitsParam AS $idDroit => $droitParam) {
            if ($droitParam) {
                $arrDroitsNew[] = $idDroit;
            } else {
                if (($key = array_search($idDroit, $arrDroitsOld)) !== false) {
                    unset($arrDroitsOld[$key]);
                }
            }
        }

        $objAdmins->setDroits($arrDroitsNew + $arrDroitsOld);
        $em->persist($objAdmins);
        $em->flush();
    }

}

$objAjax = new ajaxGererEquipeSiteEditSave();
$objAjax->run();
