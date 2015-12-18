<?php

namespace Administration;

require __DIR__ . '../../../../../../core/initialize.php';

class ajaxGererItemShopArticlesEditSave extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $articleId = $request->request->get("articleId");
        $articleTitre = $request->request->get("articleTitre");
        $articlePrix = $request->request->get("articlePrix");
        $articleCategorie = $request->request->get("articleCategorie");
        $articleNombre = $request->request->get("articleNombre");
        $articleType = $request->request->get("articleType");
        $articleVnum = $request->request->get("articleVnum");
        $articleTypeBonus = $request->request->get("articleTypeBonus");
        $articleDescriptionCourte = $request->request->get("articleDescriptionCourte");
        $articleDescriptionComplete = $request->request->get("articleDescriptionComplete");
        $articleEstActif = $request->request->get("articleEstActif");

        if ($articleId > 0) {
            $objItemShop = \Site\SiteHelper::getItemshopRepository()->find($articleId);
        } else {
            $objItemShop = new \Site\Entity\Itemshop();
        }

        if ($articleEstActif !== null && $articleEstActif == "true") {
            $objItemShop->setEstActif(1);
        } else {
            $objItemShop->setEstActif(0);
        }
        
        $objItemShop->setCat($articleCategorie);
        $objItemShop->setFullDescription($articleDescriptionComplete);

        if ($articleType == 2) {
            $objItemShop->setIdItem($articleTypeBonus);
        } else {
            $objItemShop->setIdItem($articleVnum);
        }

        $objItemShop->setInfoItem($articleDescriptionCourte);
        $objItemShop->setNameItem($articleTitre);
        $objItemShop->setNbItem($articleNombre);
        $objItemShop->setPrix($articlePrix);
        $objItemShop->setType($articleType);

        $em->persist($objItemShop);
        $em->flush();

        $result = array(
            'result' => true,
            'reasons' => ""
        );

        echo json_encode($result);
    }

}

$class = new ajaxGererItemShopArticlesEditSave();
$class->run();
