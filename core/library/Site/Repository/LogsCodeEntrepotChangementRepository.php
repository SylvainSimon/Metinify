<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsCodeEntrepotChangementRepository extends EntityRepository {

    public function statChangementCodeEntrepot($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsCodeEntrepotChangementEntity)");
        $qb->from("\Site\Entity\LogsCodeEntrepotChangement", "LogsCodeEntrepotChangementEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsCodeEntrepotChangementEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsCodeEntrepotChangementEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsCodeEntrepotChangementEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsCodeEntrepotChangementEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsCodeEntrepotChangementEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsCodeEntrepotChangementEntity.date) = MONTH(:now)");
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