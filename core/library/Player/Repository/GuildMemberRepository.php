<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class GuildMemberRepository extends EntityRepository {

    public function countByIdPlayer($idPlayer = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(GuildMemberEntity)");
        $qb->from("\Player\Entity\GuildMember", "GuildMemberEntity");
        $qb->where("GuildMemberEntity.pid = :idPlayer");
        $qb->setParameter("idPlayer", $idPlayer);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

}
