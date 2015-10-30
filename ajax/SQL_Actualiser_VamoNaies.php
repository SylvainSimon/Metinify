<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php

if (empty($_SESSION['ID'])) {
    
} else {
    echo $_SESSION["VamoNaies"];
}
?>