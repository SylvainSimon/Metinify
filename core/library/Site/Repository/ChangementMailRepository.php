<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ChangementMailRepository extends EntityRepository {

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
