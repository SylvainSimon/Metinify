<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxSaleCancel extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idMarchePersonnage = $request->request->get("idMarchePersonnage");
        
        $objMarchePersonnage = \Site\SiteHelper::getMarchePersonnagesRepository()->findByIdAndIdProprietaire($idMarchePersonnage, $this->objAccount->getId());

        if ($objMarchePersonnage !== null) {

            $ID_Personnage = $objMarchePersonnage->getIdPersonnage();
            $Emplacement_Personnage = $objMarchePersonnage->getPid();

            $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->findByEmplacementAndAccountId($Emplacement_Personnage, $this->objAccount->getId());

            if ($objPlayerIndex !== null) {

                $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($ID_Personnage);

                if ($objPlayer !== null) {

                    $func = "setPid" . $Emplacement_Personnage;
                    $objPlayerIndex->$func($ID_Personnage);

                    $em->persist($objPlayerIndex);

                    $objPlayer->setIdAccount($this->objAccount->getId());
                    $em->persist($objPlayer);

                    $em->remove($objMarchePersonnage);
                    
                    $em->flush();

                    \Site\SiteHelper::getMarcheArticlesRepository()->deleteByIdentifiantArticle($idMarchePersonnage);

                    $Tableau_Retour_Json = array(
                        'result' => true,
                        'reasons' => ""
                    );
                } else {
                    $Tableau_Retour_Json = array(
                        'result' => false,
                        'reasons' => "Le personnage est déja lié a un compte."
                    );
                }
            } else {
                $Tableau_Retour_Json = array(
                    'result' => false,
                    'reasons' => "L'emplacement original est occupé par un vrai personnage."
                );
            }
        } else {
            $Tableau_Retour_Json = array(
                'result' => false,
                'reasons' => "Ce personnage ne vous appartient pas."
            );
        }
        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxSaleCancel();
$class->run();
