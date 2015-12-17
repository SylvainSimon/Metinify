<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ActualitesRepository extends EntityRepository {

    public function findNews($max = 4) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ActualitesEntity.idCompte,"
                . "ActualitesEntity.titre,"
                . "ActualitesEntity.contenu,"
                . "ActualitesEntity.date,"
                . "AccountEntity.pseudoMessagerie");
        $qb->from("\Site\Entity\Actualites", "ActualitesEntity");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = ActualitesEntity.idCompte");
        $qb->orderBy("ActualitesEntity.date", "DESC");
        $qb->setMaxResults($max);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
