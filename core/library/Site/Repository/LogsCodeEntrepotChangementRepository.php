<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsCodeEntrepotChangementRepository extends EntityRepository {

    public function stat($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsConnexionEntity)");
        $qb->from("\Site\Entity\LogsConnexion", "LogsConnexionEntity");
        $qb->where("1 = 1");

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}