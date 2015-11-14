<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsCreationJoueursRepository extends EntityRepository {

    public function getDQLInterval(\Doctrine\ORM\QueryBuilder $dql, $interval) {

        switch ($interval) {
            case 1:
                $dql->andWhere("LogsCreationJoueursEntity.date >= :now");
                $dql->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $dql->andWhere("YEAR(LogsCreationJoueursEntity.date) = YEAR(:now)");
                $dql->andWhere("MONTH(LogsCreationJoueursEntity.date) = MONTH(:now)");
                $dql->andWhere("WEEK(LogsCreationJoueursEntity.date) = WEEK(:now)");
                $dql->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $dql->andWhere("YEAR(LogsCreationJoueursEntity.date) = YEAR(:now)");
                $dql->andWhere("MONTH(LogsCreationJoueursEntity.date) = MONTH(:now)");
                $dql->setParameter("now", $this->getDateNow());
                break;
            case 4:
                break;
        }

        return $dql;
    }

    public function statPlayerCreate($interval = 0, $job = "", $empire = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsCreationJoueursEntity)");
        $qb->from("\Site\Entity\LogsCreationJoueurs", "LogsCreationJoueursEntity");
        $qb->where("1 = 1");

        $qb = $this->getDQLInterval($qb, $interval);

        if ($job !== "") {
            $qb->innerJoin("\Player\Entity\Player", "PlayerEntity", "WITH", "PlayerEntity.id = LogsCreationJoueursEntity.idPerso");
            $qb->andWhere("PlayerEntity.job IN(:job)");
            $qb->setParameter("job", $job);
        }

        if ($empire !== "") {
            $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.pid1 = LogsCreationJoueursEntity.idPerso OR PlayerIndexEntity.pid2 = LogsCreationJoueursEntity.idPerso OR PlayerIndexEntity.pid3 = LogsCreationJoueursEntity.idPerso OR PlayerIndexEntity.pid4 = LogsCreationJoueursEntity.idPerso");
            $qb->andWhere("PlayerIndexEntity.empire IN(:empire)");
            $qb->setParameter("empire", $empire);
        }

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
