<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class MarchePersonnagesRepository extends EntityRepository {
    
    public function findByIdAndIdProprietaire($id = 0, $idProprietaire = 0) {
        
        $qb = $this->_em->createQueryBuilder();

        $qb->select("MarchePersonnagesEntity");
        $qb->from("\Site\Entity\MarchePersonnages", "MarchePersonnagesEntity");
        $qb->where("MarchePersonnagesEntity.id = :id");
        $qb->andWhere("MarchePersonnagesEntity.idProprietaire = :idProprietaire");
        $qb->setParameter("id", $id);
        $qb->setParameter("idProprietaire", $idProprietaire);
        
        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
