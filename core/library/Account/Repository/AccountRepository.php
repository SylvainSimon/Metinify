<?php

namespace Account\Repository;

use \Shared\EntityRepository;

class AccountRepository extends EntityRepository {

    public function findAccountByLoginAndPassword($login = "", $password = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("AccountEntity");
        $qb->from("\Account\Entity\Account", "AccountEntity");
        $qb->where("AccountEntity.login = :login");
        $qb->andWhere("AccountEntity.password = PASSWORD(:password)");
        $qb->setParameter("login", $login);
        $qb->setParameter("password", $password);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findAccountByEmailAndLogin($email = "", $login = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("AccountEntity");
        $qb->from("\Account\Entity\Account", "AccountEntity");
        $qb->where("AccountEntity.email = :email");
        $qb->andWhere("AccountEntity.login = :login");
        $qb->setParameter("email", $email);
        $qb->setParameter("login", $login);
        $qb->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function countByPseudoMessagerie($pseudoMessagerie = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(AccountEntity)");
        $qb->from("\Account\Entity\Account", "AccountEntity");
        $qb->where("AccountEntity.pseudoMessagerie = :pseudoMessagerie");
        $qb->setParameter("pseudoMessagerie", $pseudoMessagerie);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function updateAccountPassword($idAccount = 0, $password = "") {

        $qb = $this->_em->createQueryBuilder();

        $qb->update("\Account\Entity\Account", "AccountEntity");
        $qb->set("AccountEntity.password", "PASSWORD(:password)");
        $qb->where("AccountEntity.id = :idAccount");
        $qb->setParameter("idAccount", $idAccount);
        $qb->setParameter("password", $password);

        try {
            return $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function statAccountCreate($interval = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(AccountEntity)");
        $qb->from("\Account\Entity\Account", "AccountEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("AccountEntity.createTime >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(AccountEntity.createTime) = YEAR(:now)");
                $qb->andWhere("MONTH(AccountEntity.createTime) = MONTH(:now)");
                $qb->andWhere("WEEK(AccountEntity.createTime) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(AccountEntity.createTime) = YEAR(:now)");
                $qb->andWhere("MONTH(AccountEntity.createTime) = MONTH(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 4:
                break;
        }

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
