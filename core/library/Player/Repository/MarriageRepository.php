<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class MarriageRepository extends EntityRepository {

    public function findMariageByIdPlayer($idPlayer = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "IFELSE(PlayerEntity1.id = :idPlayer, PlayerEntity2.name, PlayerEntity1.name) AS name,"
                . "IFELSE(PlayerEntity1.id = :idPlayer, PlayerEntity2.job, PlayerEntity1.job) AS job"
                . "");
        $qb->from("\Player\Entity\Marriage", "MarriageEntity");
        $qb->innerJoin("\Player\Entity\Player", "PlayerEntity1", "WITH", "PlayerEntity1.id = MarriageEntity.pid1");
        $qb->innerJoin("\Player\Entity\Player", "PlayerEntity2", "WITH", "PlayerEntity2.id = MarriageEntity.pid2");
        $qb->where("(MarriageEntity.pid1 != :idPlayer AND MarriageEntity.pid2 = :idPlayer) OR (MarriageEntity.pid1 = :idPlayer AND MarriageEntity.pid2 != :idPlayer)");
        $qb->setParameter("idPlayer", $idPlayer);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function deleteByIdPlayer($idPlayer = 0) {

        $qb = $this->_em->createQueryBuilder();
        $qb->delete("\Player\Entity\Marriage", "MarriageEntity");
        $qb->where("MarriageEntity.pid1 = :idPlayer OR MarriageEntity.pid2 = :idPlayer");
        $qb->setParameter("idPlayer", $idPlayer);

        try {
            return $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
