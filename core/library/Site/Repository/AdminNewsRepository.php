<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class AdminNewsRepository extends EntityRepository {

    public function findNews($max = 4) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("AdminNewsEntity.auteur,"
                . "AdminNewsEntity.titreMessage,"
                . "AdminNewsEntity.contenueMessage,"
                . "AdminNewsEntity.lienIllustration,"
                . "AdminNewsEntity.date,"
                . "AccountEntity.pseudoMessagerie");
        $qb->from("\Site\Entity\AdminNews", "AdminNewsEntity");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = AdminNewsEntity.auteur");
        $qb->orderBy("AdminNewsEntity.date", "DESC");
        $qb->setMaxResults($max);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
