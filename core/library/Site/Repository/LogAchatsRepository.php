<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogAchatsRepository extends EntityRepository {

    public function findByIdAccount($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();
        
        $qb->select("LogAchatsEntity");
        $qb->from("\Site\Entity\LogAchats", "LogAchatsEntity");
        $qb->where("LogAchatsEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);
        $qb->orderBy("LogAchatsEntity.date", "DESC");

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
