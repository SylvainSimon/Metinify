<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGererNewsEditSave extends \PageHelper {

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
        $newTitre = $request->request->get("newTitre");
        $newMessage = $request->request->get("newsMessage");

        if ($newId > 0) {
            $objAdminNews = \Site\SiteHelper::getAdminNewsRepository()->find($newId);
        } else {
            $objAdminNews = new \Site\Entity\AdminNews();
            $objAdminNews->setAuteur($this->objAccount->getId());
            $objAdminNews->setDate(new \DateTime(date("Y-m-d H:i:s")));
        }

        $objAdminNews->setTitreMessage($newTitre);
        $objAdminNews->setContenueMessage($newMessage);

        $em->persist($objAdminNews);
        $em->flush();

        $result = array(
            'result' => true,
            'reasons' => ""
        );
        
        echo json_encode($result);
    }

}

$class = new ajaxGererNewsEditSave();
$class->run();