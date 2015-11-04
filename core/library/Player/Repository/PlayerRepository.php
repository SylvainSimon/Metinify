<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class PlayerRepository extends EntityRepository {

    
    /**
     * Retourne les joueurs d'un compte
     * @param integer $idAccount
     * @return object
     */
    public function findPlayers($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("PlayerEntity");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->where("PlayerEntity.idAccount = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
}
