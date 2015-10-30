<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>

<?php

$Code_Effacement_Changer_Code_Avant = $_POST['Code_Avant'];
$Code_Effacement_Changer_Code = $_POST['Code_Effacement'];
$Code_Effacement_Changer_ID = $_SESSION['ID'];
$Code_Effacement_Changer_Utilisateur = $_SESSION['Utilisateur'];
$Code_Effacement_Changer_Ip = $_SERVER["REMOTE_ADDR"];

/* ------------------------ Vérification Données ---------------------------- */
$Verification_Code = "SELECT id FROM account.account
                                   WHERE social_id = ?
                                   AND login = ?
                                   LIMIT 1";
$Parametres_Verification_Code = $Connexion->prepare($Verification_Code);
$Parametres_Verification_Code->execute(array(
    $Code_Effacement_Changer_Code_Avant,
    $Code_Effacement_Changer_Utilisateur));
$Parametres_Verification_Code->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat = $Parametres_Verification_Code->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat != 0) {
    /* ----------------------------- Changer Code Effacement ------------------------------- */
    $Changer_Code_Effacement = "UPDATE account.account 
                            SET social_id = ? 
                            WHERE id = ?
                            LIMIT 1";

    $Parametres_Changer_Code_Effacement = $Connexion->prepare($Changer_Code_Effacement);
    $Parametres_Changer_Code_Effacement->execute(array(
        $Code_Effacement_Changer_Code,
        $Code_Effacement_Changer_ID));
    /* ------------------------------------------------------------------------------------- */

    /* ------------------------------------- Insertion Logs Definition Effacement --------------------------------------- */
    $Insertion_Logs_Definition_Effacement = "INSERT INTO site.logs_code_effacement_changement (id_compte, compte, ancien_code, nouveau_code, date, ip) 
                                          VALUES (:id_compte, :compte, :ancien_code, :nouveau_code, NOW(), :ip)";

    $Parametres_Insertion_Logs_Definition_Effacement = $Connexion->prepare($Insertion_Logs_Definition_Effacement);
    $Parametres_Insertion_Logs_Definition_Effacement->execute(array(
        ':id_compte' => $Code_Effacement_Changer_ID,
        ':compte' => $Code_Effacement_Changer_Utilisateur,
        ':ancien_code' => $Code_Effacement_Changer_Code_Avant,
        ':nouveau_code' => $Code_Effacement_Changer_Code,
        ':ip' => $Code_Effacement_Changer_Ip));
    /* ----------------------------------------------------------------------------------------------------------------- */

    echo '1';
} else {

    echo '2';
}
?>