<?php

namespace Administration;

require __DIR__ . '../../../../../../core/initialize.php';

class ajaxGererItemShopCategoriesEditSave extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP_CATEGORIE);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $categorieCat = $request->request->get("categorieCat");
        $categorieNom = $request->request->get("categorieNom");
        $categorieDescription = $request->request->get("categorieDescription");

        if ($categorieCat > 0) {
            $objItemshopCategories = \Site\SiteHelper::getItemshopCategoriesRepository()->find($categorieCat);
        } else {
            $objItemshopCategories = new \Site\Entity\ItemshopCategories();
        }

        $objItemshopCategories->setNom($categorieNom);
        $objItemshopCategories->setDescription($categorieDescription);

        $em->persist($objItemshopCategories);
        $em->flush();

        $result = array(
            'result' => true,
            'reasons' => ""
        );

        echo json_encode($result);
    }

}

$class = new ajaxGererItemShopCategoriesEditSave();
$class->run();
