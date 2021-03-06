<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SupportDiscussionsRepository extends EntityRepository {
    
    public function findDiscussionsEnAttente($limit = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "SupportDiscussionsEntity.id, "
                . "SupportDiscussionsEntity.message, "
                . "SupportDiscussionsEntity.idObjet, "
                . "SupportDiscussionsEntity.date, "
                . "SupportDiscussionsEntity.ip, "
                . "AccountEntityUser.login AS user ");

        $qb->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->leftJoin("\Account\Entity\Account", "AccountEntityUser", "WITH", "AccountEntityUser.id = SupportDiscussionsEntity.idCompte");
        $qb->where("SupportDiscussionsEntity.idAdmin = 0");
        
        $qb->orderBy("SupportDiscussionsEntity.date", "DESC");

        if ($limit !== "") {
            $qb->setMaxResults($limit);
        }

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    public function countDiscussionActiveByIdAccount($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("count(SupportDiscussionsEntity)");
        $qb->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->where("SupportDiscussionsEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);
        $qb->andWhere("SupportDiscussionsEntity.estArchive = :estArchive");
        $qb->setParameter("estArchive", 0);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }
    
    public function statDiscussions($interval = 0, $estArchive = "") {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(SupportDiscussionsEntity)");
        $qb->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("SupportDiscussionsEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(SupportDiscussionsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(SupportDiscussionsEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(SupportDiscussionsEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(SupportDiscussionsEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(SupportDiscussionsEntity.date) = MONTH(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 4:
                break;
        }
        
        if($estArchive !== ""){
            $qb->andWhere("SupportDiscussionsEntity.estArchive = :estArchive");
            $qb->setParameter("estArchive", $estArchive);
        }
        
        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
