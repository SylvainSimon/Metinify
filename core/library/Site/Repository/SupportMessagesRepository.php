<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SupportMessagesRepository extends EntityRepository {

    public function findMessages($idAccount = 0, $idDiscussion = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("SupportMessagesEntity");
        $qb->from("\Site\Entity\SupportMessages", "SupportMessagesEntity");
        $qb->innerJoin("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity", "WITH", "SupportDiscussionsEntity.id = SupportMessagesEntity.idDiscussion");
        $qb->where("SupportDiscussionsEntity.id = :idDiscussion");
        $qb->andWhere("SupportDiscussionsEntity.idCompte = :idAccount OR SupportDiscussionsEntity.idAdmin = :idAccount");
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

}
