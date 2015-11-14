<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class LogsOublieMotDePasseRepository extends EntityRepository {

    public function statOublieMotDePasse($interval = 0, $result = "") {
        
        $qb = $this->_em->createQueryBuilder();

        $qb->select("COUNT(LogsOublieMotDePasseEntity)");
        $qb->from("\Site\Entity\LogsOublieMotDePasse", "LogsOublieMotDePasseEntity");
        $qb->where("1 = 1");

        switch ($interval) {
            case 1:
                $qb->andWhere("LogsOublieMotDePasseEntity.dateEssai >= :now");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 2:
                $qb->andWhere("YEAR(LogsOublieMotDePasseEntity.dateEssai) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsOublieMotDePasseEntity.dateEssai) = MONTH(:now)");
                $qb->andWhere("WEEK(LogsOublieMotDePasseEntity.dateEssai) = WEEK(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 3:
                $qb->andWhere("YEAR(LogsOublieMotDePasseEntity.dateEssai) = YEAR(:now)");
                $qb->andWhere("MONTH(LogsOublieMotDePasseEntity.dateEssai) = MONTH(:now)");
                $qb->setParameter("now", $this->getDateNow());
                break;
            case 4:
                break;
        }
        
        if ($result !== "") {
            $qb->andWhere("LogsOublieMotDePasseEntity.resultatDemande = :result");
            $qb->setParameter("result", $result);
        }
        
        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
