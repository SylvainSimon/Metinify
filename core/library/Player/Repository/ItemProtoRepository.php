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
}
