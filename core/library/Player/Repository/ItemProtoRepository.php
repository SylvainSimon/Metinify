<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class ItemProtoRepository extends EntityRepository {
    
    public function findFlagByVnum($vNum = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemProtoEntity.flag");
        $qb->from("\Player\Entity\ItemProto", "ItemProtoEntity");
        $qb->where("ItemProtoEntity.vnum = :vNum");
        $qb->setParameter("vNum", $vNum);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function findByNameForAjaxSelect($name = "") {

        $name = ($name !== "") ? "%" . $name . "%" : "%";

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemProtoEntity.vnum, ItemProtoEntity.localeName");
        $qb->from("\Player\Entity\ItemProto", "ItemProtoEntity");
        $qb->where("ItemProtoEntity.localeName LIKE :name");
        $qb->setParameter("name", $name);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function findSocketPctByVnum($vNum = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ItemProtoEntity.socketPct");
        $qb->from("\Player\Entity\ItemProto", "ItemProtoEntity");
        $qb->where("ItemProtoEntity.vnum = :vNum");
        $qb->setParameter("vNum", $vNum);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
