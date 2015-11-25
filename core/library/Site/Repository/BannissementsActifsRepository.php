<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class BannissementsActifsRepository extends EntityRepository {

    public function findBannissement($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "BannissementsActifsEntity.dateDebutBannissement, "
                . "BannissementsActifsEntity.dateFinBannissement, "
                . "BannissementsActifsEntity.commentaireBannissement, "
                . "BannissementsActifsEntity.definitif, "
                . "BannissementsActifsEntity.duree, "
                . "BannissementRaisonsEntity.raison, "
                . "AccountGMEntity.pseudoMessagerie");
        $qb->from("\Site\Entity\BannissementsActifs", "BannissementsActifsEntity");
        $qb->innerJoin("\Site\Entity\BannissementRaisons", "BannissementRaisonsEntity", "WITH", "BannissementRaisonsEntity.id = BannissementsActifsEntity.raisonBannissement");
        $qb->innerJoin("\Account\Entity\Account", "AccountGMEntity", "WITH", "AccountGMEntity.id = BannissementsActifsEntity.idCompteGm");
        $qb->where("BannissementsActifsEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function findByIdAccount($idAccount = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select("BannissementsActifsEntity");
        $qb->from("\Site\Entity\BannissementsActifs", "BannissementsActifsEntity");
        $qb->where("BannissementsActifsEntity.idCompte = :idAccount");
        $qb->setParameter("idAccount", $idAccount);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
