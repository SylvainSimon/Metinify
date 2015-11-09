<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class SafeboxRepository extends EntityRepository {

    public function findByIdCompte($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("SafeboxEntity");
        $qb->from("\Player\Entity\Safebox", "SafeboxEntity");
        $qb->where("SafeboxEntity.accountId = :idAccount");
        $qb->setParameter("idAccount", $idAccount);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
}
