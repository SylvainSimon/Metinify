<?php

namespace Administration;

require __DIR__ . '../../../../../../core/initialize.php';

class ajaxGererItemShopArticlesDelete extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idArticle = $request->request->get("idArticle");

        if ($idArticle > 0) {

            $objItemshop = \Site\SiteHelper::getItemshopRepository()->find($idArticle);
            
            if ($objItemshop !== null) {
                $em->remove($objItemshop);
                $em->flush();
                $result = array(
                    'result' => true,
                    'reasons' => ""
                );
            } else {
                $result = array(
                    'result' => false,
                    'reasons' => "L'article sélectionné n'éxiste pas."
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
