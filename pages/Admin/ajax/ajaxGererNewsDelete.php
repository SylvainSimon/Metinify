<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGererNewsDelete extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_NEWS);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $newId = $request->request->get("newId");

        if ($newId > 0) {
            $objActualites = \Site\SiteHelper::getActualitesRepository()->find($newId);

            if ($objActualites !== null) {
                $em->remove($objActualites);
                $em->flush();

                $result = array(
                    'result' => true,
                    'reasons' => ""
                );
            } else {
                $result = array(
                    'result' => false,
                    'reasons' => "L'actualité sélectionné n'éxiste pas."
                );
            }
        } else {
            $result = array(
                'result' => false,
                'reasons' => "Problème de transmission d'identifiant."
            );
        }
        echo json_encode($result);
    }

}

$class = new ajaxGererNewsDelete();
$class->run();
