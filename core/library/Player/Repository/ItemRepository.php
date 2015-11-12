<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class ItemRepository extends EntityRepository {

    public function countByOwnerIdPosAndWindow($ownerId = 0, $pos = 0, $window = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(ItemEntity)");
        $qb->from("\Player\Entity\Item", "ItemEntity");
        $qb->where("ItemEntity.ownerId = :ownerId");
        $qb->andWhere("ItemEntity.pos = :pos");
        $qb->andWhere("ItemEntity.window = :window");
        $qb->setParameter("ownerId", $ownerId);
        $qb->setParameter("pos", $pos);
        $qb->setParameter("window", $window);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }
    
}
