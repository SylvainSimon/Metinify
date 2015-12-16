<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsChangementPasswordRepository extends EntityRepository {

    public function statChangementMotDePasse($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsChangementPasswordEntity)");
        $qb->from("\Site\Entity\LogsChangementPassword", "LogsChangementPasswordEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsChangementPasswordEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsChangementPasswordEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementPasswordEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsChangementPasswordEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsChangementPasswordEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementPasswordEntity.date) = MONTH(:now)");
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
