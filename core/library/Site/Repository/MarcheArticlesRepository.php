<?php

namespace Site\Repository;

use \Shared\EntityRepository;

class MarcheArticlesRepository extends EntityRepository {

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

    public function findArticlePersonnages($idCompte = 0, $raceFilter = 0, $sexeFilter = 0, $levelFilter = 0, $orderFilter = 1, $deviseFilter = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->select(""
                . "MarcheArticlesEntity.designation,"
                . "MarcheArticlesEntity.description,"
                . "MarcheArticlesEntity.prix,"
                . "MarcheArticlesEntity.devise idDevise,"
                . "MarcheCategoriesEntity.nomCategorie,"
                . "MarcheDevisesEntity.devise,"
                . "MarchePersonnagesEntity.idProprietaire,"
                . "MarchePersonnagesEntity.id idMarchePersonnage,"
                . "PlayerEntity.level,"
                . "PlayerEntity.name,"
                . "PlayerEntity.job");

        $qb->from("\Site\Entity\MarcheArticles", "MarcheArticlesEntity");
        $qb->innerJoin("\Site\Entity\MarcheCategories", "MarcheCategoriesEntity", "WITH", "MarcheCategoriesEntity.id = MarcheArticlesEntity.categorie");
        $qb->innerJoin("\Site\Entity\MarcheDevises", "MarcheDevisesEntity", "WITH", "MarcheDevisesEntity.id = MarcheArticlesEntity.devise");
        $qb->innerJoin("\Site\Entity\MarchePersonnages", "MarchePersonnagesEntity", "WITH", "MarchePersonnagesEntity.id = MarcheArticlesEntity.identifiantArticle");
        $qb->innerJoin("\Player\Entity\Player", "PlayerEntity", "WITH", "PlayerEntity.id = MarchePersonnagesEntity.idPersonnage");
        $qb = $this->getDQLJoueurNonGM($qb);

        if ($idCompte != 0) {
            $qb->andWhere("MarchePersonnagesEntity.idProprietaire = :idCompte");
            $qb->setParameter("idCompte", $idCompte);
        }

        if ($raceFilter != 0) {
            $arrayJobType = [];
            switch ($raceFilter) {
                case 1: $arrayJobType = [0, 4];
                    break;
                case 2: $arrayJobType = [2, 6];
                    break;
                case 3: $arrayJobType = [1, 5];
                    break;
                case 4: $arrayJobType = [3, 7];
                    break;
            }
            $qb->andWhere("PlayerEntity.job IN(:arrayJobType)");
            $qb->setParameter("arrayJobType", $arrayJobType);
        }

        if ($sexeFilter != 0) {
            $arrayJobSexe = [];
            switch ($sexeFilter) {
                case 1: $arrayJobSexe = [0, 2, 5, 7];
                    break;
                case 2: $arrayJobSexe = [1, 3, 4, 6];
                    break;
            }
            $qb->andWhere("PlayerEntity.job IN(:arrayJobSexe)");
            $qb->setParameter("arrayJobSexe", $arrayJobSexe);
        }

        if ($levelFilter != 0) {
            switch ($levelFilter) {
                case 1: $qb->andWhere("PlayerEntity.level >= 1 AND PlayerEntity.level <= 100");
                    break;
                case 2: $qb->andWhere("PlayerEntity.level >= 101 AND PlayerEntity.level <= 200");
                    break;
                case 3: $qb->andWhere("PlayerEntity.level >= 201 AND PlayerEntity.level <= 270");
                    break;
            }
        }
        
        if ($orderFilter > 0) {
            switch ($orderFilter) {
                case 1: 
                    $qb->addSelect('RAND() as HIDDEN rand');
                    $qb->orderBy("rand");
                    break;
                case 2: $qb->orderBy("MarcheArticlesEntity.prix", "ASC");
                    break;
                case 3: $qb->orderBy("MarcheArticlesEntity.prix", "DESC");
                    break;
                case 4: $qb->orderBy("MarcheArticlesEntity.dateAjout", "DESC");
                    break;
                case 5: $qb->orderBy("MarcheArticlesEntity.dateAjout", "ASC");
                    break;
            }
        }
        
        if ($deviseFilter != 0) {
            switch ($deviseFilter) {
                case 1: $qb->andWhere("MarcheArticlesEntity.devise = 1");
                    break;
                case 2: $qb->andWhere("MarcheArticlesEntity.devise = 2");
                    break;
            }
        }

        $qb->setMaxResults(50);

        try {
            return $qb->getQuery()->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return [];
        }
    }
    
    public function deleteByIdentifiantArticle($identifiantArticle = 0) {

        $qb = $this->_em->createQueryBuilder();

        $qb->delete("\Site\Entity\MarcheArticles", "MarcheArticlesEntity");
        $qb->where("MarcheArticlesEntity.identifiantArticle = :identifiantArticle");
        $qb->setParameter("identifiantArticle", $identifiantArticle);

        try {
            return $qb->getQuery()->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
