<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class AdministrationLogsGererMonnaiesRepository extends EntityRepository {

    public function findHistorique($max = 20) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("AdministrationLogsGererMonnaies");
        $qb->from("\Site\Entity\AdministrationLogsGererMonnaies", "AdministrationLogsGererMonnaiesEntity");
        $qb->leftJoin("\Account\Entity\Account", "AccountEntityUser", "WITH", "AccountEntityUser.id = AdministrationLogsGererMonnaiesEntity.idCompte");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntityAdmin", "WITH", "AccountEntityAdmin.id = AdministrationLogsGererMonnaiesEntity.idGm");
        $qb->setMaxResults($max);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
