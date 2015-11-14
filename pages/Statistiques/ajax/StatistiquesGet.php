<?php

namespace Pages\Statistiques\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class StatistiquesGet extends \PageHelper {

    public function run() {

        $cacheManager = \CacheHelper::getCacheManager();
        $intervalStat = $_POST["id_statistique"];

        if ($intervalStat == 1) {
            $Intervalle = "Jour";
        } else if ($intervalStat == 2) {
            $Intervalle = "Semaine";
        } else if ($intervalStat == 3) {
            $Intervalle = "Mois";
        } else if ($intervalStat == 4) {
            $Intervalle = "Toujours";
        }

        if ($cacheManager->isExisting("arrStatistiques".$Intervalle)) {
            $arrStatistiques = $cacheManager->get("arrStatistiques".$Intervalle);
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

            /* --------------- Nombre Changement Code Entrepot -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM site.logs_code_entrepot_changement
                                                         WHERE logs_code_entrepot_changement.date >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM site.logs_code_entrepot_changement
                                                         WHERE YEARWEEK(logs_code_entrepot_changement.date) = YEARWEEK(CURRENT_DATE)
                                                         AND MONTH(logs_code_entrepot_changement.date) = MONTH(NOW())";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM site.logs_code_entrepot_changement
                                                         WHERE MONTH(logs_code_entrepot_changement.date) = MONTH(NOW())
                                                         AND YEAR(logs_code_entrepot_changement.date) = YEAR(NOW())";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM site.logs_code_entrepot_changement";
            }
            $Parametres_Statistique_Nombres_Changement_Code_Entrepot = $this->objConnection->prepare($Statistique_Nombres_Changement_Code_Entrepot);
            $Parametres_Statistique_Nombres_Changement_Code_Entrepot->execute(array($intervalStat));
            $Parametres_Statistique_Nombres_Changement_Code_Entrepot->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Nombres_Changement_Code_Entrepot = $Parametres_Statistique_Nombres_Changement_Code_Entrepot->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------- Nombre Deblocage Yangs -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM site.logs_deblocage_yangs
                                                WHERE logs_deblocage_yangs.date >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM site.logs_deblocage_yangs
                                                WHERE YEARWEEK(logs_deblocage_yangs.date) = YEARWEEK(CURRENT_DATE)
                                                AND MONTH(logs_deblocage_yangs.date) = MONTH(NOW())";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM site.logs_deblocage_yangs
                                                WHERE MONTH(logs_deblocage_yangs.date) = MONTH(NOW())
                                                AND YEAR(logs_deblocage_yangs.date) = YEAR(NOW())";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM site.logs_deblocage_yangs";
            }
            $Parametres_Statistique_Nombres_Deblocage_Yangs = $this->objConnection->prepare($Statistique_Nombres_Deblocage_Yangs);
            $Parametres_Statistique_Nombres_Deblocage_Yangs->execute(array($intervalStat));
            $Parametres_Statistique_Nombres_Deblocage_Yangs->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Nombres_Deblocage_Yangs = $Parametres_Statistique_Nombres_Deblocage_Yangs->fetch();
            /* ----------------------------------------------------------------------------------------------- */


            /* --------------- Nombre Vote -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM site.votes_logs
                                      WHERE votes_logs.date >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM site.votes_logs
                                      WHERE YEARWEEK(votes_logs.date) = YEARWEEK(CURRENT_DATE)
                                      AND MONTH(votes_logs.date) = MONTH(NOW())";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM site.votes_logs
                                      WHERE MONTH(votes_logs.date) = MONTH(NOW())
                                      AND YEAR(votes_logs.date) = YEAR(NOW())";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM site.votes_logs";
            }
            $Parametres_Statistique_Nombres_Votes = $this->objConnection->prepare($Statistique_Nombres_Votes);
            $Parametres_Statistique_Nombres_Votes->execute(array($intervalStat));
            $Parametres_Statistique_Nombres_Votes->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Nombres_Vote = $Parametres_Statistique_Nombres_Votes->fetch();
            /* ----------------------------------------------------------------------------------------------- */


            /* --------------- Nombre Vote -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM site.logs_marche_achats
                                             WHERE logs_marche_achats.date >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM site.logs_marche_achats
                                             WHERE YEARWEEK(logs_marche_achats.date) = YEARWEEK(CURRENT_DATE)
                                             AND MONTH(logs_marche_achats.date) = MONTH(NOW())";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM site.logs_marche_achats
                                             WHERE MONTH(logs_marche_achats.date) = MONTH(NOW())
                                             AND YEAR(logs_marche_achats.date) = YEAR(NOW())";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM site.logs_marche_achats";
            }
            $Parametres_Nombres_Achats_Perso = $this->objConnection->prepare($Statistique_Nombres_Achats_Perso);
            $Parametres_Nombres_Achats_Perso->execute(array($intervalStat));
            $Parametres_Nombres_Achats_Perso->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Nombres_Achat_Persos = $Parametres_Nombres_Achats_Perso->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------- Nombre Tickets Ouverts -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM site.support_ticket_traitement
                                                WHERE support_ticket_traitement.date >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM site.support_ticket_traitement
                                                WHERE YEARWEEK(support_ticket_traitement.date) = YEARWEEK(CURRENT_DATE)
                                                AND MONTH(support_ticket_traitement.date) = MONTH(NOW())";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM site.support_ticket_traitement
                                                WHERE MONTH(support_ticket_traitement.date) = MONTH(NOW())
                                                AND YEAR(support_ticket_traitement.date) = YEAR(NOW())";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM site.support_ticket_traitement";
            }
            $Parametres_Statistique_Nombres_Tickets_Ouverts = $this->objConnection->prepare($Statistique_Nombres_Tickets_Ouverts);
            $Parametres_Statistique_Nombres_Tickets_Ouverts->execute(array($intervalStat));
            $Parametres_Statistique_Nombres_Tickets_Ouverts->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Nombres_Tickets_Ouverts = $Parametres_Statistique_Nombres_Tickets_Ouverts->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------- Nombre Message Envoyés -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM site.support_ticket_traitement
                                                 WHERE support_ticket_traitement.date >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM site.support_ticket_traitement
                                                 WHERE YEARWEEK(support_ticket_traitement.date) = YEARWEEK(CURRENT_DATE)
                                                 AND MONTH(support_ticket_traitement.date) = MONTH(NOW())";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM site.support_ticket_traitement
                                                 WHERE MONTH(support_ticket_traitement.date) = MONTH(NOW())
                                                 AND YEAR(support_ticket_traitement.date) = YEAR(NOW())";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM site.support_ticket_traitement";
            }
            $Parametres_Statistique_Nombres_Messages_Envoyes = $this->objConnection->prepare($Statistique_Nombres_Messages_Envoyes);
            $Parametres_Statistique_Nombres_Messages_Envoyes->execute(array($intervalStat));
            $Parametres_Statistique_Nombres_Messages_Envoyes->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Nombres_Messages_Envoyes = $Parametres_Statistique_Nombres_Messages_Envoyes->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------- Nombre Dicussion Archivés -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM site.support_ticket_archives
                                                     WHERE support_ticket_archives.date >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM site.support_ticket_archives
                                                     WHERE YEARWEEK(support_ticket_archives.date) = YEARWEEK(CURRENT_DATE)
                                                     AND MONTH(support_ticket_archives.date) = MONTH(NOW())";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM site.support_ticket_archives
                                                     WHERE MONTH(support_ticket_archives.date) = MONTH(NOW())
                                                     AND YEAR(support_ticket_archives.date) = YEAR(NOW())";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM site.support_ticket_archives";
            }
            $Parametres_Statistique_Nombres_Discussions_Archives = $this->objConnection->prepare($Statistique_Nombres_Discussions_Archives);
            $Parametres_Statistique_Nombres_Discussions_Archives->execute(array($intervalStat));
            $Parametres_Statistique_Nombres_Discussions_Archives->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Nombres_Discussions_Archives = $Parametres_Statistique_Nombres_Discussions_Archives->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------- Nombre Provenance -------------------------------------------------------- */
            if ($Intervalle == "Jour") {
                $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM account.account
                                                     WHERE langue = ?
                                                     AND account.create_time >= CURDATE()";
            } else if ($Intervalle == "Semaine") {
                $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM account.account
                                                     WHERE YEARWEEK(account.create_time) = YEARWEEK(CURRENT_DATE)
                                                     AND MONTH(account.create_time) = MONTH(NOW())
                                                     AND langue = ?";
            } else if ($Intervalle == "Mois") {
                $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM account.account
                                                     WHERE MONTH(account.create_time) = MONTH(NOW())
                                                     AND YEAR(account.create_time) = YEAR(NOW())
                                                     AND langue = ?";
            } else if ($Intervalle == "Toujours") {
                $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM account.account
                                                     WHERE langue = ?";
            }
            $Parametres_Statistique_Nombres_Provenance = $this->objConnection->prepare($Statistique_Nombres_Provenance);
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- France ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("FRA"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_FR = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Suisse ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("CHE"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_CH = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Grande Bretagne ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("GBR"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_GB = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Allemagne ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("DEU"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_DE = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Roumanie ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("ROM"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_RO = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- USA ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("USA"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_US = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Italie ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("ITA"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_IT = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Espagne ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("ESP"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_ES = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Pologne ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("POL"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_PL = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Portugal ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("PRT"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_PT = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Tunisie ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("TUN"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_TN = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Algerie ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("DZA"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_DZ = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Japon ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("JPN"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_JP = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

            /* --------------------------------------- Belgique ---------------------------------------- */
            $Parametres_Statistique_Nombres_Provenance->execute(array("BEL"));
            $Parametres_Statistique_Nombres_Provenance->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Statistique_Provenance_BE = $Parametres_Statistique_Nombres_Provenance->fetch();
            /* ----------------------------------------------------------------------------------------------- */

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
                'changement_entrepot' => "" . $Donnees_Statistique_Nombres_Changement_Code_Entrepot->nombre,
                'deblocage_yangs' => "" . $Donnees_Statistique_Nombres_Deblocage_Yangs->nombre,
                'nombre_vote' => "" . $Donnees_Statistique_Nombres_Vote->nombre,
                'nombre_achats_perso' => "" . $Donnees_Statistique_Nombres_Achat_Persos->nombre,
                'tickets_ouvert' => "" . $Donnees_Statistique_Nombres_Tickets_Ouverts->nombre,
                'message_ecrits' => "" . $Donnees_Statistique_Nombres_Messages_Envoyes->nombre,
                'discussion_archives' => "" . $Donnees_Statistique_Nombres_Discussions_Archives->nombre,
                'pays_fr' => "" . $Donnees_Statistique_Provenance_FR->nombre,
                'pays_ch' => "" . $Donnees_Statistique_Provenance_CH->nombre,
                'pays_gb' => "" . $Donnees_Statistique_Provenance_GB->nombre,
                'pays_de' => "" . $Donnees_Statistique_Provenance_DE->nombre,
                'pays_ro' => "" . $Donnees_Statistique_Provenance_RO->nombre,
                'pays_us' => "" . $Donnees_Statistique_Provenance_US->nombre,
                'pays_it' => "" . $Donnees_Statistique_Provenance_IT->nombre,
                'pays_es' => "" . $Donnees_Statistique_Provenance_ES->nombre,
                'pays_pl' => "" . $Donnees_Statistique_Provenance_PL->nombre,
                'pays_pt' => "" . $Donnees_Statistique_Provenance_PT->nombre,
                'pays_tn' => "" . $Donnees_Statistique_Provenance_TN->nombre,
                'pays_dz' => "" . $Donnees_Statistique_Provenance_DZ->nombre,
                'pays_jp' => "" . $Donnees_Statistique_Provenance_JP->nombre,
                'pays_be' => "" . $Donnees_Statistique_Provenance_BE->nombre
            );
            echo json_encode($Tableau_Json);

            //$cacheManager->set("arrStatistiques".$Intervalle, json_encode($Tableau_Json));
        }
    }

}

$class = new StatistiquesGet();
$class->run();
