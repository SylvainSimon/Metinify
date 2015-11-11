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
                . "SupportDiscussionsEntity.date, "
                . "AccountEntity.pseudoMessagerie AS admin ");

        $qb->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity");
        $qb->innerJoin("\Site\Entity\SupportObjets", "SupportObjetsEntity", "WITH", "SupportObjetsEntity.id = SupportDiscussionsEntity.idObjet");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = SupportDiscussionsEntity.idAdmin");
        $qb->where("SupportDiscussionsEntity.idCompte = :idAccount OR SupportDiscussionsEntity.idAdmin = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        if ($estArchive !== "") {
            $qb->andWhere("SupportDiscussionsEntity.estArchive = :estArchive");
            $qb->setParameter("estArchive", $estArchive);
        }

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

}
