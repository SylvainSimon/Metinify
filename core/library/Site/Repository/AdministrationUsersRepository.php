<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class AdministrationUsersRepository extends EntityRepository {

    /**
     * Retourne les droits d'admin d'un compte
     * @param integer $idAccount
     * @return array of object or null
     */
    public function findAdministrationUser($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("AdministrationUsersEntity");
        $qb->from("\Site\Entity\AdministrationUsers", "AdministrationUsersEntity");
        $qb->where("AdministrationUsersEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
