<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ControleChangementMotDePasseRepository extends EntityRepository {

    public function deleteByAccountId($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->delete("\Site\Entity\ControleChangementMotDePasse", "ControleChangementMotDePasseEntity");
        $qb->where("ControleChangementMotDePasseEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function findByIdCompteAndNumeroVerif($idAccount = 0, $numeroVerif = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ControleChangementMotDePasseEntity");
        $qb->from("\Site\Entity\ControleChangementMotDePasse", "ControleChangementMotDePasseEntity");
        $qb->where("ControleChangementMotDePasseEntity.idCompte = :idAccount");
        $qb->andWhere("ControleChangementMotDePasseEntity.numeroVerif = :numeroVerif");
        $qb->setParameter("idAccount", $idAccount);
        $qb->setParameter("numeroVerif", $numeroVerif);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
