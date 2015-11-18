<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class GuildMemberRepository extends EntityRepository {

    public function findByIdPlayer($idPlayer = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("GuildMemberEntity.grade,"
                . "GuildMemberEntity.offer,"
                . "GuildEntity.name,"
                . "IFELSE(GuildEntity.master = :idPlayer, 1, 0) as isMaster");
        $qb->from("\Player\Entity\GuildMember", "GuildMemberEntity");
        $qb->innerJoin("\Player\Entity\Guild", "GuildEntity", "WITH", "GuildEntity.id = GuildMemberEntity.guildId");
        $qb->where("GuildMemberEntity.pid = :idPlayer");
        $qb->setParameter("idPlayer", $idPlayer);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
