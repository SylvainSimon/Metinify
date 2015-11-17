<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsRechargementsRepository extends EntityRepository {

    public function findByIdAccount($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "LogsRechargementsEntity.id,"
                . "LogsRechargementsEntity.date,"
                . "LogsRechargementsEntity.ip,"
                . "LogsRechargementsEntity.emailCompte,"
                . "LogsRechargementsEntity.nombreVamonaies"
                . "");
        $qb->from("\Site\Entity\LogsRechargements", "LogsRechargementsEntity");
        $qb->where("LogsRechargementsEntity.idCompte = :idAccount");
        $qb->andWhere("LogsRechargementsEntity.compte != ''");
        $qb->setParameter("idAccount", $idAccount);
        $qb->orderBy("LogsRechargementsEntity.date", "DESC");

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findTotalMonnaieByIdACcount($idAccount = 0) {
        
        $qb = $this->_em->createQueryBuilder();

        $qb->select("SUM(LogsRechargementsEntity.nombreVamonaies)");
        $qb->from("\Site\Entity\LogsRechargements", "LogsRechargementsEntity");
        $qb->where("LogsRechargementsEntity.idCompte = :idAccount");
        $qb->andWhere("LogsRechargementsEntity.compte != ''");
        $qb->setParameter("idAccount", $idAccount);
        $qb->orderBy("LogsRechargementsEntity.date", "DESC");

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

}
