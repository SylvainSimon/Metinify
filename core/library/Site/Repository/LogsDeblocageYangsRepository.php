<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsDeblocageYangsRepository extends EntityRepository {

    public function statDeblocageYangs($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsDeblocageYangsEntity)");
        $qb->from("\Site\Entity\LogsDeblocageYangs", "LogsDeblocageYangsEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsDeblocageYangsEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsDeblocageYangsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsDeblocageYangsEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsDeblocageYangsEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsDeblocageYangsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsDeblocageYangsEntity.date) = MONTH(:now)");
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