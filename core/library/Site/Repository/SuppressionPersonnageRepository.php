<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SuppressionPersonnageRepository extends EntityRepository {

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
