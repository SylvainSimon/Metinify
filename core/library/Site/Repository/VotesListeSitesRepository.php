<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class VotesListeSitesRepository extends EntityRepository {

    public function findVotesListeSites($estActif = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("VotesListeSitesEntity");
        $qb->from("\Site\Entity\VotesListeSites", "VotesListeSitesEntity");

        if ($estActif !== "") {
            $qb->where("VotesListeSitesEntity.actif = :estActif");
            $qb->setParameter("estActif", $estActif);
        }

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

}
