<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class IpToCountryRepository extends EntityRepository {

    public function findCountryBetween($ip = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("IpToCountryEntity");
        $qb->from("\Site\Entity\IpToCountry", "IpToCountryEntity");
        $qb->where(":ip BETWEEN IpToCountryEntity.ipFrom AND IpToCountryEntity.ipTo");
        $qb->setParameter("ip", $ip);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
