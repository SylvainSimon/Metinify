<?php
$Serveur_Myql = "localhost";
$Identifiant_BDD = "root";
$Mot_de_Passe_BDD = "";
$Connexion = new PDO('mysql:host=' . $Serveur_Myql . ';charset=utf8', $Identifiant_BDD, $Mot_de_Passe_BDD);
$BDD_Account = "account";
$BDD_Common = "common";
$BDD_Log = "log";
$BDD_Site = "site";
$BDD_Player = "player";