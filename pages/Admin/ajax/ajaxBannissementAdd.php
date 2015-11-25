<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class ajaxBannissementAdd extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::BANNISSEMENT);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idAccount = $request->request->get("accountId");
        $banRaison = $request->request->get("banRaison");
        $banDuree = $request->request->get("banDuree");
        $banCommentaire = $request->request->get("banCommentaire");

        $objAccount = \Account\AccountHelper::getAccountRepository()->find($idAccount);
        $libelleRaison = \BanRaisonHelper::getLibelle($banRaison);

        $estDefinitif = false;
        if ($banDuree == 0) {
            $estDefinitif = true;
        }

        $objAccount->setStatus(\StatusHelper::BANNI);
        $em->persist($objAccount);

        $dateDebutBanissement = \Carbon\Carbon::now();
        $dateFinBanissement = \Carbon\Carbon::now()->addDay($banDuree);
        
        $objBanissementActifs = new \Site\Entity\BannissementsActifs();
        $objBanissementActifs->setIdCompte($objAccount->getId());
        $objBanissementActifs->setRaisonBannissement($banRaison);
        $objBanissementActifs->setCommentaireBannissement($banCommentaire);
        $objBanissementActifs->setIdCompteGm($this->objAccount->getId());
        $objBanissementActifs->setIpGm($this->ipAdresse);
        $objBanissementActifs->setDuree($banDuree);
        $objBanissementActifs->setDateDebutBannissement($dateDebutBanissement);
        $objBanissementActifs->setDateFinBannissement($dateFinBanissement);
        $objBanissementActifs->setDefinitif($estDefinitif);
        $em->persist($objBanissementActifs);

        $em->flush();
        
        $template = $this->objTwig->loadTemplate("BanissementCompte.html5.twig");
        $resultTemplate = $template->render([
            "compte" => $objAccount->getLogin(),
            "definitif" => $estDefinitif,
            "raison" => $libelleRaison
        ]);
        $subject = 'VamosMt2 - Bannissement de ' . $objAccount->getLogin() . '';
        \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $resultTemplate);

        $result = array(
            'result' => true,
            'reasons' => ""
        );

        echo json_encode($result);
    }

}

$class = new ajaxBannissementAdd();
$class->run();
