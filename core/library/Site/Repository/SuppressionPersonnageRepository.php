<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SuppressionPersonnageRepository extends EntityRepository {

    public function findByIdPlayerAndNumeroVerif($idPlayer = 0, $numeroVerif = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("SuppressionPersonnageEntity");
        $qb->from("\Site\Entity\SuppressionPersonnage", "SuppressionPersonnageEntity");
        $qb->where("SuppressionPersonnageEntity.idPersonnage = :idPlayer");
        $qb->andWhere("SuppressionPersonnageEntity.numeroVerif = :numeroVerif");
        $qb->setParameter("idPlayer", $idPlayer);
        $qb->setParameter("numeroVerif", $numeroVerif);

        try {
            $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function deleteByPlayerId($idPlayer = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->delete("\Site\Entity\SuppressionPersonnage", "SuppressionPersonnageEntity");
        $qb->where("SuppressionPersonnageEntity.idPersonnage = :idPlayer");
        $qb->setParameter("idPlayer", $idPlayer);

        try {
            $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
