<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class ItemRepository extends EntityRepository {

    public function findByPosIntervalAndOwnerId($posStart = 0, $posMax = 0, $ownerId = 0, $window = "", $single = false) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "ItemEntity.count,"
                . "ItemEntity.id,"
                . "ItemEntity.pos,"
                . "ItemEntity.socket0,"
                . "ItemEntity.socket1,"
                . "ItemEntity.socket2,"
                . "ItemEntity.socket3,"
                . "ItemEntity.socket4,"
                . "ItemEntity.socket5,"
                . "ItemEntity.attrtype0,"
                . "ItemEntity.attrtype1,"
                . "ItemEntity.attrtype2,"
                . "ItemEntity.attrtype3,"
                . "ItemEntity.attrtype4,"
                . "ItemEntity.attrtype5,"
                . "ItemEntity.attrtype6,"
                . "ItemEntity.attrvalue0,"
                . "ItemEntity.attrvalue1,"
                . "ItemEntity.attrvalue2,"
                . "ItemEntity.attrvalue3,"
                . "ItemEntity.attrvalue4,"
                . "ItemEntity.attrvalue5,"
                . "ItemEntity.attrvalue6,"
                . "ItemProtoEntity.localeName,"
                . "ItemProtoEntity.limitvalue0,"
                . "ItemProtoEntity.applytype0,"
                . "ItemProtoEntity.applyvalue0,"
                . "ItemProtoEntity.applytype1,"
                . "ItemProtoEntity.applyvalue1,"
                . "ItemProtoEntity.applytype2,"
                . "ItemProtoEntity.applyvalue2,"
                . "ItemProtoEntity.flag,"
                . "ItemProtoEntity.size,"
                . "ItemListEntity.chemin");

        $qb->from("\Player\Entity\Item", "ItemEntity");
        $qb->innerJoin("\Player\Entity\ItemProto", "ItemProtoEntity", "WITH", "ItemProtoEntity.vnum = ItemEntity.vnum");
        $qb->leftJoin("\Site\Entity\ItemList", "ItemListEntity", "WITH", "ItemListEntity.item = ItemEntity.vnum");

        $qb->where("ItemEntity.ownerId = :ownerId");
        if ($single) {
            $qb->andWhere("ItemEntity.pos = :posStart");
            $qb->setParameter("posStart", $posStart);
        } else {
            $qb->andWhere("ItemEntity.pos >= :posStart");
            $qb->andWhere("ItemEntity.pos < :posMax");
            $qb->setParameter("posStart", $posStart);
            $qb->setParameter("posMax", $posMax);
        }
        
        $qb->andWhere("ItemEntity.window = :window");

        $qb->setParameter("ownerId", $ownerId);
        $qb->setParameter("window", $window);
        $qb->orderBy("ItemEntity.pos", "ASC");

        try {
            if ($single) {
                return $qb->getQuery()->getSingleResult();
            } else {
                return $qb->getQuery()->getResult();
            }
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

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
