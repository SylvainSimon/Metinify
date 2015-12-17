<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class ActualitesRepository extends EntityRepository {

    public function findNews($max = 4) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("ActualitesEntity.auteur,"
                . "ActualitesEntity.titreMessage,"
                . "ActualitesEntity.contenueMessage,"
                . "ActualitesEntity.date,"
                . "AccountEntity.pseudoMessagerie");
        $qb->from("\Site\Entity\Actualites", "ActualitesEntity");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = ActualitesEntity.auteur");
        $qb->orderBy("ActualitesEntity.date", "DESC");
        $qb->setMaxResults($max);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
