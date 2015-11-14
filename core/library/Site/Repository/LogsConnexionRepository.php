<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsConnexionRepository extends EntityRepository {

    public function getDQLInterval(\Doctrine\ORM\QueryBuilder $dql, $interval) {

        switch ($interval) {
            case 1:
                $dql->andWhere("LogsConnexionEntity.date >= :now");
                $dql->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $dql->andWhere("YEAR(LogsConnexionEntity.date) = YEAR(:now)");
                $dql->andWhere("MONTH(LogsConnexionEntity.date) = MONTH(:now)");
                $dql->andWhere("WEEK(LogsConnexionEntity.date) = WEEK(:now)");
                $dql->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $dql->andWhere("YEAR(LogsConnexionEntity.date) = YEAR(:now)");
                $dql->andWhere("MONTH(LogsConnexionEntity.date) = MONTH(:now)");
                $dql->setParameter("now", $this->getDateNow());
                break;
            case 4:
                break;
        }

        return $dql;
    }

    public function statConnexions($interval = 0, $result = "", $estUnique = false) {

        $qb = $this->_em->createQueryBuilder();

        if ($estUnique) {
            $qb->select("COUNT(DISTINCT(LogsConnexionEntity.ip))");
        } else {
            $qb->select("COUNT(LogsConnexionEntity)");
        }
        
        $qb->from("\Site\Entity\LogsConnexion", "LogsConnexionEntity");
        $qb->where("1 = 1");

        $qb = $this->getDQLInterval($qb, $interval);

        if ($result !== "") {
            $qb->andWhere("LogsConnexionEntity.resultat = :result");
            $qb->setParameter("result", $result);
        }
        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
