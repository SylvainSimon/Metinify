<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SupportModerateursRepository extends EntityRepository {

    public function countByIdAccount($idAccount = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(SupportModerateursEntity)");
        $qb->from("\Site\Entity\SupportModerateurs", "SupportModerateursEntity");
        $qb->where("SupportModerateursEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

}
