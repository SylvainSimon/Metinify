<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>

<?php

$Rechargement_Ip = $_SERVER["REMOTE_ADDR"];

$Resultat_Paiement = false;

if (@!empty($_GET['RECALL'])) {
//Vérification du code par allopass
    $RECALL = urlencode($_GET['RECALL']);

    $r = @file("http://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=227909/898935/4188626");


//Si le code est validé, on crédite le compte
    if (substr($r[0], 0, 2) == "OK") {

        $Resultat_Paiement = true;
    }
// Sinon on affiche un essage d'erreur
    else {

        $Resultat_Rechargement = "Raté";
    }
}

/* ------------------------ Check dernier numéro ---------------------------- */
$Informations_Compte = "SELECT account.email,
                               account.id,
                               account.login
                        FROM account.account
                        WHERE id = ?
                        LIMIT 1";
$Parametres_Informations_Compte = $Connexion->prepare($Informations_Compte);
$Parametres_Informations_Compte->execute(array(
    $_GET['data']
));
$Parametres_Informations_Compte->setFetchMode(PDO::FETCH_OBJ);
/* -------------------------------------------------------------------------- */

$Donnees_Compte = $Parametres_Informations_Compte->fetch();


/* ------------------------ Check dernier numéro ---------------------------- */
$Dernier_Numero = "SELECT id FROM site.logs_rechargements ORDER by id DESC LIMIT 1";
$Parametres_Dernier_Numero = $Connexion->prepare($Dernier_Numero);
$Parametres_Dernier_Numero->execute();
$Parametres_Dernier_Numero->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Dernier_Numero = $Parametres_Dernier_Numero->rowCount();
/* -------------------------------------------------------------------------- */
$Donnees_Dernier_Numero = $Parametres_Dernier_Numero->fetch();
?>
<?php

if ($Nombre_De_Resultat_Dernier_Numero == 0) {
    $Dernier_Numero = "1";
} else {
    $Dernier_Numero = ($Donnees_Dernier_Numero->id + 1);
}

if ($Resultat_Paiement) {

    $Resultat_Rechargement = "Réussi";

    /* -------------------------- Update des VamoNaies ----------------------------- */
    $Update_Monnaies = "UPDATE account.account 
                        SET cash = cash + 1350 
                        WHERE id = ?
                        LIMIT 1";

    $Parametres_Update_Monnaies = $Connexion->prepare($Update_Monnaies);
    $Parametres_Update_Monnaies->execute(array(
        $_GET['data']));
    /* ----------------------------------------------------------------------------- */

    if (!empty($_SESSION['ID'])) {
        $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] + 1350);
    }

    /* --------------------------- Insertion des logs ---------------------------- */
    $Insertion_Logs = "INSERT INTO site.logs_rechargements (id, id_compte, compte, email_compte, code, nombre_vamonaies, date, resultat, ip) 
                                              VALUES (:id, :id_compte, :compte, :email_compte, :code, :nombre_vamonaies, NOW(), :resultat, :ip)";

    $Parametres_Insertion = $Connexion->prepare($Insertion_Logs);
    $Parametres_Insertion->execute(array(
        ':id' => $Dernier_Numero,
        ':id_compte' => $Donnees_Compte->id,
        ':compte' => $Donnees_Compte->login,
        ':email_compte' => $Donnees_Compte->email,
        ':code' => $_GET['RECALL'],
        ':nombre_vamonaies' => "1350",
        ':resultat' => $Resultat_Rechargement,
        ':ip' => $Rechargement_Ip));
    /* ---------------------------------------------------------------------------- */

    if (!empty($_SESSION['ID'])) {
        header('Location: Resultat_Rechargement.php?Resultat=Reussi&id_compte=' . $_GET['data'] . '&id=' . $Dernier_Numero . '&compteur=oui');
        exit;
    } else {
        header('Location: Resultat_Rechargement.php?Resultat=Reussi&id_compte=' . $_GET['data'] . '&id=' . $Dernier_Numero . '&compteur=non');
    }
    ?>
<?php } else { ?>

    <?php

    $Resultat_Rechargement = "Mauvaise clès";

    /* --------------------------- Insertion des logs ---------------------------- */
    $Insertion_Logs = "INSERT INTO site.logs_rechargements (id, id_compte, compte, email_compte, code, date, resultat, ip) 
                                              VALUES (:id, :id_compte, :compte, :email_compte, :code, NOW(), :resultat, :ip)";

    $Parametres_Insertion = $Connexion->prepare($Insertion_Logs);
    $Parametres_Insertion->execute(array(
        ':id' => $Dernier_Numero,
        ':id_compte' => $Donnees_Compte->id,
        ':compte' => $Donnees_Compte->login,
        ':email_compte' => $Donnees_Compte->email,
        ':code' => $_GET['RECALL'],
        ':resultat' => $Resultat_Rechargement,
        ':ip' => $Rechargement_Ip));
    /* ---------------------------------------------------------------------------- */

    header('Location: Resultat_Rechargement.php?Resultat=Rate&Raison=ClesMauvaise&id_compte=' . $_GET['data'] . '&id=' . $Dernier_Numero . '');
    exit;
}
?>