<?php

namespace Site;

use \Shared\DoctrineHelper;

class SiteHelper {

    /**
     * @return \Site\Repository\AdministrationUsersRepository
     */
    public static function getAdministrationUsersRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\AdministrationUsers');
    }
    
    /**
     * @return \Site\Repository\ChangementMailRepository
     */
    public static function getChangementMailRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\ChangementMail');
    }
    
    /**
     * @return \Site\Repository\ChangementMotDePasseRepository
     */
    public static function getChangementMotDePasseRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\ChangementMotDePasse');
    }
    
    /**
     * @return \Site\Repository\SuppressionPersonnageRepository
     */
    public static function getSuppressionPersonnageRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\SuppressionPersonnage');
    }
    
    /**
     * @return \Site\Repository\VotesListeSitesRepository
     */
    public static function getVotesListeSitesRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\VotesListeSites');
    }
    
    /**
     * @return \Site\Repository\SupportDiscussionsRepository
     */
    public static function getSupportDiscussionsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\SupportDiscussions');
    }
    
    /**
     * @return \Site\Repository\SupportMessagesRepository
     */
    public static function getSupportMessagesRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\SupportMessages');
    }
    
    /**
     * @return \Site\Repository\SupportObjetsRepository
     */
    public static function getSupportObjetsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\SupportObjets');
    }
    
}
