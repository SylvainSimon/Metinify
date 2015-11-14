<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsChangementMotDePasseRepository extends EntityRepository {

    public function statChangementMotDePasse($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsChangementMotDePasseEntity)");
        $qb->from("\Site\Entity\LogsChangementMotDePasse", "LogsChangementMotDePasseEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsChangementMotDePasseEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsChangementMotDePasseEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementMotDePasseEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsChangementMotDePasseEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsChangementMotDePasseEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsChangementMotDePasseEntity.date) = MONTH(:now)");
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
