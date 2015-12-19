<?php

namespace Pages\Votes\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxVerification extends \PageHelper {

    public function run() {

        global $request;
        global $session;
        $em = \Shared\DoctrineHelper::getEntityManager();
        $idSite = $request->request->get("id_site");

        $countVotePrecedent = \Site\SiteHelper::getVotesLogsRepository()->countVotePrecedent($this->objAccount->getId(), $idSite);

        if ($countVotePrecedent != 0) {
            echo "1";
        } else {

            $this->objAccount->setCash($this->objAccount->getCash() + 20);
            $session->set("Cash", $this->objAccount->getCash());
            $em->persist($this->objAccount);
            
            $objVotesLogs = new \Site\Entity\VotesLogs();
            $objVotesLogs->setIdCompte($this->objAccount->getId());
            $objVotesLogs->setIp($this->ipAdresse);
            $objVotesLogs->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objVotesLogs->setIdSiteVote($idSite);
            $em->persist($objVotesLogs);
            
            $em->flush();
        }
    }

}

$class = new ajaxVerification();
$class->run();
