<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class GuildRepository extends EntityRepository {

    public function getDQLCompteActif(\Doctrine\ORM\QueryBuilder $dql) {
        $dql->andWhere("AccountEntity.status != 'BLOCK'");
        return $dql;
    }

    public function getDQLJoueurNonGM(\Doctrine\ORM\QueryBuilder $dql) {
        $dql->andWhere(""
                . "PlayerEntity.name NOT IN "
                . "(SELECT GmlistEntity.mname "
                . "FROM \Common\Entity\Gmlist GmlistEntity)");
        $dql->andWhere("NOT (PlayerEntity.name like '[GM]%')");
        $dql->andWhere("NOT (PlayerEntity.name like '[TGM]%')");
        $dql->andWhere("NOT (PlayerEntity.name like '[Admin]%')");
        $dql->andWhere("NOT (PlayerEntity.name like '[TM]%')");
        $dql->andWhere("NOT (PlayerEntity.name like '[SGM]%')");
        return $dql;
    }

    public function findTop($max = 6) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("GuildEntity.name, GuildEntity.level");
        $qb->from("\Player\Entity\Guild", "GuildEntity");
        $qb->innerJoin("\Player\Entity\Player", "PlayerEntity", "WITH", "PlayerEntity.id = GuildEntity.master");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount");
        $qb->where("1 = 1");

        $qb = $this->getDQLCompteActif($qb);
        $qb = $this->getDQLJoueurNonGM($qb);

        $qb->orderBy("GuildEntity.level DESC, GuildEntity.victoire DESC, GuildEntity.egalite DESC, GuildEntity.defaite", "ASC");
        $qb->setMaxResults($max);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return [];
        }
    }

}
