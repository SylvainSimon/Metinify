<?php

$Serveur_Myql = "94.23.6.155";
$Identifiant_BDD = "forum";
$Mot_de_Passe_BDD = "@websitevamosmt2//";
$Connexion = new PDO('mysql:host=' . $Serveur_Myql . ';charset=utf8', $Identifiant_BDD, $Mot_de_Passe_BDD);
$BDD_Account = "account";
$BDD_Site = "site";
$BDD_Player = "player";
?>
