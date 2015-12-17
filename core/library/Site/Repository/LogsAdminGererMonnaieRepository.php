<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsAdminGererMonnaieRepository extends EntityRepository {

    public function findHistorique($max = 20) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("LogsAdminGererMonnaie");
        $qb->from("\Site\Entity\LogsAdminGererMonnaie", "LogsAdminGererMonnaieEntity");
        $qb->leftJoin("\Account\Entity\Account", "AccountEntityUser", "WITH", "AccountEntityUser.id = LogsAdminGererMonnaieEntity.idCompte");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntityAdmin", "WITH", "AccountEntityAdmin.id = LogsAdminGererMonnaieEntity.idGm");
        $qb->setMaxResults($max);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
