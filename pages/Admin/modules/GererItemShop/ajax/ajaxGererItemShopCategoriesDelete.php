<?php

namespace Administration;

require __DIR__ . '../../../../../../core/initialize.php';

class ajaxGererItemShopArticlesDelete extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP_CATEGORIE);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idCategorie = $request->request->get("idCategorie");

        if ($idCategorie > 0) {

            $objItemshopCategories = \Site\SiteHelper::getItemshopCategoriesRepository()->findByCat($idCategorie);
            
            if ($objItemshopCategories !== null) {
                $em->remove($objItemshopCategories);
                $em->flush();
                $result = array(
                    'result' => true,
                    'reasons' => ""
                );
            } else {
                $result = array(
                    'result' => false,
                    'reasons' => "La catégorie sélectionné n'éxiste pas."
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

$class = new ajaxGererItemShopArticlesDelete();
$class->run();
