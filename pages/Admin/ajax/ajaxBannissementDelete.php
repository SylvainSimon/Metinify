<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class ajaxBannissementDelete extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::DEBANNISSEMENT);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idAccount = $request->request->get("idAccount");

        if ($idAccount > 0) {

            $objAccount = \Account\AccountHelper::getAccountRepository()->find($idAccount);
            if ($objAccount !== null) {

                $objAccount->setStatus(\StatusHelper::ACTIF);
                $em->persist($objAccount);

                $objBannissementsActif = \Site\SiteHelper::getBannissementsActifsRepository()->findByIdAccount($objAccount->getId());

                if ($objBannissementsActif !== null) {
                    $objHistoriqueBannissement = new \Site\Entity\HistoriqueBanissements();
                    $oldReflection = new \ReflectionObject($objBannissementsActif);
                    $newReflection = new \ReflectionObject($objHistoriqueBannissement);

                    foreach ($oldReflection->getProperties() as $property) {
                        if ($newReflection->hasProperty($property->getName())) {
                            $newProperty = $newReflection->getProperty($property->getName());
                            $newProperty->setAccessible(true);
                            $newProperty->setValue($objHistoriqueBannissement, $property->getValue($objBannissementsActif));
                        }
                    }

                    $objHistoriqueBannissement->setDebannPar($this->objAccount->getId());
                    $em->persist($objHistoriqueBannissement);

                    $em->remove($objBannissementsActif);
                }

                $em->flush();

                $template = $this->objTwig->loadTemplate("Debannissement.html5.twig");
                $result = $template->render([
                    "compte" => $objAccount->getLogin(),
                ]);
                $subject = 'VamosMt2 - Levé du bannissement de ' . $objAccount->getLogin() . '';
                \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);

                $result = array(
                    'result' => true,
                    'reasons' => ""
                );
            } else {
                $result = array(
                    'result' => false,
                    'reasons' => "Le compte sélectionné n'existe pas."
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

$class = new ajaxBannissementDelete();
$class->run();
