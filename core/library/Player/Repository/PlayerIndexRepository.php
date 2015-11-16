<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class PlayerIndexRepository extends EntityRepository {

    public function findByEmplacementAndAccountId($emplacement = "", $idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("PlayerIndexEntity");
        $qb->from("\Player\Entity\PlayerIndex", "PlayerIndexEntity");
        $qb->where("PlayerIndexEntity.id = :idAccount");
        $qb->andWhere("PlayerIndexEntity.pid" . $emplacement . " = 9999999");
        $qb->setParameter("idAccount", $idAccount);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
