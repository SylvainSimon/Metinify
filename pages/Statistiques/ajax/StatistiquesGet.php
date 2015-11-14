<?php

namespace Pages\Statistiques\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class StatistiquesGet extends \PageHelper {

    public function run() {

        $cacheManager = \CacheHelper::getCacheManager();
        $intervalStat = $_POST["id_statistique"];

        if ($cacheManager->isExisting("arrStatistiques".$intervalStat)) {
            $arrStatistiques = $cacheManager->get("arrStatistiques".$intervalStat);
            echo $arrStatistiques;
            
        } else {

            $Donnees_Statistique_Nombres_Comptes = \Account\AccountHelper::getAccountRepository()->statAccountCreate($intervalStat);
            $Donnees_Statistique_Nombres_Joueurs = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat);
            
            $Donnees_Statistique_Nombres_Hommes = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [0,2,5,7]);
            $Donnees_Statistique_Nombres_Femmes = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [1,3,4,6]);
            
            $Donnees_Statistique_Nombres_Shinsoo = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, "", [1]);
            $Donnees_Statistique_Nombres_Chunjo = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, "", [2]);
            $Donnees_Statistique_Nombres_Jinno = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, "", [3]);

            $Donnees_Statistique_Nombres_Guerriers = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [0,4]);
            $Donnees_Statistique_Nombres_Suras = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [2,6]);
            $Donnees_Statistique_Nombres_Ninjas = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [1,5]);
            $Donnees_Statistique_Nombres_Shamans = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [3,7]);

            $Donnees_Statistique_Nombres_Connexion = \Site\SiteHelper::getLogsConnexionRepository()->statConnexions($intervalStat, 1);
            $Donnees_Statistique_Nombres_Connexion_Unique = \Site\SiteHelper::getLogsConnexionRepository()->statConnexions($intervalStat, 1, true);
            
            $Donnees_Nombres_Changement_Mail = \Site\SiteHelper::getLogsChangementMailRepository()->statChangementMails($intervalStat);
            $Donnees_Statistique_Nombres_Recuperation_MDP = \Site\SiteHelper::getLogsOublieMotDePasseRepository()->statOublieMotDePasse($intervalStat, 1);
            $Donnees_Statistique_Nombres_Changement_MDP = \Site\SiteHelper::getLogsChangementMotDePasseRepository()->statChangementMotDePasse($intervalStat);
            $Donnees_Statistique_Nombres_Changement_Code_Entrepot = \Site\SiteHelper::getLogsCodeEntrepotChangementRepository()->statChangementCodeEntrepot($intervalStat);

            $Donnees_Statistique_Nombres_Deblocage_Yangs = \Site\SiteHelper::getLogsDeblocageYangsRepository()->statDeblocageYangs($intervalStat);
            $Donnees_Statistique_Nombres_Vote = \Site\SiteHelper::getVotesLogsRepository()->statVotes($intervalStat);
            $Donnees_Statistique_Nombres_Achat_Persos = \Site\SiteHelper::getLogsMarcheAchatsRepository()->statMarcheAchats($intervalStat);
            $Donnees_Statistique_Nombres_Tickets_Ouverts = \Site\SiteHelper::getSupportDiscussionsRepository()->statDiscussions($intervalStat, false);
            $Donnees_Statistique_Nombres_Discussions_Archives = \Site\SiteHelper::getSupportDiscussionsRepository()->statDiscussions($intervalStat, true);
            $Donnees_Statistique_Nombres_Messages_Envoyes = \Site\SiteHelper::getSupportMessagesRepository()->statMessages($intervalStat);
            
            
            $Donnees_Statistique_Provenance_FR = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "FRA");
            $Donnees_Statistique_Provenance_CH = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "CHE");
            $Donnees_Statistique_Provenance_GB = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "GBR");
            $Donnees_Statistique_Provenance_DE = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "DEU");
            $Donnees_Statistique_Provenance_RO = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "ROM");
            $Donnees_Statistique_Provenance_US = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "USA");
            $Donnees_Statistique_Provenance_IT = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "ITA");
            $Donnees_Statistique_Provenance_ES = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "ESP");
            $Donnees_Statistique_Provenance_PL = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "POL");
            $Donnees_Statistique_Provenance_PT = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "PRT");
            $Donnees_Statistique_Provenance_TN = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "TUN");
            $Donnees_Statistique_Provenance_DZ = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "DZA");
            $Donnees_Statistique_Provenance_JP = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "JPN");
            $Donnees_Statistique_Provenance_BE = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "BEL");

            $Tableau_Json = array(
                'comptes' => "" . $Donnees_Statistique_Nombres_Comptes,
                'joueurs' => "" . $Donnees_Statistique_Nombres_Joueurs,
                'hommes' => "" . $Donnees_Statistique_Nombres_Hommes,
                'femmes' => "" . $Donnees_Statistique_Nombres_Femmes,
                'shinsoo' => "" . $Donnees_Statistique_Nombres_Shinsoo,
                'chunjo' => "" . $Donnees_Statistique_Nombres_Chunjo,
                'jinno' => "" . $Donnees_Statistique_Nombres_Jinno,
                'guerriers' => "" . $Donnees_Statistique_Nombres_Guerriers,
                'suras' => "" . $Donnees_Statistique_Nombres_Suras,
                'ninjas' => "" . $Donnees_Statistique_Nombres_Ninjas,
                'shamans' => "" . $Donnees_Statistique_Nombres_Shamans,
                'connexion_site' => "" . $Donnees_Statistique_Nombres_Connexion,
                'connexion_site_unique' => "" . $Donnees_Statistique_Nombres_Connexion_Unique,
                'changement_mail' => "" . $Donnees_Nombres_Changement_Mail,
                'recup_mdp' => "" . $Donnees_Statistique_Nombres_Recuperation_MDP,
                'changement_mdp' => "" . $Donnees_Statistique_Nombres_Changement_MDP,
                'changement_entrepot' => "" . $Donnees_Statistique_Nombres_Changement_Code_Entrepot,
                'deblocage_yangs' => "" . $Donnees_Statistique_Nombres_Deblocage_Yangs,
                'nombre_vote' => "" . $Donnees_Statistique_Nombres_Vote,
                'nombre_achats_perso' => "" . $Donnees_Statistique_Nombres_Achat_Persos,
                'tickets_ouvert' => "" . $Donnees_Statistique_Nombres_Tickets_Ouverts,
                'message_ecrits' => "" . $Donnees_Statistique_Nombres_Messages_Envoyes,
                'discussion_archives' => "" . $Donnees_Statistique_Nombres_Discussions_Archives,
                'pays_fr' => "" . $Donnees_Statistique_Provenance_FR,
                'pays_ch' => "" . $Donnees_Statistique_Provenance_CH,
                'pays_gb' => "" . $Donnees_Statistique_Provenance_GB,
                'pays_de' => "" . $Donnees_Statistique_Provenance_DE,
                'pays_ro' => "" . $Donnees_Statistique_Provenance_RO,
                'pays_us' => "" . $Donnees_Statistique_Provenance_US,
                'pays_it' => "" . $Donnees_Statistique_Provenance_IT,
                'pays_es' => "" . $Donnees_Statistique_Provenance_ES,
                'pays_pl' => "" . $Donnees_Statistique_Provenance_PL,
                'pays_pt' => "" . $Donnees_Statistique_Provenance_PT,
                'pays_tn' => "" . $Donnees_Statistique_Provenance_TN,
                'pays_dz' => "" . $Donnees_Statistique_Provenance_DZ,
                'pays_jp' => "" . $Donnees_Statistique_Provenance_JP,
                'pays_be' => "" . $Donnees_Statistique_Provenance_BE
            );
            echo json_encode($Tableau_Json);

            //$cacheManager->set("arrStatistiques".$intervalStat, json_encode($Tableau_Json));
        }
    }

}

$class = new StatistiquesGet();
$class->run();
