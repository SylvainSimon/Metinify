<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsItemshopAchatsRepository extends EntityRepository {

    public function findByIdAccount($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();
        
        $qb->select("LogsItemshopAchatsEntity");
        $qb->from("\Site\Entity\LogsItemshopAchats", "LogsItemshopAchatsEntity");
        $qb->where("LogsItemshopAchatsEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);
        $qb->orderBy("LogsItemshopAchatsEntity.date", "DESC");

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
