<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsMarcheAchatsRepository extends EntityRepository {

    public function statMarcheAchats($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsMarcheAchatsEntity)");
        $qb->from("\Site\Entity\LogsMarcheAchats", "LogsMarcheAchatsEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsMarcheAchatsEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsMarcheAchatsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsMarcheAchatsEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsMarcheAchatsEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsMarcheAchatsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsMarcheAchatsEntity.date) = MONTH(:now)");
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
