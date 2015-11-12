<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ItemshopCategoriesRepository extends EntityRepository {

    public function findCategoriesNotEmpty() {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemshopCategoriesEntity");
        $qb->from("\Site\Entity\ItemshopCategories", "ItemshopCategoriesEntity");
        $qb->where("(SELECT COUNT(ItemshopEntity) FROM \Site\Entity\Itemshop ItemshopEntity WHERE ItemshopEntity.cat = ItemshopCategoriesEntity.cat) > 0");

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

}
