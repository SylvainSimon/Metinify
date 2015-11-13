<?php

require __DIR__ . '/core/initialize.php';

class Activation extends \PageHelper {

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idAccount = \Encryption::decrypt($request->query->get("id"));

        if ($idAccount !== null) {

            $objAccount = Account\AccountHelper::getAccountRepository()->find($idAccount);

            if ($objAccount !== null) {

                if ($objAccount->getStatus() != "BLOCK") {
                    $objAccount->setStatus("OK");
                    $em->persist($objAccount);

                    $em->flush();
                    header("LOCATION: index.php?ok");
                } else {
                    echo "Ahah ! Niqué gros !";
                }
                
            } else {
                echo "Nous n'avons pas trouvé votre compte sur nos serveurs.";
            }
        }
    }
}

$class = new Activation();
$class->run();
