<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SupportMessagesRepository extends EntityRepository {

    public function findMessages($idAccount = 0, $idDiscussion = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("SupportMessagesEntity");
        $qb->from("\Site\Entity\SupportMessages", "SupportMessagesEntity");
        $qb->innerJoin("\Site\Entity\SupportDiscussions", "SupportMessagesEntity", "WITH", "SupportMessagesEntity.id = SupportMessagesEntity.idDiscussion");
        $qb->where("SupportMessagesEntity.id = :idDiscussion");
        $qb->andWhere("SupportMessagesEntity.idCompte = :idAccount OR SupportMessagesEntity.idAdmin = :idAccount");
        $qb->setParameter("idDiscussion", $idDiscussion);
        $qb->setParameter("idAccount", $idAccount);

        $qb->orderBy("SupportMessagesEntity.date", "ASC");

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    public function countMessages($idAccount = 0, $idDiscussion = 0, $estArchive = "", $etat = "") {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("count(SupportMessagesEntity)");
        $qb->from("\Site\Entity\SupportMessages", "SupportMessagesEntity");
        $qb->innerJoin("\Site\Entity\SupportDiscussions", "SupportMessagesEntity");
        $qb->where("SupportMessagesEntity.idCompte = :idAccount OR SupportMessagesEntity.idAdmin = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        if ($etat !== "") {
            $qb->andWhere("SupportMessagesEntity.etat = :etat");
            $qb->setParameter("etat", $etat);
        }

        if ($idDiscussion != 0) {
            $qb->andWhere("SupportMessagesEntity.id = :idDiscussion");
            $qb->setParameter("idDiscussion", $idDiscussion);
        }

        if ($estArchive !== "") {
            $qb->andWhere("SupportMessagesEntity.estArchive = :estArchive");
            $qb->setParameter("estArchive", $estArchive);
        }

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    public function countMessagesNonLu($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("count(SupportMessagesEntity)");
        $qb->from("\Site\Entity\SupportMessages", "SupportMessagesEntity");
        $qb->innerJoin("\Site\Entity\SupportDiscussions", "SupportMessagesEntity");
        $qb->where("SupportMessagesEntity.idCompte = :idAccount");
        $qb->andWhere("SupportMessagesEntity.idCompte != :idAccount");
        $qb->andWhere("SupportMessagesEntity.idAdmin != 0");
        $qb->setParameter("idAccount", $idAccount);

        $qb->andWhere("SupportMessagesEntity.etat = :etat");
        $qb->setParameter("etat", \Site\SupportEtatMessageHelper::NON_LU);
        $qb->andWhere("SupportMessagesEntity.estArchive = :estArchive");
        $qb->setParameter("estArchive", false);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }
    
    public function statMessages($interval = 0) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(SupportMessagesEntity)");
        $qb->from("\Site\Entity\SupportMessages", "SupportMessagesEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("SupportMessagesEntity.date >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(SupportMessagesEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(SupportMessagesEntity.date) = MONTH(:now)");
                $qb->andWhere("WEEK(SupportMessagesEntity.date) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(SupportMessagesEntity.date) = YEAR(:now)");
                $qb->andWhere("MONTH(SupportMessagesEntity.date) = MONTH(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 4:
                break;
        }
        
        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
