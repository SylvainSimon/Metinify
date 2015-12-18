<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsChangementCodeEntrepotRepository extends EntityRepository {

    public function statChangementCodeEntrepot($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsChangementCodeEntrepotEntity)");
        $qb->from("\Site\Entity\LogsChangementCodeEntrepot", "LogsChangementCodeEntrepotEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsChangementCodeEntrepotEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsChangementCodeEntrepotEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementCodeEntrepotEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsChangementCodeEntrepotEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsChangementCodeEntrepotEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementCodeEntrepotEntity.date) = MONTH(:now)");
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