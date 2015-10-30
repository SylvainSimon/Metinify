<?php @session_write_close(); ?>
<?php @session_start(); ?>

<?php include '../configPDO.php'; ?>

<?php

$Blocage_Inscription_Ip = $_SERVER['REMOTE_ADDR'];
?>

<?php

if (empty($_SESSION['Blocage_Inscription']) || ($_SESSION['Blocage_Inscription'] == 0)) {

    echo '1';
    $_SESSION['Blocage_Inscription'] = 1;
} else {

    if ($_SESSION['Blocage_Inscription'] == 1) {

        echo '2';
        $_SESSION['Blocage_Inscription'] = 2;
    } else if ($_SESSION['Blocage_Inscription'] == 2) {

        echo '3';
        $_SESSION['Blocage_Inscription'] = 3;
    }

    if ($_SESSION['Blocage_Inscription'] >= 3) {

        echo 'Bloquer';
        $_SESSION['Blocage_Inscription'] = 0;

        /* ------------------------------------------ Blocage Inscription ----------------------------------------- */
        $Insertion_Blocage_Inscription = "INSERT INTO site.blocage_inscription (ip, date_de_blocage) 
                                                 VALUES (:ip, NOW())";

        $Parametres_Blocage_Inscription = $Connexion->prepare($Insertion_Blocage_Inscription);
        $Parametres_Blocage_Inscription->execute(array(
            ':ip' => $Blocage_Inscription_Ip));
        /* -------------------------------------------------------------------------------------------------------- */
    }
}
?>