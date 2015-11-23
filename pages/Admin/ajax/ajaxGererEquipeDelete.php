<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGererEquipeDelete extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $memberId = $request->request->get("memberId");

        if ($memberId > 0) {
            
            $objGmList = \Common\CommonHelper::getGmlistRepository()->find($memberId);
            if ($objGmList !== null) {
                $em->remove($objGmList);
                $em->flush();

                $result = array(
                    'result' => true,
                    'reasons' => ""
                );
            } else {
                $result = array(
                    'result' => false,
                    'reasons' => "Le membre sélectionné n'existe pas."
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

$class = new ajaxGererEquipeDelete();
$class->run();
