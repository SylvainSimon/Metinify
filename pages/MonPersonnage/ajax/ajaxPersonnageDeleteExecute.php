<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPersonnageDeleteExecute extends \ScriptHelper {

    public $isProtected = true;
    public $objPlayer;

    public function __construct() {
        parent::__construct();
        global $request;
        $this->objPlayer = parent::VerifMonJoueur(\Encryption::decrypt($request->request->get("idPlayer")));
    }
    
    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idPlayer = $this->objPlayer->getId();
        $codeVerif = $request->request->get("numeroVerif");
        
        $objSuppressionPersonnage = \Site\SiteHelper::getSuppressionPersonnageRepository()->findByIdPlayerAndNumeroVerif($this->objPlayer->getId(), $codeVerif);

        if ($objSuppressionPersonnage !== null) {

            if (\Player\PlayerHelper::haveGuild($idPlayer) == false) {

                $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($this->objAccount->getId());

                if ($objPlayerIndex->getPid1() == $idPlayer) {
                    $func = "setPid1";
                } else if ($objPlayerIndex->getPid2() == $idPlayer) {
                    $func = "setPid2";
                } else if ($objPlayerIndex->getPid3() == $idPlayer) {
                    $func = "setPid3";
                } else if ($objPlayerIndex->getPid4() == $idPlayer) {
                    $func = "setPid4";
                }

                $objPlayerIndex->$func(0);

                $em->persist($objPlayerIndex);

                \Player\PlayerHelper::getMarriageRepository()->deleteByIdPlayer($idPlayer);
                \Player\PlayerHelper::getItemRepository()->deleteByOwnerId($idPlayer, ["EQUIPMENT", "INVENTORY"]);

                $objPlayerDelete = new \Player\Entity\PlayerDeleted();
                $oldReflection = new \ReflectionObject($this->objPlayer);
                $newReflection = new \ReflectionObject($objPlayerDelete);

                foreach ($oldReflection->getProperties() as $property) {
                    if ($newReflection->hasProperty($property->getName())) {
                        $newProperty = $newReflection->getProperty($property->getName());
                        $newProperty->setAccessible(true);
                        $newProperty->setValue($objPlayerDelete, $property->getValue($this->objPlayer));
                    }
                }

                $em->persist($objPlayerDelete);

                \Player\PlayerHelper::getMessengerListRepository()->deleteByNamePlayer($this->objPlayer->getName());

                $em->remove($this->objPlayer);
                $em->remove($objSuppressionPersonnage);

                $em->flush();

                $Tableau_Retour_Json = array(
                    'result' => true
                );
            } else {

                $em->remove($objSuppressionPersonnage);
                $em->flush();

                $Tableau_Retour_Json = array(
                    'result' => false,
                    'reasons' => "Le joueur est membre ou chef d'une guilde."
                );
            }
        } else {

            $Tableau_Retour_Json = array(
                'result' => false,
                'reasons' => "Le code de vérification n'est pas le bon."
            );
        }

        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxPersonnageDeleteExecute();
$class->run();
