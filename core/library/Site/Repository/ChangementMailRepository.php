<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ChangementMailRepository extends EntityRepository {

    public function findByIdCompteAndNumeroVerif($idAccount = 0, $numeroVerif = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ChangementMailEntity");
        $qb->from("\Site\Entity\ChangementMail", "ChangementMailEntity");
        $qb->where("ChangementMailEntity.idCompte = :idAccount");
        $qb->andWhere("ChangementMailEntity.numeroVerif = :numeroVerif");
        $qb->setParameter("idAccount", $idAccount);
        $qb->setParameter("numeroVerif", $numeroVerif);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function deleteByAccountId($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->delete("\Site\Entity\ChangementMail", "ChangementMailEntity");
        $qb->where("ChangementMailEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
