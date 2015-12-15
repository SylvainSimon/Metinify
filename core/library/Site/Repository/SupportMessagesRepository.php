<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SupportMessagesRepository extends EntityRepository {

    public function findMessages($idAccount = 0, $idDiscussion = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "SupportMessagesEntity.id, "
                . "SupportMessagesEntity.idCompte, "
                . "SupportMessagesEntity.date, "
                . "SupportMessagesEntity.etat, "
                . "SupportMessagesEntity.dateChangementEtat, "
                . "SupportMessagesEntity.message,"
                . "AccountEntity.login,"
                . "AccountEntity.pseudoMessagerie"
                . "");
        $qb->from("\Site\Entity\SupportMessages", "SupportMessagesEntity");
        $qb->innerJoin("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity", "WITH", "SupportDiscussionsEntity.id = SupportMessagesEntity.idDiscussion");
        $qb->leftJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = SupportMessagesEntity.idCompte");
        $qb->where("SupportDiscussionsEntity.id = :idDiscussion");
        $qb->andWhere("SupportDiscussionsEntity.idCompte = :idAccount OR SupportDiscussionsEntity.idAdmin = :idAccount");
        $qb->setParameter("idDiscussion", $idDiscussion);
        $qb->setParameter("idAccount", $idAccount);

        $qb->orderBy("SupportMessagesEntity.date", "ASC");

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    public function countMessages($idAccount = 0, $idDiscussion = 0, $estArchive = "", $etat = "") {
        $qb = $this->_em->createQueryBuilder();

        $qb->select("count(SupportMessagesEntity)");
        $qb->from("\Site\Entity\SupportMessages", "SupportMessagesEntity");
        $qb->innerJoin("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->where("SupportDiscussionsEntity.idCompte = :idAccount OR SupportDiscussionsEntity.idAdmin = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        if ($etat !== "") {
            $qb->andWhere("SupportMessagesEntity.etat = :etat");
            $qb->setParameter("etat", $etat);
        }

        if ($idDiscussion != 0) {
            $qb->andWhere("SupportDiscussionsEntity.id = :idDiscussion");
            $qb->setParameter("idDiscussion", $idDiscussion);
        }

        if ($estArchive !== "") {
            $qb->andWhere("SupportDiscussionsEntity.estArchive = :estArchive");
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
        $qb->innerJoin("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->where("SupportDiscussionsEntity.idCompte = :idAccount");
        $qb->andWhere("SupportMessagesEntity.idCompte != :idAccount");
        $qb->andWhere("SupportDiscussionsEntity.idAdmin != 0");
        $qb->setParameter("idAccount", $idAccount);

        $qb->andWhere("SupportMessagesEntity.etat = :etat");
        $qb->setParameter("etat", \Site\SupportEtatMessageHelper::NON_LU);
        $qb->andWhere("SupportDiscussionsEntity.estArchive = :estArchive");
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
