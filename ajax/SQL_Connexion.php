<?php include '../configPDO.php'; ?>
<?php

$Connexion_Utilisateur = $_POST['Utilisateur'];
$Connexion_Mot_De_Passe = $_POST['Mot_De_Passe'];
$Connexion_Resultat = "";
$Connexion_Ip = $_SERVER['REMOTE_ADDR'];

/* ------------------------ Vérification Données ---------------------------- */
$Verification_Donnees = "SELECT * FROM $BDD_Account.account
                                  WHERE login = ?
                                  AND password = password(?)
                                  LIMIT 1";
$Parametres_Verification_Donnees = $Connexion->prepare($Verification_Donnees);
$Parametres_Verification_Donnees->execute(array(
    $Connexion_Utilisateur,
    $Connexion_Mot_De_Passe));
$Parametres_Verification_Donnees->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat != 0) {

    $Donnees_Connexion = $Parametres_Verification_Donnees->fetch();

    /* ------------------------ Vérification Données ---------------------------- */
    $Verification_Droits = "SELECT * 
                            FROM $BDD_Site.administration_users
                            WHERE id_compte = ?
                            AND pannel_admin = 1
                            LIMIT 1";
    $Parametres_Verification_Droits = $Connexion->prepare($Verification_Droits);
    $Parametres_Verification_Droits->execute(
            array(
                $Donnees_Connexion->id
            )
    );
    $Parametres_Verification_Droits->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Verification_Droits = $Parametres_Verification_Droits->rowCount();
    /* -------------------------------------------------------------------------- */

    if ($Donnees_Connexion->status == "BLOCK") {

        $Tableau_Retour_Json = array(
            'result' => "3",
            'reasons' => "Ce compte est banni.",
            'id' => "" . $Donnees_Connexion->id
        );
        $Connexion_Resultat = "3";
    } else {

        session_write_close();
        session_start();

        $_SESSION['ID'] = $Donnees_Connexion->id;
        $_SESSION['Utilisateur'] = $Donnees_Connexion->login;
        $_SESSION['Email'] = $Donnees_Connexion->email;
        $_SESSION['VamoNaies'] = $Donnees_Connexion->cash;
        $_SESSION['TanaNaies'] = $Donnees_Connexion->mileage;
        $_SESSION['Date_de_creation'] = $Donnees_Connexion->create_time;
        $_SESSION['Status'] = $Donnees_Connexion->status;
        $_SESSION['Pseudo_Messagerie'] = $Donnees_Connexion->pseudo_messagerie;

        $Connexion_Resultat = "1";

        if ($Nombre_De_Resultat_Verification_Droits != 0) {

            mt_srand((float) microtime() * 1000000);
            $Nombre_Unique = mt_rand(0, 100000000000);

            $_SESSION['Administration_PannelAdmin'] = true;
            $_SESSION['Administration_PannelAdmin_Jeton'] = $Nombre_Unique;

            /* ------------------------------------- Insertion Jetons Verif --------------------------------------- */
            $Insertion_Jetons_Verif = "INSERT INTO $BDD_Site.administration_pannel_jetons (id_compte, jeton, date, ip) 
                                               VALUES (:id_compte, :jeton, NOW(), :ip)";

            $Parametres_Insertion_Jetons_Verif = $Connexion->prepare($Insertion_Jetons_Verif);
            $Parametres_Insertion_Jetons_Verif->execute(array(
                ':id_compte' => $Donnees_Connexion->id,
                ':jeton' => $Nombre_Unique,
                ':ip' => $Connexion_Ip));
            /* ---------------------------------------------------------------------------------------------------- */

            $Tableau_Retour_Json = array(
                'result' => "1",
                'reasons' => "",
                'id' => $Donnees_Connexion->id,
                'data' => '<img title="Panneau d\'administration" id="Icone_Administration_Acces" onclick="Changement_De_Decors(\'' . $Nombre_Unique . '\')" src="images/icones/administration.png" height="27" />'
            );
        } else {

            $Tableau_Retour_Json = array(
                'result' => "1",
                'reasons' => "",
                'id' => $Donnees_Connexion->id,
                'data' => ""
            );
        }
    }
} else {

    $Connexion_Resultat = "0";

    $Tableau_Retour_Json = array(
        'result' => "2",
        'reasons' => "Vous avez indiqué de mauvaises informations."
    );
}

if ($Connexion_Resultat == "1") {
    /* -------------------------------------------- Insertion logs ----------------- */
    $Insertion_Logs = "INSERT INTO site.logs_connexion (id_compte, compte, ip, date, resultat) 
                          VALUES (:id_compte, :compte, :ip, NOW(), :resultat)";

    $Parametres_Insertion = $Connexion->prepare($Insertion_Logs);
    $Parametres_Insertion->execute(array(
        ':id_compte' => $_SESSION['ID'],
        ':compte' => $Connexion_Utilisateur,
        ':ip' => $Connexion_Ip,
        ':resultat' => $Connexion_Resultat));
    /* ----------------------------------------------------------------------------- */
} else {

    /* -------------------------------------------- Insertion logs ----------------- */
    $Insertion_Logs = "INSERT INTO site.logs_connexion (compte, ip, date, resultat) 
                          VALUES (:compte, :ip, NOW(), :resultat)";

    $Parametres_Insertion = $Connexion->prepare($Insertion_Logs);
    $Parametres_Insertion->execute(array(
        ':compte' => $Connexion_Utilisateur,
        ':ip' => $Connexion_Ip,
        ':resultat' => $Connexion_Resultat));
    /* ----------------------------------------------------------------------------- */
}
?>
<?php echo json_encode($Tableau_Retour_Json); ?>