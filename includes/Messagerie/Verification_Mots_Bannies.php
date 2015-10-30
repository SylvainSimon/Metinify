<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php
echo str_ireplace($_SESSION['Tableau_Mots_Bannis'], "/* Expression interdite */", $_POST['Message_Texte']);;
?>