<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ControleChangementMailRepository extends EntityRepository {

    public function findByIdCompteAndNumeroVerif($idAccount = 0, $numeroVerif = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ControleChangementMailEntity");
        $qb->from("\Site\Entity\ControleChangementMail", "ControleChangementMailEntity");
        $qb->where("ControleChangementMailEntity.idCompte = :idAccount");
        $qb->andWhere("ControleChangementMailEntity.numeroVerif = :numeroVerif");
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

        $qb->delete("\Site\Entity\ControleChangementMail", "ControleChangementMailEntity");
        $qb->where("ControleChangementMailEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
