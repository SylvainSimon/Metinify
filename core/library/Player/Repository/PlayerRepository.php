<?php

namespace Player\Repository;

use \Shared\EntityRepository;

class PlayerRepository extends EntityRepository {

    public function getDQLCompteActif(\Doctrine\ORM\QueryBuilder $dql) {
        $dql->andWhere("AccountEntity.status != 'BLOCK'");
        return $dql;
    }

    public function getDQLCompteBannis(\Doctrine\ORM\QueryBuilder $dql) {
        $dql->andWhere("AccountEntity.status = 'BLOCK'");
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

    /**
     * Retourne les joueurs d'un compte
     * @param integer $idAccount
     * @return array of object
     */
    public function findPlayers($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("PlayerEntity");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = :idAccount");
        $qb->where("PlayerEntity.id = PlayerIndexEntity.pid1 OR PlayerEntity.id = PlayerIndexEntity.pid2 OR PlayerEntity.id = PlayerIndexEntity.pid3 OR PlayerEntity.id = PlayerIndexEntity.pid4");
        $qb->setParameter("idAccount", $idAccount);

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function verifyIsMyPlayer($idAccount = 0, $idPlayer = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("PlayerEntity");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = :idAccount");
        $qb->where("PlayerEntity.id = PlayerIndexEntity.pid1 OR PlayerEntity.id = PlayerIndexEntity.pid2 OR PlayerEntity.id = PlayerIndexEntity.pid3 OR PlayerEntity.id = PlayerIndexEntity.pid4");
        $qb->andWhere("PlayerEntity = :idPlayer");
        $qb->setParameter("idAccount", $idAccount);
        $qb->setParameter("idPlayer", $idPlayer);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findPlayersBannis() {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "PlayerEntity.name,"
                . "PlayerEntity.level,"
                . "PlayerEntity.job,"
                . "PlayerIndexEntity.empire,"
                . "BannissementsActifsEntity.dateDebutBannissement,"
                . "BannissementsActifsEntity.duree,"
                . "BannissementRaisonsEntity.raison");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount");
        $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");
        $qb->innerJoin("\Site\Entity\BannissementsActifs", "BannissementsActifsEntity", "WITH", "BannissementsActifsEntity.idCompte = AccountEntity.id");
        $qb->innerJoin("\Site\Entity\BannissementRaisons", "BannissementRaisonsEntity", "WITH", "BannissementRaisonsEntity.id = BannissementsActifsEntity.raisonBannissement");
        $qb = $this->getDQLCompteBannis($qb);

        $qb->orderBy("BannissementsActifsEntity.dateDebutBannissement", "DESC");
        $qb->setMaxResults(15);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function countPlayerByName($name = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(PlayerEntity)");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->where("PlayerEntity.name = :name");
        $qb->setParameter("name", $name);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    public function countPlayerOnline($minutes = 0) {

        $nowInterval = \Carbon\Carbon::now()->subMinute($minutes);

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(PlayerEntity)");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->where("PlayerEntity.lastPlay >= :nowInterval");
        $qb->setParameter("nowInterval", $nowInterval);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    /**
     * Retourne un joueur d'un compte
     * @param integer $idAccount
     * @return array of object
     */
    public function findPlayerByIdPlayerAndIdAccount($idPlayer = 0, $idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("PlayerEntity");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->where("PlayerEntity.id = :idPlayer");
        $qb->andWhere("PlayerEntity.idAccount = :idAccount");
        $qb->setParameter("idPlayer", $idPlayer);
        $qb->setParameter("idAccount", $idAccount);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     * Retourne les x joueurs du top choisi
     * @param integer $max
     * @return array of object
     */
    public function findTop($order = "PVE", $max = 6) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("PlayerEntity.name, PlayerEntity.level, PlayerEntity.scorePve, PlayerEntity.victimesPvp");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount");
        $qb->where("1 = 1");

        $qb = $this->getDQLCompteActif($qb);
        $qb = $this->getDQLJoueurNonGM($qb);

        if ($order == "PVE") {
            $qb->orderBy("PlayerEntity.scorePve DESC, PlayerEntity.level DESC, PlayerEntity.exp", "DESC");
        } else if ($order == "PVP") {
            $qb->orderBy("PlayerEntity.victimesPvp DESC, PlayerEntity.level DESC, PlayerEntity.exp", "DESC");
        }

        $qb->setMaxResults($max);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return [];
        }
    }

    public function findClassement($order = "PVE", $intervalStart = 0, $intervalLength = 10, $forCache = false) {

        $nowInterval = \Carbon\Carbon::now()->subMinute(30);
        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "PlayerEntity.name, "
                . "PlayerEntity.level, "
                . "PlayerEntity.exp, "
                . "PlayerEntity.job, "
                . "PlayerEntity.skillGroup, "
                . "PlayerIndexEntity.empire, "
                . "PlayerEntity.scorePve, "
                . "IFELSE((PlayerEntity.lastPlay >= :nowInterval), 1, 0) AS online, "
                . "PlayerEntity.victimesPvp");

        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount");
        $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");
        $qb->where("1 = 1");
        $qb->andWhere("PlayerEntity.level > 100");
        $qb->setParameter("nowInterval", $nowInterval);

        $qb = $this->getDQLCompteActif($qb);
        $qb = $this->getDQLJoueurNonGM($qb);

        if ($order == "PVE") {
            $qb->orderBy("PlayerEntity.scorePve DESC, PlayerEntity.level DESC, PlayerEntity.exp", "DESC");
        } else if ($order == "PVP") {
            $qb->orderBy("PlayerEntity.victimesPvp DESC, PlayerEntity.level DESC, PlayerEntity.exp", "DESC");
        }

        if (!$forCache) {
            $qb->setFirstResult($intervalStart);
            $qb->setMaxResults($intervalLength);
        }

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return [];
        }
    }

    public function countPlayerClassement() {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(PlayerEntity.id)");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount");
        $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");
        $qb->where("1 = 1");

        $qb = $this->getDQLCompteActif($qb);
        $qb = $this->getDQLJoueurNonGM($qb);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    public function statPlayer($job = "", $empire = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(PlayerEntity.id)");
        $qb->from("\Player\Entity\Player", "PlayerEntity");
        $qb->where("1 = 1");

        if ($job !== "") {
            $qb->andWhere("PlayerEntity.job IN(:job)");
            $qb->setParameter("job", $job);
        }

        if ($empire !== "") {
            $qb->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount");
            $qb->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");
            $qb->andWhere("PlayerIndexEntity.empire IN(:empire)");
            $qb->setParameter("empire", $empire);
        }

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
