<?php

namespace Pages\Statistiques\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class StatistiquesGet extends \PageHelper {

    public function run() {
        
        global $request;

        $cacheManager = \CacheHelper::getCacheManager();
        $intervalStat = \Encryption::decrypt($request->request->get("page"));
        
        if ($cacheManager->isExisting("arrStatistiques" . $intervalStat)) {
            $arrStatistiques = $cacheManager->get("arrStatistiques" . $intervalStat);
            echo $arrStatistiques;
        } else {

            $nombreCompte = \Account\AccountHelper::getAccountRepository()->statAccountCreate($intervalStat);

            if ($intervalStat < 4) {
                $nombrePlayer = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat);
                $nombrePlayerHomme = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [0, 2, 5, 7]);
                $nombrePlayerFemme = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [1, 3, 4, 6]);

                $nombrePlayerShinsoo = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, "", [1]);
                $nombrePlayerChunjo = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, "", [2]);
                $nombrePlayerJinno = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, "", [3]);

                $nombrePlayerGuerrier = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [0, 4]);
                $nombrePlayerSura = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [2, 6]);
                $nombrePlayerNinja = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [1, 5]);
                $nombrePlayerShaman = \Site\SiteHelper::getLogsCreationJoueursRepository()->statPlayerCreate($intervalStat, [3, 7]);
            } else {
                $nombrePlayer = \Player\PlayerHelper::getPlayerRepository()->statPlayer();
                $nombrePlayerHomme = \Player\PlayerHelper::getPlayerRepository()->statPlayer([0, 2, 5, 7]);
                $nombrePlayerFemme = \Player\PlayerHelper::getPlayerRepository()->statPlayer([1, 3, 4, 6]);
                
                $nombrePlayerShinsoo = \Player\PlayerHelper::getPlayerRepository()->statPlayer("", [1]);
                $nombrePlayerChunjo = \Player\PlayerHelper::getPlayerRepository()->statPlayer("", [2]);
                $nombrePlayerJinno = \Player\PlayerHelper::getPlayerRepository()->statPlayer("", [3]);
                
                $nombrePlayerGuerrier = \Player\PlayerHelper::getPlayerRepository()->statPlayer([0, 4]);
                $nombrePlayerSura = \Player\PlayerHelper::getPlayerRepository()->statPlayer([2, 6]);
                $nombrePlayerNinja = \Player\PlayerHelper::getPlayerRepository()->statPlayer([1, 5]);
                $nombrePlayerShaman = \Player\PlayerHelper::getPlayerRepository()->statPlayer([3, 7]);
            }
            
            
            $nombreConnexion = \Site\SiteHelper::getLogsConnexionRepository()->statConnexions($intervalStat, 1);
            $nombreConnexionUnique = \Site\SiteHelper::getLogsConnexionRepository()->statConnexions($intervalStat, 1, true);

            $nombreMailChangement = \Site\SiteHelper::getLogsChangementMailRepository()->statChangementMails($intervalStat);
            $nombreOublieMotDePasse = \Site\SiteHelper::getLogsOublieMotDePasseRepository()->statOublieMotDePasse($intervalStat, 1);
            $nombreChangementMotDePasse = \Site\SiteHelper::getLogsChangementPasswordRepository()->statChangementMotDePasse($intervalStat);
            $nombreChangementCodeEntrepot = \Site\SiteHelper::getLogsCodeEntrepotChangementRepository()->statChangementCodeEntrepot($intervalStat);

            $nombreDeblocageYang = \Site\SiteHelper::getLogsDeblocageYangsRepository()->statDeblocageYangs($intervalStat);
            $nombreVote = \Site\SiteHelper::getVotesLogsRepository()->statVotes($intervalStat);
            $nombreAchatMarche = \Site\SiteHelper::getLogsMarcheAchatsRepository()->statMarcheAchats($intervalStat);
            $nombreDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->statDiscussions($intervalStat, false);
            $nombreDiscussionArchive = \Site\SiteHelper::getSupportDiscussionsRepository()->statDiscussions($intervalStat, true);
            $nombreMessage = \Site\SiteHelper::getSupportMessagesRepository()->statMessages($intervalStat);


            $nombreProvenanceFR = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "FRA");
            $nombreProvenanceCH = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "CHE");
            $nombreProvenanceGB = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "GBR");
            $nombreProvenanceDE = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "DEU");
            $nombreProvenanceRO = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "ROM");
            $nombreProvenanceUS = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "USA");
            $nombreProvenanceIT = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "ITA");
            $nombreProvenanceES = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "ESP");
            $nombreProvenancePL = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "POL");
            $nombreProvenancePT = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "PRT");
            $nombreProvenanceTN = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "TUN");
            $nombreProvenanceDZ = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "DZA");
            $nombreProvenanceJP = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "JPN");
            $nombreProvenanceBE = \Account\AccountHelper::getAccountRepository()->statProvenance($intervalStat, "BEL");

            $Tableau_Json = array(
                'comptes' => "" . $nombreCompte,
                'joueurs' => "" . $nombrePlayer,
                'hommes' => "" . $nombrePlayerHomme,
                'femmes' => "" . $nombrePlayerFemme,
                'shinsoo' => "" . $nombrePlayerShinsoo,
                'chunjo' => "" . $nombrePlayerChunjo,
                'jinno' => "" . $nombrePlayerJinno,
                'guerriers' => "" . $nombrePlayerGuerrier,
                'suras' => "" . $nombrePlayerSura,
                'ninjas' => "" . $nombrePlayerNinja,
                'shamans' => "" . $nombrePlayerShaman,
                'connexion_site' => "" . $nombreConnexion,
                'connexion_site_unique' => "" . $nombreConnexionUnique,
                'changement_mail' => "" . $nombreMailChangement,
                'recup_mdp' => "" . $nombreOublieMotDePasse,
                'changement_mdp' => "" . $nombreChangementMotDePasse,
                'changement_entrepot' => "" . $nombreChangementCodeEntrepot,
                'deblocage_yangs' => "" . $nombreDeblocageYang,
                'nombre_vote' => "" . $nombreVote,
                'nombre_achats_perso' => "" . $nombreAchatMarche,
                'tickets_ouvert' => "" . $nombreDiscussion,
                'message_ecrits' => "" . $nombreMessage,
                'discussion_archives' => "" . $nombreDiscussionArchive,
                'pays_fr' => "" . $nombreProvenanceFR,
                'pays_ch' => "" . $nombreProvenanceCH,
                'pays_gb' => "" . $nombreProvenanceGB,
                'pays_de' => "" . $nombreProvenanceDE,
                'pays_ro' => "" . $nombreProvenanceRO,
                'pays_us' => "" . $nombreProvenanceUS,
                'pays_it' => "" . $nombreProvenanceIT,
                'pays_es' => "" . $nombreProvenanceES,
                'pays_pl' => "" . $nombreProvenancePL,
                'pays_pt' => "" . $nombreProvenancePT,
                'pays_tn' => "" . $nombreProvenanceTN,
                'pays_dz' => "" . $nombreProvenanceDZ,
                'pays_jp' => "" . $nombreProvenanceJP,
                'pays_be' => "" . $nombreProvenanceBE
            );
                        
            echo json_encode($Tableau_Json);
            $cacheManager->set("arrStatistiques".$intervalStat, json_encode($Tableau_Json), 21600);
        }
    }

}

$class = new StatistiquesGet();
$class->run();
