<?php

namespace Site;

use \Shared\DoctrineHelper;

class SiteHelper {

    /**
     * @return \Site\Repository\ActualitesRepository
     */
    public static function getActualitesRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\Actualites');
    }

    /**
     * @return \Site\Repository\AdminsRepository
     */
    public static function getAdminsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\Admins');
    }
    
    /**
     * @return \Site\Repository\BannissementsActifsRepository
     */
    public static function getBannissementsActifsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\BannissementsActifs');
    }
    
    /**
     * @return \Site\Repository\ControleChangementMailRepository
     */
    public static function getControleChangementMailRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\ControleChangementMail');
    }
    
    /**
     * @return \Site\Repository\IpPaysFrRepository
     */
    public static function getIpPaysFrRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\IpPaysFr');
    }
    
    /**
     * @return \Site\Repository\IpToCountryRepository
     */
    public static function getIpToCountryRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\IpToCountry');
    }
    
    /**
     * @return \Site\Repository\ItemshopRepository
     */
    public static function getItemshopRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\Itemshop');
    }
    
    /**
     * @return \Site\Repository\ItemshopCategoriesRepository
     */
    public static function getItemshopCategoriesRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\ItemshopCategories');
    }
    
    /**
     * @return \Site\Repository\ControleChangementMotDePasseRepository
     */
    public static function getControleChangementMotDePasseRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\ControleChangementMotDePasse');
    }
    
    /**
     * @return \Site\Repository\SuppressionPersonnageRepository
     */
    public static function getSuppressionPersonnageRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\SuppressionPersonnage');
    }
    
    /**
     * @return \Site\Repository\MarcheArticlesRepository
     */
    public static function getMarcheArticlesRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\MarcheArticles');
    }
    
    /**
     * @return \Site\Repository\MarchePersonnagesRepository
     */
    public static function getMarchePersonnagesRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\MarchePersonnages');
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
     * @return \Site\Repository\LogsItemshopAchatsRepository
     */
    public static function getLogsItemshopAchatsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsItemshopAchats');
    }
    
    /**
     * @return \Site\Repository\LogsRechargementsRepository
     */
    public static function getLogsRechargementsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsRechargements');
    }
    
    /**
     * @return \Site\Repository\LogsConnexionRepository
     */
    public static function getLogsConnexionRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsConnexion');
    }
    
    /**
     * @return \Site\Repository\LogsChangementMailRepository
     */
    public static function getLogsChangementMailRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsChangementMail');
    }
    
    /**
     * @return \Site\Repository\LogsChangementPasswordRepository
     */
    public static function getLogsChangementPasswordRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsChangementPassword');
    }
    
    /**
     * @return \Site\Repository\LogsChangementCodeEntrepotRepository
     */
    public static function getLogsChangementCodeEntrepotRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsChangementCodeEntrepot');
    }
    
    /**
     * @return \Site\Repository\LogsOublieMotDePasseRepository
     */
    public static function getLogsOublieMotDePasseRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsOublieMotDePasse');
    }
    
    /**
     * @return \Site\Repository\LogsCreationJoueursRepository
     */
    public static function getLogsCreationJoueursRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsCreationJoueurs');
    }
    
    /**
     * @return \Site\Repository\LogsDeblocageYangsRepository
     */
    public static function getLogsDeblocageYangsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsDeblocageYangs');
    }
    
    /**
     * @return \Site\Repository\LogsMarcheAchatsRepository
     */
    public static function getLogsMarcheAchatsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\LogsMarcheAchats');
    }
    
    /**
     * @return \Site\Repository\VotesLogsRepository
     */
    public static function getVotesLogsRepository() {
        return DoctrineHelper::getRepository('\Site\Entity\VotesLogs');
    }
    
}
