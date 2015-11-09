<?php

namespace Account\Repository;

use \Shared\EntityRepository;

class AccountRepository extends EntityRepository {

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

}
