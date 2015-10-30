<?php

$Serveur_Myql = "classyd.localhost";
$Identifiant_BDD = "vamosmt2";
$Mot_de_Passe_BDD = "";
$Connexion = new PDO('mysql:host=' . $Serveur_Myql . ';charset=utf8', $Identifiant_BDD, $Mot_de_Passe_BDD);

/* ------------------------ Recuperation Bannissement ---------------------------- */
$Selection_Enregistrements = "SELECT account.id,
                                     bannissements_actifs.id AS Bannissement_ID
                              FROM site.bannissements_actifs
                              LEFT JOIN account.account
                              ON account.id = bannissements_actifs.id_compte
                              WHERE definitif != 1
                              AND bannissements_actifs.date_fin_bannissement <= NOW()";
/* -------------------------------------------------------------------------------- */
$Parametres_Selection_Enregistrements = $Connexion->prepare($Selection_Enregistrements);
$Parametres_Selection_Enregistrements->execute();
$Parametres_Selection_Enregistrements->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Selection_Enregistrements = $Parametres_Selection_Enregistrements->rowCount();

if ($Nombre_De_Resultat_Selection_Enregistrements != 0) {

    while ($Donnees_Selection_Enregistrements = $Parametres_Selection_Enregistrements->fetch()) {


        /* ------------------------------------- Insertion Player Deleted --------------------------------------- */
        $Insertion_Player_Deleted = "INSERT INTO site.historique_bannissements 
                                             SELECT * FROM site.bannissements_actifs
                                             WHERE bannissements_actifs.id = ?";

        $Parametres_Insertion_Player_Deleted = $Connexion->prepare($Insertion_Player_Deleted);
        $Parametres_Insertion_Player_Deleted->execute(array(
            $Donnees_Selection_Enregistrements->Bannissement_ID));
        /* -------------------------------------------------------------------------------------------------------- */

        /* ------------------ Suppression Bannissements ---------------------------------------- */
        $Delete_Bannissement_Actif = "DELETE 
                                      FROM site.bannissements_actifs
                                      WHERE id_compte = :id_compte";

        $Parametres_Delete_Bannissement_Actif = $Connexion->prepare($Delete_Bannissement_Actif);
        $Parametres_Delete_Bannissement_Actif->execute(
                array(
                    ':id_compte' => $Donnees_Selection_Enregistrements->id
                )
        );
        /* ------------------------------------------------------------------------------------- */

        /* ----------------- Update Email --------------------- */
        $Update_Mail = "UPDATE site.historique_bannissements 
                SET debann_par = '0'
                WHERE historique_bannissements.id = ?
                LIMIT 1";

        $Parametres_Update_Email = $Connexion->prepare($Update_Mail);
        $Parametres_Update_Email->execute(array(
            $Donnees_Selection_Enregistrements->Bannissement_ID
        ));
        /* ----------------------------------------------------------- */
        

        /* ----------------- Update Compte --------------------- */
        $Update_Compte = "UPDATE account.account 
                          SET status = 'OK' 
                          WHERE id = :id_compte
                          LIMIT 1";

        $Parametres_Update_Compte = $Connexion->prepare($Update_Compte);
        $Parametres_Update_Compte->execute(
                array(
                    ':id_compte' => $Donnees_Selection_Enregistrements->id
                )
        );
        /* ----------------------------------------------------------- */
    }
} else {

    /* ------------------------ Recuperation Bannissement ---------------------------- */
    $Selection_Enregistrements_Definitif = "SELECT account.id,
                                         bannissements_actifs.id AS Bannissement_ID
                                  FROM site.bannissements_actifs
                                  LEFT JOIN account.account
                                  ON account.id = bannissements_actifs.id_compte
                                  WHERE definitif = 1
                                  AND bannissements_actifs.date_debut_bannissement < (NOW() - INTERVAL 30 DAY)";
    /* -------------------------------------------------------------------------------- */
    $Parametres_Selection_Enregistrements_Definitif = $Connexion->prepare($Selection_Enregistrements_Definitif);
    $Parametres_Selection_Enregistrements_Definitif->execute();
    $Parametres_Selection_Enregistrements_Definitif->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Selection_Enregistrements_Definitif = $Parametres_Selection_Enregistrements_Definitif->rowCount();

    if ($Nombre_De_Resultat_Selection_Enregistrements_Definitif != 0) {

        while ($Donnees_Selection_Enregistrements_Definitif = $Parametres_Selection_Enregistrements_Definitif->fetch()) {

            /* ------------------------------------- Insertion Player Deleted --------------------------------------- */
            $Insertion_Player_Deleted = "INSERT INTO site.historique_bannissements 
                                         SELECT * FROM site.bannissements_actifs
                                         WHERE bannissements_actifs.id = ?";

            $Parametres_Insertion_Player_Deleted = $Connexion->prepare($Insertion_Player_Deleted);
            $Parametres_Insertion_Player_Deleted->execute(array(
                $Donnees_Selection_Enregistrements_Definitif->Bannissement_ID));
            /* -------------------------------------------------------------------------------------------------------- */

            /* ----------------- Update Email --------------------- */
            $Update_Mail = "UPDATE site.historique_bannissements 
                SET debann_par = '0' , commentaire_debannissement = ''
                WHERE historique_bannissements.id = ?
                LIMIT 1";

            $Parametres_Update_Email = $Connexion->prepare($Update_Mail);
            $Parametres_Update_Email->execute(array(
                $Donnees_Selection_Enregistrements_Definitif->Bannissement_ID
            ));
            /* ----------------------------------------------------------- */

            /* ------------------ Suppression Bannissements ---------------------------------------- */
            $Delete_Bannissement_Actif = "DELETE 
                                          FROM site.bannissements_actifs
                                          WHERE bannissements_actifs.id = :id_bannissement";

            $Parametres_Delete_Bannissement_Actif = $Connexion->prepare($Delete_Bannissement_Actif);
            $Parametres_Delete_Bannissement_Actif->execute(
                    array(
                        ':id_bannissement' => $Donnees_Selection_Enregistrements_Definitif->Bannissement_ID
                    )
            );
            /* ------------------------------------------------------------------------------------- */
        }
    } else {
        echo 'loul';
    }
}
?>
