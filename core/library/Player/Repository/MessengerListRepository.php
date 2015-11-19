<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class MessengerListRepository extends EntityRepository {

    public function findByPlayerName($namePlayer = "") {

        $nowInterval = \Carbon\Carbon::now()->subMinute(30);
        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "PlayerEntity.name,"
                . "PlayerIndexEntity.empire,"
                . "PlayerEntity.level,"
                . "IFELSE((PlayerEntity.lastPlay >= :nowInterval), 1, 0) AS online, "
                . "AccountEntity.status,"
                . "PlayerEntity.exp,"
                . "PlayerEntity.skillGroup,"
                . "PlayerEntity.job,"
                . "PlayerEntity.playtime"
                . "");
        $qb->from("\Player\Entity\MessengerList", "MessengerListEntity");
        $qb->innerJoin("\Player\Entity\Player", "PlayerEntity", "WITH", "PlayerEntity.name = MessengerListEntity.companion");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount");
        $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");
        $qb->where("MessengerListEntity.account = :namePlayer");
        $qb->setParameter("namePlayer", $namePlayer);
        $qb->setParameter("nowInterval", $nowInterval);

        $qb->orderBy("AccountEntity.status DESC, MessengerListEntity.companion", "ASC");

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    

    public function deleteByNamePlayer($namePlayer = "") {

        $qb = $this->_em->createQueryBuilder();
        $qb->delete("\Player\Entity\MessengerList", "MessengerListEntity");
        $qb->where("MessengerListEntity.account = :namePlayer OR MessengerListEntity.companion = :namePlayer");
        $qb->setParameter("namePlayer", $namePlayer);

        try {
            return $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
