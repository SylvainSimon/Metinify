<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ItemshopCategoriesRepository extends EntityRepository {

    public function findByCat($idCat = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemshopCategoriesEntity");
        $qb->from("\Site\Entity\ItemshopCategories", "ItemshopCategoriesEntity");
        $qb->where("ItemshopCategoriesEntity.id = :idCat");
        $qb->setParameter("idCat", $idCat);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function findMaxCat() {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("MAX(ItemshopCategoriesEntity.id)");
        $qb->from("\Site\Entity\ItemshopCategories", "ItemshopCategoriesEntity");
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function findCategoriesNotEmpty() {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemshopCategoriesEntity");
        $qb->from("\Site\Entity\ItemshopCategories", "ItemshopCategoriesEntity");
        $qb->where("(SELECT COUNT(ItemshopEntity) FROM \Site\Entity\Itemshop ItemshopEntity WHERE ItemshopEntity.cat = ItemshopCategoriesEntity.id) > 0");

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

}
