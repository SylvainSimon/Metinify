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
                . "ItemProtoSocket0.localeName AS socket0Name,"
                . "ItemProtoSocket1.localeName AS socket1Name,"
                . "ItemProtoSocket2.localeName AS socket2Name,"
                . "ItemProtoSocket3.localeName AS socket3Name,"
                . "ItemProtoSocket4.localeName AS socket4Name,"
                . "ItemProtoSocket5.localeName AS socket5Name,"
                . "ItemListSocket0.chemin AS socket0Chemin,"
                . "ItemListSocket1.chemin AS socket1Chemin,"
                . "ItemListSocket2.chemin AS socket2Chemin,"
                . "ItemListSocket3.chemin AS socket3Chemin,"
                . "ItemListSocket4.chemin AS socket4Chemin,"
                . "ItemListSocket5.chemin AS socket5Chemin,"
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
        $qb->leftJoin("\Player\Entity\ItemProto", "ItemProtoSocket0", "WITH", "ItemProtoSocket0.vnum = ItemEntity.socket0");
        $qb->leftJoin("\Player\Entity\ItemProto", "ItemProtoSocket1", "WITH", "ItemProtoSocket1.vnum = ItemEntity.socket1");
        $qb->leftJoin("\Player\Entity\ItemProto", "ItemProtoSocket2", "WITH", "ItemProtoSocket2.vnum = ItemEntity.socket2");
        $qb->leftJoin("\Player\Entity\ItemProto", "ItemProtoSocket3", "WITH", "ItemProtoSocket3.vnum = ItemEntity.socket3");
        $qb->leftJoin("\Player\Entity\ItemProto", "ItemProtoSocket4", "WITH", "ItemProtoSocket4.vnum = ItemEntity.socket4");
        $qb->leftJoin("\Player\Entity\ItemProto", "ItemProtoSocket5", "WITH", "ItemProtoSocket5.vnum = ItemEntity.socket5");
        $qb->leftJoin("\Site\Entity\ItemList", "ItemListSocket0", "WITH", "ItemListSocket0.item = ItemEntity.socket0");
        $qb->leftJoin("\Site\Entity\ItemList", "ItemListSocket1", "WITH", "ItemListSocket1.item = ItemEntity.socket1");
        $qb->leftJoin("\Site\Entity\ItemList", "ItemListSocket2", "WITH", "ItemListSocket2.item = ItemEntity.socket2");
        $qb->leftJoin("\Site\Entity\ItemList", "ItemListSocket3", "WITH", "ItemListSocket3.item = ItemEntity.socket3");
        $qb->leftJoin("\Site\Entity\ItemList", "ItemListSocket4", "WITH", "ItemListSocket4.item = ItemEntity.socket4");
        $qb->leftJoin("\Site\Entity\ItemList", "ItemListSocket5", "WITH", "ItemListSocket5.item = ItemEntity.socket5");

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
    

    public function deleteByOwnerId($ownerId = 0, $window = []) {

        $qb = $this->_em->createQueryBuilder();
        $qb->delete("\Player\Entity\Item", "ItemEntity");
        $qb->where("ItemEntity.ownerId = :ownerId");
        $qb->andWhere("ItemEntity.window IN(:window)");
        $qb->setParameter("ownerId", $ownerId);
        $qb->setParameter("window", $window);

        try {
            return $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
