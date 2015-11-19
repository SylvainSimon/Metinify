<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class VotesLogsRepository extends EntityRepository {

    public function countVotePrecedent($idCompte = 0, $idSite = 0) {

        $nowInterval = \Carbon\Carbon::now()->subHour(2);
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(VotesLogsEntity)");
        $qb->from("\Site\Entity\VotesLogs", "VotesLogsEntity");
        $qb->where("VotesLogsEntity.date > :nowInterval");
        $qb->andWhere("VotesLogsEntity.idCompte = :idCompte");
        $qb->andWhere("VotesLogsEntity.idSiteVote = :idSiteVote");
        $qb->setParameter("nowInterval", $nowInterval);
        $qb->setParameter("idCompte", $idCompte);
        $qb->setParameter("idSiteVote", $idSite);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return [];
        }
    }

    public function statVotes($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(VotesLogsEntity)");
        $qb->from("\Site\Entity\VotesLogs", "VotesLogsEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("VotesLogsEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(VotesLogsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(VotesLogsEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(VotesLogsEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(VotesLogsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(VotesLogsEntity.date) = MONTH(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 4:
                break;
        }

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
