<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class SupportDiscussionsRepository extends EntityRepository {

    public function findDiscussions($idAccount = 0, $estArchive = "", $limit = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "SupportDiscussionsEntity.id, "
                . "SupportObjetsEntity.objet, "
                . "SupportDiscussionsEntity.message, "
                . "SupportDiscussionsEntity.dateDernierMessage, "
                . "AccountEntityAdmin.pseudoMessagerie AS admin, "
                . "AccountEntityUser.pseudoMessagerie AS user ");

        $qb->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->innerJoin("\Site\Entity\SupportObjets", "SupportObjetsEntity", "WITH", "SupportObjetsEntity.id = SupportDiscussionsEntity.idObjet");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntityAdmin", "WITH", "AccountEntityAdmin.id = SupportDiscussionsEntity.idAdmin");
        $qb->leftJoin("\Account\Entity\Account", "AccountEntityUser", "WITH", "AccountEntityUser.id = SupportDiscussionsEntity.idCompte");
        $qb->where("SupportDiscussionsEntity.idCompte = :idAccount OR SupportDiscussionsEntity.idAdmin = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        if ($estArchive !== "") {
            $qb->andWhere("SupportDiscussionsEntity.estArchive = :estArchive");
            $qb->setParameter("estArchive", $estArchive);
        }

        $qb->orderBy("SupportDiscussionsEntity.dateDernierMessage", "DESC");

        if ($limit !== "") {
            $qb->setMaxResults($limit);
        }

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }
    
    public function findDiscussionsEnAttente($limit = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "SupportDiscussionsEntity.id, "
                . "SupportObjetsEntity.objet, "
                . "SupportDiscussionsEntity.message, "
                . "SupportDiscussionsEntity.date, "
                . "SupportDiscussionsEntity.ip, "
                . "AccountEntityUser.pseudoMessagerie AS user ");

        $qb->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->innerJoin("\Site\Entity\SupportObjets", "SupportObjetsEntity", "WITH", "SupportObjetsEntity.id = SupportDiscussionsEntity.idObjet");
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

}
