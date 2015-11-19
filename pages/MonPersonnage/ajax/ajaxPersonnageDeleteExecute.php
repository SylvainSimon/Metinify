<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPersonnageDeleteExecute extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idAccount = $request->request->get("id_compte");
        $idPlayer = $request->request->get("id_personnage");
        $codeVerif = $request->request->get("numero_verif");

        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPlayer);
        $objSuppressionPersonnage = \Site\SiteHelper::getSuppressionPersonnageRepository()->findByIdPlayerAndNumeroVerif($idPlayer, $codeVerif);

        if ($objSuppressionPersonnage !== null) {

            if (\Player\PlayerHelper::haveGuild($idPlayer) !== false) {

                $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($idAccount);

                $func = "";
                if ($objPlayerIndex->getPid1() == $idPlayer) {
                    $func = "setPid1";
                } else if ($objPlayerIndex->getPid2() == $idPlayer) {
                    $func = "setPid2";
                } else if ($objPlayerIndex->getPid3() == $idPlayer) {
                    $func = "setPid3";
                } else if ($objPlayerIndex->getPid4() == $idPlayer) {
                    $func = "setPid4";
                }

                if ($func !== "") {
                    $objPlayerIndex->$func($idPlayer);
                }

                $em->persist($objPlayerIndex);

                \Player\PlayerHelper::getMarriageRepository()->deleteByIdPlayer($idPlayer);
                \Player\PlayerHelper::getItemRepository()->deleteByOwnerId($idPlayer, ["EQUIPMENT", "INVENTORY"]);

                $objPlayerDelete = new \Player\Entity\PlayerDeleted();
                $oldReflection = new \ReflectionObject($objPlayer);
                $newReflection = new \ReflectionObject($objPlayerDelete);

                foreach ($oldReflection->getProperties() as $property) {
                    if ($newReflection->hasProperty($property->getName())) {
                        $newProperty = $newReflection->getProperty($property->getName());
                        $newProperty->setAccessible(true);
                        $newProperty->setValue($objPlayerDelete, $property->getValue($objPlayer));
                    }
                }

                $em->persist($objPlayerDelete);

                \Player\PlayerHelper::getMessengerListRepository()->deleteByNamePlayer($objPlayer->getName());

                $em->remove($objPlayer);
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
