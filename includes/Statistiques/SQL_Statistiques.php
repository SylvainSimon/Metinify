<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php

$Id_Statistique = $_POST["id_statistique"];

if ($Id_Statistique == 1) {
    $Intervalle = "Jour";
} else if ($Id_Statistique == 2) {
    $Intervalle = "Semaine";
} else if ($Id_Statistique == 3) {
    $Intervalle = "Mois";
} else if ($Id_Statistique == 4) {
    $Intervalle = "Toujours";
}

$Verification_Interval_Statistique = "SELECT COUNT(id) AS resultat_interval 
                                      FROM $BDD_Site.statistiques_tampon
                                      WHERE type_stati = ?
                                      AND date_insertion > (NOW() - INTERVAL 1 HOUR)";
$Parametres_Verification_Interval_Statistique = $Connexion->prepare($Verification_Interval_Statistique);
$Parametres_Verification_Interval_Statistique->execute(array($Id_Statistique));
$Parametres_Verification_Interval_Statistique->setFetchMode(PDO::FETCH_OBJ);
$Donnees_Verification_Interval_Statistique = $Parametres_Verification_Interval_Statistique->fetch();
if ($Donnees_Verification_Interval_Statistique->resultat_interval != 0) {

    $Recuperation_Donnees_Statistiques = "SELECT * 
                                          FROM $BDD_Site.statistiques_tampon
                                          WHERE type_stati = ?";
    $Parametres_Recuperation_Donnees_Statistiques = $Connexion->prepare($Recuperation_Donnees_Statistiques);
    $Parametres_Recuperation_Donnees_Statistiques->execute(array($Id_Statistique));
    $Parametres_Recuperation_Donnees_Statistiques->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Recuperation_Donnees_Statistiques = $Parametres_Recuperation_Donnees_Statistiques->fetch();

    $Tableau_Json = array(
        'comptes' => "" . $Donnees_Recuperation_Donnees_Statistiques->comptes,
        'joueurs' => "" . $Donnees_Recuperation_Donnees_Statistiques->joueurs,
        'hommes' => "" . $Donnees_Recuperation_Donnees_Statistiques->hommes,
        'femmes' => "" . $Donnees_Recuperation_Donnees_Statistiques->femmes,
        'shinsoo' => "" . $Donnees_Recuperation_Donnees_Statistiques->shinsoo,
        'chunjo' => "" . $Donnees_Recuperation_Donnees_Statistiques->chunjo,
        'jinno' => "" . $Donnees_Recuperation_Donnees_Statistiques->jinno,
        'guerriers' => "" . $Donnees_Recuperation_Donnees_Statistiques->guerriers,
        'suras' => "" . $Donnees_Recuperation_Donnees_Statistiques->suras,
        'ninjas' => "" . $Donnees_Recuperation_Donnees_Statistiques->ninjas,
        'shamans' => "" . $Donnees_Recuperation_Donnees_Statistiques->shamans,
        'connexion_site' => "" . $Donnees_Recuperation_Donnees_Statistiques->connexion_site,
        'connexion_site_unique' => "" . $Donnees_Recuperation_Donnees_Statistiques->connexion_site_unique,
        'changement_mail' => "" . $Donnees_Recuperation_Donnees_Statistiques->changement_mail,
        'recup_mdp' => "" . $Donnees_Recuperation_Donnees_Statistiques->recup_mdp,
        'changement_mdp' => "" . $Donnees_Recuperation_Donnees_Statistiques->changement_mdp,
        'changement_entrepot' => "" . $Donnees_Recuperation_Donnees_Statistiques->changement_entrepot,
        'deblocage_yangs' => "" . $Donnees_Recuperation_Donnees_Statistiques->deblocage_yangs,
        'nombre_vote' => "" . $Donnees_Recuperation_Donnees_Statistiques->nombre_vote,
        'nombre_achats_perso' => "" . $Donnees_Recuperation_Donnees_Statistiques->nombre_achats_perso,
        'tickets_ouvert' => "" . $Donnees_Recuperation_Donnees_Statistiques->tickets_ouvert,
        'message_ecrits' => "" . $Donnees_Recuperation_Donnees_Statistiques->message_ecrits,
        'discussion_archives' => "" . $Donnees_Recuperation_Donnees_Statistiques->discussion_archives,
        
        'pays_fr' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_fr,
        'pays_ch' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_ch,
        'pays_gb' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_gb,
        'pays_de' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_de,
        'pays_ro' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_ro,
        'pays_us' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_us,
        'pays_it' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_it,
        'pays_es' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_es,
        'pays_pl' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_pl,
        'pays_pt' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_pt,
        'pays_tn' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_tn,
        'pays_dz' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_dz,
        'pays_jp' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_jp,
        'pays_be' => "" . $Donnees_Recuperation_Donnees_Statistiques->pays_be
    );

    echo json_encode($Tableau_Json);
} else {

    /* --------------- Nombre de Comptes -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Comptes = "SELECT COUNT(*) AS nombre 
                                        FROM $BDD_Account.account
                                        WHERE account.create_time >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Comptes = "SELECT COUNT(*) AS nombre 
                                        FROM $BDD_Account.account
                                        WHERE YEARWEEK(account.create_time) = YEARWEEK(CURRENT_DATE)
                                        AND MONTH(account.create_time) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Comptes = "SELECT COUNT(*) AS nombre 
                                        FROM $BDD_Account.account
                                        WHERE MONTH(account.create_time) = MONTH(NOW())
                                        AND YEAR(account.create_time) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Comptes = "SELECT COUNT(*) AS nombre 
                                        FROM $BDD_Account.account";
    }
    $Parametres_Statistique_Nombres_Comptes = $Connexion->prepare($Statistique_Nombres_Comptes);
    $Parametres_Statistique_Nombres_Comptes->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Comptes->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Comptes = $Parametres_Statistique_Nombres_Comptes->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre de Joueurs -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Joueurs = "SELECT COUNT(id) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs
                                        WHERE logs_creation_joueurs.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Joueurs = "SELECT COUNT(id) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs
                                        WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                        AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Joueurs = "SELECT COUNT(id) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs
                                        WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                        AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Joueurs = "SELECT COUNT(id) AS nombre 
                                        FROM $BDD_Player.player";
    }
    $Parametres_Statistique_Nombres_Joueurs = $Connexion->prepare($Statistique_Nombres_Joueurs);
    $Parametres_Statistique_Nombres_Joueurs->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Joueurs->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Joueurs = $Parametres_Statistique_Nombres_Joueurs->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre d'Homme -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Hommes = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE logs_creation_joueurs.date >= CURDATE()
                                       AND (player.job LIKE '0' 
                                       OR player.job LIKE '2' 
                                       OR player.job LIKE '5' 
                                       OR player.job LIKE '7')";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Hommes = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                       AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND (player.job LIKE '0' 
                                       OR player.job LIKE '2' 
                                       OR player.job LIKE '5' 
                                       OR player.job LIKE '7')";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Hommes = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                       AND (player.job LIKE '0' 
                                       OR player.job LIKE '2' 
                                       OR player.job LIKE '5' 
                                       OR player.job LIKE '7')";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Hommes = "SELECT COUNT(player.id) AS nombre 
                                       FROM $BDD_Player.player
                                       WHERE (player.job LIKE '0' 
                                       OR player.job LIKE '2' 
                                       OR player.job LIKE '5' 
                                       OR player.job LIKE '7')";
    }
    $Parametres_Statistique_Nombres_Hommes = $Connexion->prepare($Statistique_Nombres_Hommes);
    $Parametres_Statistique_Nombres_Hommes->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Hommes->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Hommes = $Parametres_Statistique_Nombres_Hommes->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Femmes -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Femmes = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE logs_creation_joueurs.date >= CURDATE()
                                       AND (player.job LIKE '1' 
                                       OR player.job LIKE '3' 
                                       OR player.job LIKE '4' 
                                       OR player.job LIKE '6')";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Femmes = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                       AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND (player.job LIKE '1' 
                                       OR player.job LIKE '3' 
                                       OR player.job LIKE '4' 
                                       OR player.job LIKE '6')";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Femmes = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                       AND (player.job LIKE '1' 
                                       OR player.job LIKE '3' 
                                       OR player.job LIKE '4' 
                                       OR player.job LIKE '6')";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Femmes = "SELECT COUNT(player.id) AS nombre 
                                       FROM $BDD_Player.player
                                       WHERE (player.job LIKE '1' 
                                       OR player.job LIKE '3' 
                                       OR player.job LIKE '4' 
                                       OR player.job LIKE '6')";
    }
    $Parametres_Statistique_Nombres_Femmes = $Connexion->prepare($Statistique_Nombres_Femmes);
    $Parametres_Statistique_Nombres_Femmes->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Femmes->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Femmes = $Parametres_Statistique_Nombres_Femmes->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Shinsoo -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Shinsoo = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                        WHERE logs_creation_joueurs.date >= CURDATE()
                                        AND player_index.empire = '1'
                                        AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                        OR player_index.pid2 = logs_creation_joueurs.id_perso
                                        OR player_index.pid3 = logs_creation_joueurs.id_perso
                                        OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Shinsoo = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                        WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                        AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                        AND player_index.empire = '1'
                                        AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                        OR player_index.pid2 = logs_creation_joueurs.id_perso
                                        OR player_index.pid3 = logs_creation_joueurs.id_perso
                                        OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Shinsoo = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                        WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                        AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                        AND player_index.empire = '1'
                                        AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                        OR player_index.pid2 = logs_creation_joueurs.id_perso
                                        OR player_index.pid3 = logs_creation_joueurs.id_perso
                                        OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Shinsoo = "SELECT COUNT(*) AS nombre
                                        FROM
                                        (
                                        SELECT player.id 
                                        FROM player.player, player.player_index
                                        WHERE player_index.empire = '1'
                                        AND (player_index.pid1 = player.id) UNION ALL
                                        
                                        SELECT player.id AS nombre 
                                        FROM player.player, player.player_index
                                        WHERE player_index.empire = '1'
                                        AND (player_index.pid2 = player.id) UNION ALL
                                        
                                        SELECT player.id AS nombre 
                                        FROM player.player, player.player_index
                                        WHERE player_index.empire = '1'
                                        AND (player_index.pid3 = player.id) UNION ALL
                                        
                                        SELECT player.id AS nombre 
                                        FROM player.player, player.player_index
                                        WHERE player_index.empire = '1'
                                        AND (player_index.pid4 = player.id)
                                        ) AS nombre";
    }
    $Parametres_Statistique_Nombres_Shinsoo = $Connexion->prepare($Statistique_Nombres_Shinsoo);
    $Parametres_Statistique_Nombres_Shinsoo->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Shinsoo->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Shinsoo = $Parametres_Statistique_Nombres_Shinsoo->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Chunjo -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Chunjo = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                       WHERE logs_creation_joueurs.date >= CURDATE()
                                       AND player_index.empire = '2'
                                       AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                       OR player_index.pid2 = logs_creation_joueurs.id_perso
                                       OR player_index.pid3 = logs_creation_joueurs.id_perso
                                       OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Chunjo = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                       WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                       AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND player_index.empire = '2'
                                       AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                       OR player_index.pid2 = logs_creation_joueurs.id_perso
                                       OR player_index.pid3 = logs_creation_joueurs.id_perso
                                       OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Chunjo = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                       WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                       AND player_index.empire = '2'
                                       AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                       OR player_index.pid2 = logs_creation_joueurs.id_perso
                                       OR player_index.pid3 = logs_creation_joueurs.id_perso
                                       OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Chunjo = "SELECT COUNT(*) AS nombre
                                       FROM
                                       (
                                       SELECT player.id 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '2'
                                       AND (player_index.pid1 = player.id) UNION ALL
                                       
                                       SELECT player.id AS nombre 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '2'
                                       AND (player_index.pid2 = player.id) UNION ALL
                                       
                                       SELECT player.id AS nombre 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '2'
                                       AND (player_index.pid3 = player.id) UNION ALL
                                       
                                       SELECT player.id AS nombre 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '2'
                                       AND (player_index.pid4 = player.id)
                                       ) AS nombre";
    }
    $Parametres_Statistique_Nombres_Chunjo = $Connexion->prepare($Statistique_Nombres_Chunjo);
    $Parametres_Statistique_Nombres_Chunjo->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Chunjo->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Chunjo = $Parametres_Statistique_Nombres_Chunjo->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Jinno -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Jinno = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                       WHERE logs_creation_joueurs.date >= CURDATE()
                                       AND player_index.empire = '3'
                                       AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                       OR player_index.pid2 = logs_creation_joueurs.id_perso
                                       OR player_index.pid3 = logs_creation_joueurs.id_perso
                                       OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Jinno = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                       WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                       AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND player_index.empire = '3'
                                       AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                       OR player_index.pid2 = logs_creation_joueurs.id_perso
                                       OR player_index.pid3 = logs_creation_joueurs.id_perso
                                       OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Jinno = "SELECT COUNT(logs_creation_joueurs.id) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs, $BDD_Player.player_index
                                       WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                       AND player_index.empire = '3'
                                       AND (player_index.pid1 = logs_creation_joueurs.id_perso
                                       OR player_index.pid2 = logs_creation_joueurs.id_perso
                                       OR player_index.pid3 = logs_creation_joueurs.id_perso
                                       OR player_index.pid4 = logs_creation_joueurs.id_perso)";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Jinno = "SELECT COUNT(*) AS nombre
                                       FROM
                                       (
                                       SELECT player.id 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '3'
                                       AND (player_index.pid1 = player.id) UNION ALL
                                       
                                       SELECT player.id AS nombre 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '3'
                                       AND (player_index.pid2 = player.id) UNION ALL
                                       
                                       SELECT player.id AS nombre 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '3'
                                       AND (player_index.pid3 = player.id) UNION ALL
                                       
                                       SELECT player.id AS nombre 
                                       FROM player.player, player.player_index
                                       WHERE player_index.empire = '3'
                                       AND (player_index.pid4 = player.id)
                                       ) AS nombre";
    }
    $Parametres_Statistique_Nombres_Jinno = $Connexion->prepare($Statistique_Nombres_Jinno);
    $Parametres_Statistique_Nombres_Jinno->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Jinno->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Jinno = $Parametres_Statistique_Nombres_Jinno->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Guerriers -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Guerriers = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                          FROM $BDD_Site.logs_creation_joueurs
                                          LEFT JOIN $BDD_Player.player
                                          ON player.id = logs_creation_joueurs.id_perso
                                          WHERE logs_creation_joueurs.date >= CURDATE()
                                          AND (player.job LIKE '0' 
                                          OR player.job LIKE '4')";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Guerriers = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                          FROM $BDD_Site.logs_creation_joueurs
                                          LEFT JOIN $BDD_Player.player
                                          ON player.id = logs_creation_joueurs.id_perso
                                          WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                          AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                          AND (player.job LIKE '0' 
                                          OR player.job LIKE '4')";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Guerriers = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                          FROM $BDD_Site.logs_creation_joueurs
                                          LEFT JOIN $BDD_Player.player
                                          ON player.id = logs_creation_joueurs.id_perso
                                          WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                          AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                          AND (player.job LIKE '0' 
                                          OR player.job LIKE '4')";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Guerriers = "SELECT COUNT(player.id) AS nombre 
                                          FROM $BDD_Player.player
                                          WHERE (player.job LIKE '0' 
                                          OR player.job LIKE '4')";
    }
    $Parametres_Statistique_Nombres_Guerriers = $Connexion->prepare($Statistique_Nombres_Guerriers);
    $Parametres_Statistique_Nombres_Guerriers->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Guerriers->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Guerriers = $Parametres_Statistique_Nombres_Guerriers->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Suras -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Suras = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                      FROM $BDD_Site.logs_creation_joueurs
                                      LEFT JOIN $BDD_Player.player
                                      ON player.id = logs_creation_joueurs.id_perso
                                      WHERE logs_creation_joueurs.date >= CURDATE()
                                      AND (player.job LIKE '2' 
                                      OR player.job LIKE '6')";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Suras = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                      FROM $BDD_Site.logs_creation_joueurs
                                      LEFT JOIN $BDD_Player.player
                                      ON player.id = logs_creation_joueurs.id_perso
                                      WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                      AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                      AND (player.job LIKE '2' 
                                      OR player.job LIKE '6')";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Suras = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                      FROM $BDD_Site.logs_creation_joueurs
                                      LEFT JOIN $BDD_Player.player
                                      ON player.id = logs_creation_joueurs.id_perso
                                      WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                      AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                      AND (player.job LIKE '2' 
                                      OR player.job LIKE '6')";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Suras = "SELECT COUNT(player.id) AS nombre 
                                      FROM $BDD_Player.player
                                      WHERE (player.job LIKE '2' 
                                      OR player.job LIKE '6')";
    }
    $Parametres_Statistique_Nombres_Suras = $Connexion->prepare($Statistique_Nombres_Suras);
    $Parametres_Statistique_Nombres_Suras->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Suras->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Suras = $Parametres_Statistique_Nombres_Suras->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Ninjas -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Ninjas = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE logs_creation_joueurs.date >= CURDATE()
                                       AND (player.job LIKE '1' 
                                       OR player.job LIKE '5')";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Ninjas = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                       AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND (player.job LIKE '1' 
                                       OR player.job LIKE '5')";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Ninjas = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                       FROM $BDD_Site.logs_creation_joueurs
                                       LEFT JOIN $BDD_Player.player
                                       ON player.id = logs_creation_joueurs.id_perso
                                       WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                       AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                       AND (player.job LIKE '1' 
                                       OR player.job LIKE '5')";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Ninjas = "SELECT COUNT(player.id) AS nombre 
                                       FROM $BDD_Player.player
                                       WHERE (player.job LIKE '1' 
                                       OR player.job LIKE '5')";
    }
    $Parametres_Statistique_Nombres_Ninjas = $Connexion->prepare($Statistique_Nombres_Ninjas);
    $Parametres_Statistique_Nombres_Ninjas->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Ninjas->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Ninjas = $Parametres_Statistique_Nombres_Ninjas->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Shamans -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Shamans = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs
                                        LEFT JOIN $BDD_Player.player
                                        ON player.id = logs_creation_joueurs.id_perso
                                        WHERE logs_creation_joueurs.date >= CURDATE()
                                        AND (player.job LIKE '3' 
                                        OR player.job LIKE '7')";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Shamans = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs
                                        LEFT JOIN $BDD_Player.player
                                        ON player.id = logs_creation_joueurs.id_perso
                                        WHERE YEARWEEK(logs_creation_joueurs.date) = YEARWEEK(CURRENT_DATE)
                                        AND MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                        AND (player.job LIKE '3' 
                                        OR player.job LIKE '7')";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Shamans = "SELECT COUNT(logs_creation_joueurs.id_perso) AS nombre 
                                        FROM $BDD_Site.logs_creation_joueurs
                                        LEFT JOIN $BDD_Player.player
                                        ON player.id = logs_creation_joueurs.id_perso
                                        WHERE MONTH(logs_creation_joueurs.date) = MONTH(NOW())
                                        AND YEAR(logs_creation_joueurs.date) = YEAR(NOW())
                                        AND (player.job LIKE '3' 
                                        OR player.job LIKE '7')";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Shamans = "SELECT COUNT(player.id) AS nombre 
                                        FROM $BDD_Player.player
                                        WHERE (player.job LIKE '3' 
                                        OR player.job LIKE '7')";
    }
    $Parametres_Statistique_Nombres_Shamans = $Connexion->prepare($Statistique_Nombres_Shamans);
    $Parametres_Statistique_Nombres_Shamans->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Shamans->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Shamans = $Parametres_Statistique_Nombres_Shamans->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Connexion -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Connexion = "SELECT COUNT(id) AS nombre 
                                          FROM $BDD_Site.logs_connexion
                                          WHERE logs_connexion.date >= CURDATE()
                                          AND resultat = 1";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Connexion = "SELECT COUNT(id) AS nombre 
                                          FROM $BDD_Site.logs_connexion
                                          WHERE YEARWEEK(logs_connexion.date) = YEARWEEK(CURRENT_DATE)
                                          AND MONTH(logs_connexion.date) = MONTH(NOW())
                                          AND resultat = 1";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Connexion = "SELECT COUNT(id) AS nombre 
                                          FROM $BDD_Site.logs_connexion
                                          WHERE MONTH(logs_connexion.date) = MONTH(NOW())
                                          AND YEAR(logs_connexion.date) = YEAR(NOW())
                                          AND resultat = 1";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Connexion = "SELECT COUNT(id) AS nombre 
                                          FROM $BDD_Site.logs_connexion
                                          WHERE resultat = 1";
    }
    $Parametres_Statistique_Nombres_Connexion = $Connexion->prepare($Statistique_Nombres_Connexion);
    $Parametres_Statistique_Nombres_Connexion->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Connexion->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Connexion = $Parametres_Statistique_Nombres_Connexion->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Connexion Unique -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Connexion_Unique = "SELECT COUNT(DISTINCT ip) AS nombre 
                                                 FROM $BDD_Site.logs_connexion
                                                 WHERE logs_connexion.date >= CURDATE()
                                                 AND resultat = 1";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Connexion_Unique = "SELECT COUNT(DISTINCT ip) AS nombre 
                                                 FROM $BDD_Site.logs_connexion
                                                 WHERE YEARWEEK(logs_connexion.date) = YEARWEEK(CURRENT_DATE)
                                                 AND MONTH(logs_connexion.date) = MONTH(NOW())
                                                 AND resultat = 1";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Connexion_Unique = "SELECT COUNT(DISTINCT ip) AS nombre 
                                                 FROM $BDD_Site.logs_connexion
                                                 WHERE MONTH(logs_connexion.date) = MONTH(NOW())
                                                 AND YEAR(logs_connexion.date) = YEAR(NOW())
                                                 AND resultat = 1";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Connexion_Unique = "SELECT COUNT(DISTINCT ip) AS nombre 
                                                 FROM $BDD_Site.logs_connexion
                                                 WHERE resultat = 1";
    }
    $Parametres_Statistique_Nombres_Connexion_Unique = $Connexion->prepare($Statistique_Nombres_Connexion_Unique);
    $Parametres_Statistique_Nombres_Connexion_Unique->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Connexion_Unique->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Connexion_Unique = $Parametres_Statistique_Nombres_Connexion_Unique->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Changement Mail -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Changement_Mail = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_changement_mail
                                                WHERE logs_changement_mail.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Changement_Mail = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_changement_mail
                                                WHERE YEARWEEK(logs_changement_mail.date) = YEARWEEK(CURRENT_DATE)
                                                AND MONTH(logs_changement_mail.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Changement_Mail = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_changement_mail
                                                WHERE MONTH(logs_changement_mail.date) = MONTH(NOW())
                                                AND YEAR(logs_changement_mail.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Changement_Mail = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_changement_mail";
    }
    $Parametres_Nombres_Changement_Mail = $Connexion->prepare($Statistique_Nombres_Changement_Mail);
    $Parametres_Nombres_Changement_Mail->execute(array($Id_Statistique));
    $Parametres_Nombres_Changement_Mail->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Nombres_Changement_Mail = $Parametres_Nombres_Changement_Mail->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Recup MDP -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Recuperation_MDP = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_oublie_mot_de_passe
                                                WHERE logs_oublie_mot_de_passe.date_essai >= CURDATE()
                                                AND resultat_demande = 1";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Recuperation_MDP = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_oublie_mot_de_passe
                                                WHERE YEARWEEK(logs_oublie_mot_de_passe.date_essai) = YEARWEEK(CURRENT_DATE)
                                                AND MONTH(logs_oublie_mot_de_passe.date_essai) = MONTH(NOW())
                                                AND resultat_demande = 1";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Recuperation_MDP = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_oublie_mot_de_passe
                                                WHERE MONTH(logs_oublie_mot_de_passe.date_essai) = MONTH(NOW())
                                                AND YEAR(logs_oublie_mot_de_passe.date_essai) = YEAR(NOW())
                                                AND resultat_demande = 1";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Recuperation_MDP = "SELECT COUNT(id) AS nombre 
                                                 FROM $BDD_Site.logs_oublie_mot_de_passe
                                                 WHERE resultat_demande = 1";
    }
    $Parametres_Statistique_Nombres_Recuperation_MDP = $Connexion->prepare($Statistique_Nombres_Recuperation_MDP);
    $Parametres_Statistique_Nombres_Recuperation_MDP->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Recuperation_MDP->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Recuperation_MDP = $Parametres_Statistique_Nombres_Recuperation_MDP->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Changement MDP -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Changement_MDP = "SELECT COUNT(id) AS nombre 
                                               FROM $BDD_Site.logs_changement_mot_de_passe
                                               WHERE logs_changement_mot_de_passe.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Changement_MDP = "SELECT COUNT(id) AS nombre 
                                               FROM $BDD_Site.logs_changement_mot_de_passe
                                               WHERE YEARWEEK(logs_changement_mot_de_passe.date) = YEARWEEK(CURRENT_DATE)
                                               AND MONTH(logs_changement_mot_de_passe.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Changement_MDP = "SELECT COUNT(id) AS nombre 
                                               FROM $BDD_Site.logs_changement_mot_de_passe
                                               WHERE MONTH(logs_changement_mot_de_passe.date) = MONTH(NOW())
                                               AND YEAR(logs_changement_mot_de_passe.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Changement_MDP = "SELECT COUNT(id) AS nombre 
                                               FROM $BDD_Site.logs_changement_mot_de_passe";
    }
    $Parametres_Statistique_Nombres_Changement_MDP = $Connexion->prepare($Statistique_Nombres_Changement_MDP);
    $Parametres_Statistique_Nombres_Changement_MDP->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Changement_MDP->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Changement_MDP = $Parametres_Statistique_Nombres_Changement_MDP->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Changement Code Entrepot -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM $BDD_Site.logs_code_entrepot_changement
                                                         WHERE logs_code_entrepot_changement.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM $BDD_Site.logs_code_entrepot_changement
                                                         WHERE YEARWEEK(logs_code_entrepot_changement.date) = YEARWEEK(CURRENT_DATE)
                                                         AND MONTH(logs_code_entrepot_changement.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM $BDD_Site.logs_code_entrepot_changement
                                                         WHERE MONTH(logs_code_entrepot_changement.date) = MONTH(NOW())
                                                         AND YEAR(logs_code_entrepot_changement.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Changement_Code_Entrepot = "SELECT COUNT(id) AS nombre 
                                                         FROM $BDD_Site.logs_code_entrepot_changement";
    }
    $Parametres_Statistique_Nombres_Changement_Code_Entrepot = $Connexion->prepare($Statistique_Nombres_Changement_Code_Entrepot);
    $Parametres_Statistique_Nombres_Changement_Code_Entrepot->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Changement_Code_Entrepot->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Changement_Code_Entrepot = $Parametres_Statistique_Nombres_Changement_Code_Entrepot->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Deblocage Yangs -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_deblocage_yangs
                                                WHERE logs_deblocage_yangs.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_deblocage_yangs
                                                WHERE YEARWEEK(logs_deblocage_yangs.date) = YEARWEEK(CURRENT_DATE)
                                                AND MONTH(logs_deblocage_yangs.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_deblocage_yangs
                                                WHERE MONTH(logs_deblocage_yangs.date) = MONTH(NOW())
                                                AND YEAR(logs_deblocage_yangs.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Deblocage_Yangs = "SELECT COUNT(id) AS nombre 
                                                FROM $BDD_Site.logs_deblocage_yangs";
    }
    $Parametres_Statistique_Nombres_Deblocage_Yangs = $Connexion->prepare($Statistique_Nombres_Deblocage_Yangs);
    $Parametres_Statistique_Nombres_Deblocage_Yangs->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Deblocage_Yangs->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Deblocage_Yangs = $Parametres_Statistique_Nombres_Deblocage_Yangs->fetch();
    /* ----------------------------------------------------------------------------------------------- */


    /* --------------- Nombre Vote -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM $BDD_Site.votes_logs
                                      WHERE votes_logs.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM $BDD_Site.votes_logs
                                      WHERE YEARWEEK(votes_logs.date) = YEARWEEK(CURRENT_DATE)
                                      AND MONTH(votes_logs.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM $BDD_Site.votes_logs
                                      WHERE MONTH(votes_logs.date) = MONTH(NOW())
                                      AND YEAR(votes_logs.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Votes = "SELECT COUNT(id) AS nombre 
                                      FROM $BDD_Site.votes_logs";
    }
    $Parametres_Statistique_Nombres_Votes = $Connexion->prepare($Statistique_Nombres_Votes);
    $Parametres_Statistique_Nombres_Votes->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Votes->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Vote = $Parametres_Statistique_Nombres_Votes->fetch();
    /* ----------------------------------------------------------------------------------------------- */


    /* --------------- Nombre Vote -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM $BDD_Site.logs_marche_achats
                                             WHERE logs_marche_achats.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM $BDD_Site.logs_marche_achats
                                             WHERE YEARWEEK(logs_marche_achats.date) = YEARWEEK(CURRENT_DATE)
                                             AND MONTH(logs_marche_achats.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM $BDD_Site.logs_marche_achats
                                             WHERE MONTH(logs_marche_achats.date) = MONTH(NOW())
                                             AND YEAR(logs_marche_achats.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Achats_Perso = "SELECT COUNT(id) AS nombre 
                                             FROM $BDD_Site.logs_marche_achats";
    }
    $Parametres_Nombres_Achats_Perso = $Connexion->prepare($Statistique_Nombres_Achats_Perso);
    $Parametres_Nombres_Achats_Perso->execute(array($Id_Statistique));
    $Parametres_Nombres_Achats_Perso->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Achat_Persos = $Parametres_Nombres_Achats_Perso->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Tickets Ouverts -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM $BDD_Site.support_ticket_traitement
                                                WHERE support_ticket_traitement.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM $BDD_Site.support_ticket_traitement
                                                WHERE YEARWEEK(support_ticket_traitement.date) = YEARWEEK(CURRENT_DATE)
                                                AND MONTH(support_ticket_traitement.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM $BDD_Site.support_ticket_traitement
                                                WHERE MONTH(support_ticket_traitement.date) = MONTH(NOW())
                                                AND YEAR(support_ticket_traitement.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Tickets_Ouverts = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                FROM $BDD_Site.support_ticket_traitement";
    }
    $Parametres_Statistique_Nombres_Tickets_Ouverts = $Connexion->prepare($Statistique_Nombres_Tickets_Ouverts);
    $Parametres_Statistique_Nombres_Tickets_Ouverts->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Tickets_Ouverts->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Tickets_Ouverts = $Parametres_Statistique_Nombres_Tickets_Ouverts->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Message Envoyés -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM $BDD_Site.support_ticket_traitement
                                                 WHERE support_ticket_traitement.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM $BDD_Site.support_ticket_traitement
                                                 WHERE YEARWEEK(support_ticket_traitement.date) = YEARWEEK(CURRENT_DATE)
                                                 AND MONTH(support_ticket_traitement.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM $BDD_Site.support_ticket_traitement
                                                 WHERE MONTH(support_ticket_traitement.date) = MONTH(NOW())
                                                 AND YEAR(support_ticket_traitement.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Messages_Envoyes = "SELECT COUNT(id) AS nombre 
                                                 FROM $BDD_Site.support_ticket_traitement";
    }
    $Parametres_Statistique_Nombres_Messages_Envoyes = $Connexion->prepare($Statistique_Nombres_Messages_Envoyes);
    $Parametres_Statistique_Nombres_Messages_Envoyes->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Messages_Envoyes->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Messages_Envoyes = $Parametres_Statistique_Nombres_Messages_Envoyes->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Dicussion Archivés -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM $BDD_Site.support_ticket_archives
                                                     WHERE support_ticket_archives.date >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM $BDD_Site.support_ticket_archives
                                                     WHERE YEARWEEK(support_ticket_archives.date) = YEARWEEK(CURRENT_DATE)
                                                     AND MONTH(support_ticket_archives.date) = MONTH(NOW())";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM $BDD_Site.support_ticket_archives
                                                     WHERE MONTH(support_ticket_archives.date) = MONTH(NOW())
                                                     AND YEAR(support_ticket_archives.date) = YEAR(NOW())";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Discussions_Archives = "SELECT COUNT(DISTINCT numero_discussion) AS nombre 
                                                     FROM $BDD_Site.support_ticket_archives";
    }
    $Parametres_Statistique_Nombres_Discussions_Archives = $Connexion->prepare($Statistique_Nombres_Discussions_Archives);
    $Parametres_Statistique_Nombres_Discussions_Archives->execute(array($Id_Statistique));
    $Parametres_Statistique_Nombres_Discussions_Archives->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Nombres_Discussions_Archives = $Parametres_Statistique_Nombres_Discussions_Archives->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    /* --------------- Nombre Provenance -------------------------------------------------------- */
    if ($Intervalle == "Jour") {
        $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM $BDD_Account.account
                                                     WHERE langue = ?
                                                     AND account.create_time >= CURDATE()";
    } else if ($Intervalle == "Semaine") {
        $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM $BDD_Account.account
                                                     WHERE YEARWEEK(account.create_time) = YEARWEEK(CURRENT_DATE)
                                                     AND MONTH(account.create_time) = MONTH(NOW())
                                                     AND langue = ?";
    } else if ($Intervalle == "Mois") {
        $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM $BDD_Account.account
                                                     WHERE MONTH(account.create_time) = MONTH(NOW())
                                                     AND YEAR(account.create_time) = YEAR(NOW())
                                                     AND langue = ?";
    } else if ($Intervalle == "Toujours") {
        $Statistique_Nombres_Provenance = "SELECT COUNT(id) AS nombre 
                                                     FROM $BDD_Account.account
                                                     WHERE langue = ?";
    }
    $Parametres_Statistique_Nombres_Provenance = $Connexion->prepare($Statistique_Nombres_Provenance);
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- France ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("FRA"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_FR = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Suisse ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("CHE"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_CH = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Grande Bretagne ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("GBR"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_GB = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Allemagne ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("DEU"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_DE = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Roumanie ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("ROM"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_RO = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- USA ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("USA"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_US = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Italie ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("ITA"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_IT = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Espagne ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("ESP"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_ES = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Pologne ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("POL"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_PL = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Portugal ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("PRT"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_PT = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Tunisie ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("TUN"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_TN = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Algerie ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("DZA"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_DZ = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Japon ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("JPN"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_JP = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */
    
    /* --------------------------------------- Belgique ---------------------------------------- */
    $Parametres_Statistique_Nombres_Provenance->execute(array("BEL"));
    $Parametres_Statistique_Nombres_Provenance->setFetchMode(PDO::FETCH_OBJ);
    $Donnees_Statistique_Provenance_BE = $Parametres_Statistique_Nombres_Provenance->fetch();
    /* ----------------------------------------------------------------------------------------------- */

    $Tableau_Json = array(
        'comptes' => "" . $Donnees_Statistique_Nombres_Comptes->nombre,
        'joueurs' => "" . $Donnees_Statistique_Nombres_Joueurs->nombre,
        'hommes' => "" . $Donnees_Statistique_Nombres_Hommes->nombre,
        'femmes' => "" . $Donnees_Statistique_Nombres_Femmes->nombre,
        'shinsoo' => "" . $Donnees_Statistique_Nombres_Shinsoo->nombre,
        'chunjo' => "" . $Donnees_Statistique_Nombres_Chunjo->nombre,
        'jinno' => "" . $Donnees_Statistique_Nombres_Jinno->nombre,
        'guerriers' => "" . $Donnees_Statistique_Nombres_Guerriers->nombre,
        'suras' => "" . $Donnees_Statistique_Nombres_Suras->nombre,
        'ninjas' => "" . $Donnees_Statistique_Nombres_Ninjas->nombre,
        'shamans' => "" . $Donnees_Statistique_Nombres_Shamans->nombre,
        'connexion_site' => "" . $Donnees_Statistique_Nombres_Connexion->nombre,
        'connexion_site_unique' => "" . $Donnees_Statistique_Nombres_Connexion_Unique->nombre,
        'changement_mail' => "" . $Donnees_Nombres_Changement_Mail->nombre,
        'recup_mdp' => "" . $Donnees_Statistique_Nombres_Recuperation_MDP->nombre,
        'changement_mdp' => "" . $Donnees_Statistique_Nombres_Changement_MDP->nombre,
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

    /* ----------------------- Suppression du ticket en attente ------------------------------------ */
    $Requete_Suppression_Tampon_Statistique = "DELETE FROM $BDD_Site.statistiques_tampon
                                             WHERE type_stati = ?";
    $Preparation_Suppression_Tampon_Statistique = $Connexion->prepare($Requete_Suppression_Tampon_Statistique);
    $Preparation_Suppression_Tampon_Statistique->execute(array($Id_Statistique));
    /* --------------------------------------------------------------------------------------------- */

    /* ------------------------------------------------ Insertion ---------------------------------------------------------------------- */
    $Insertion_Logs = "INSERT INTO $BDD_Site.statistiques_tampon (type_stati, 
                                                                  date_insertion, 
                                                                  comptes, joueurs, 
                                                                  hommes, femmes, 
                                                                  shinsoo, chunjo, jinno, 
                                                                  guerriers, suras, ninjas, shamans, 
                                                                  connexion_site, connexion_site_unique, 
                                                                  changement_mail, 
                                                                  recup_mdp, changement_mdp, 
                                                                  changement_entrepot, 
                                                                  deblocage_yangs, 
                                                                  nombre_vote, 
                                                                  nombre_achats_perso, 
                                                                  tickets_ouvert, 
                                                                  message_ecrits, 
                                                                  discussion_archives,
                                                                  pays_fr, 
                                                                  pays_ch,
                                                                  pays_gb,
                                                                  pays_de,
                                                                  pays_ro,
                                                                  pays_us,
                                                                  pays_it,
                                                                  pays_es,
                                                                  pays_pl,
                                                                  pays_pt,
                                                                  pays_tn,
                                                                  pays_dz,
                                                                  pays_jp,
                                                                  pays_be
                                                                  ) 
                                                          VALUES (:type_stati, 
                                                                  NOW(), 
                                                                  :comptes, :joueurs, 
                                                                  :hommes, :femmes, 
                                                                  :shinsoo, :chunjo, :jinno, 
                                                                  :guerriers, :suras, :ninjas, :shamans, 
                                                                  :connexion_site, :connexion_site_unique, 
                                                                  :changement_mail, 
                                                                  :recup_mdp, :changement_mdp, 
                                                                  :changement_entrepot, 
                                                                  :deblocage_yangs, 
                                                                  :nombre_vote, 
                                                                  :nombre_achats_perso, 
                                                                  :tickets_ouvert, 
                                                                  :message_ecrits, 
                                                                  :discussion_archives,
                                                                  :pays_fr,
                                                                  :pays_ch,
                                                                  :pays_gb,
                                                                  :pays_de,
                                                                  :pays_ro,
                                                                  :pays_us,
                                                                  :pays_it,
                                                                  :pays_es,
                                                                  :pays_pl,
                                                                  :pays_pt,
                                                                  :pays_tn,
                                                                  :pays_dz,
                                                                  :pays_jp,
                                                                  :pays_be
                                                                  )";

    $Paremetres_Insertion = $Connexion->prepare($Insertion_Logs);
    $Paremetres_Insertion->execute(array(
        ':type_stati' => $Id_Statistique,
        ':comptes' => $Donnees_Statistique_Nombres_Comptes->nombre,
        ':joueurs' => $Donnees_Statistique_Nombres_Joueurs->nombre,
        ':hommes' => $Donnees_Statistique_Nombres_Hommes->nombre,
        ':femmes' => $Donnees_Statistique_Nombres_Femmes->nombre,
        ':shinsoo' => $Donnees_Statistique_Nombres_Shinsoo->nombre,
        ':chunjo' => $Donnees_Statistique_Nombres_Chunjo->nombre,
        ':jinno' => $Donnees_Statistique_Nombres_Jinno->nombre,
        ':guerriers' => $Donnees_Statistique_Nombres_Guerriers->nombre,
        ':suras' => $Donnees_Statistique_Nombres_Suras->nombre,
        ':ninjas' => $Donnees_Statistique_Nombres_Ninjas->nombre,
        ':shamans' => $Donnees_Statistique_Nombres_Shamans->nombre,
        ':connexion_site' => $Donnees_Statistique_Nombres_Connexion->nombre,
        ':connexion_site_unique' => $Donnees_Statistique_Nombres_Connexion_Unique->nombre,
        ':changement_mail' => $Donnees_Nombres_Changement_Mail->nombre,
        ':recup_mdp' => $Donnees_Statistique_Nombres_Recuperation_MDP->nombre,
        ':changement_mdp' => $Donnees_Statistique_Nombres_Changement_MDP->nombre,
        ':changement_entrepot' => $Donnees_Statistique_Nombres_Changement_Code_Entrepot->nombre,
        ':deblocage_yangs' => $Donnees_Statistique_Nombres_Deblocage_Yangs->nombre,
        ':nombre_vote' => $Donnees_Statistique_Nombres_Vote->nombre,
        ':nombre_achats_perso' => "" . $Donnees_Statistique_Nombres_Achat_Persos->nombre,
        ':tickets_ouvert' => $Donnees_Statistique_Nombres_Tickets_Ouverts->nombre,
        ':message_ecrits' => $Donnees_Statistique_Nombres_Messages_Envoyes->nombre,
        ':discussion_archives' => $Donnees_Statistique_Nombres_Discussions_Archives->nombre,
        
        ':pays_fr' => $Donnees_Statistique_Provenance_FR->nombre,
        ':pays_ch' => $Donnees_Statistique_Provenance_CH->nombre,
        ':pays_gb' => $Donnees_Statistique_Provenance_GB->nombre,
        ':pays_de' => $Donnees_Statistique_Provenance_DE->nombre,
        ':pays_ro' => $Donnees_Statistique_Provenance_RO->nombre,
        ':pays_us' => $Donnees_Statistique_Provenance_US->nombre,
        ':pays_it' => $Donnees_Statistique_Provenance_IT->nombre,
        ':pays_es' => $Donnees_Statistique_Provenance_ES->nombre,
        ':pays_pl' => $Donnees_Statistique_Provenance_PL->nombre,
        ':pays_pt' => $Donnees_Statistique_Provenance_PT->nombre,
        ':pays_tn' => $Donnees_Statistique_Provenance_TN->nombre,
        ':pays_dz' => $Donnees_Statistique_Provenance_DZ->nombre,
        ':pays_jp' => $Donnees_Statistique_Provenance_JP->nombre,
        ':pays_be' => $Donnees_Statistique_Provenance_BE->nombre
    ));
    /* ----------------------------------------------------------------------------------------------------------------------------------- */
}
?>