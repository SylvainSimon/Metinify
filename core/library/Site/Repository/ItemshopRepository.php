<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ItemshopRepository extends EntityRepository {

    public function findItem($idItem = 0, $estActif = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemshopEntity");
        $qb->from("\Site\Entity\Itemshop", "ItemshopEntity");
        $qb->where("ItemshopEntity.id = :idItem");
        $qb->setParameter("idItem", $idItem);

        if ($estActif !== "") {
            $qb->andWhere("ItemshopEntity.actif = :estActif");
            $qb->setParameter("estActif", $estActif);
        }

        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findItemsByCategorie($idCategorie = 0, $estActif = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemshopEntity");
        $qb->from("\Site\Entity\Itemshop", "ItemshopEntity");

        if ($idCategorie !== 0) {
            $qb->where("ItemshopEntity.cat = :idCategorie");
            $qb->setParameter("idCategorie", $idCategorie);
        }

        if ($estActif !== "") {
            $qb->andWhere("ItemshopEntity.actif = :estActif");
            $qb->setParameter("estActif", $estActif);
        }

        $qb->orderBy("ItemshopEntity.nameItem", "ASC");

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
