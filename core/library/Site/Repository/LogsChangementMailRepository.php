<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsChangementMailRepository extends EntityRepository {

    public function statChangementMails($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsChangementMailEntity)");
        $qb->from("\Site\Entity\LogsChangementMail", "LogsChangementMailEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsChangementMailEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsChangementMailEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementMailEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsChangementMailEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsChangementMailEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementMailEntity.date) = MONTH(:now)");
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
