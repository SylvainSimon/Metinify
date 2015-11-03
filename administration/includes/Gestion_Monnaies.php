<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Gestion_Monnaies extends \PageHelper {

    public function run() {
        ?>
        
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link rel="stylesheet" href="../css/Administration.css">
                <link rel="stylesheet" href="../../css/jquery-ui-1.8.23.custom.css">
                <script type="text/javascript" src="../../js/Jquery 1.8.0.js"></script>
            </head>
            <body>
                <?php if (!empty($_SESSION["Administration_PannelAdmin_Jeton"])) { ?>

                    <?php
                    /* ------------------------ Vérification Données ---------------------------- */
                    $Recuperation_Droits = "SELECT * 
                                    FROM site.administration_users
                                    WHERE id_compte = :id_compte
                                    LIMIT 1";
                    $Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
                    $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
                    $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
                    /* -------------------------------------------------------------------------- */
                    ?>
                    <?php if ($Nombre_De_Resultat_Recuperation_Droits != 0) { ?>
                        <?php $Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch(); ?>

                        <?php if ($Donnees_Recuperation_Droits->gerer_monnaies == 1) { ?>
                            <div class="Administration_Header">
                                Gestion des monnaies
                            </div>
                            <div id="Div_Saisie_Login_Gestion_Monnaie" class="Div_Saisie_Login_Gestion_Monnaie">
                                Indiquez le nom de compte du joueur : <input class="Input_Nom_Joueur_Monnaie" id="Input_Nom_Joueur_Monnaie" type="text" placeholder="Nom du compte..." autofocus/>
                                &nbsp;(* pour tout le monde).
                            </div>

                            <div id="Zone_Gerer_Monnaies" class="Zone_Gerer_Monnaies">
                                <table class="Tableau_Option_Monnaies">
                                    <tr>
                                        <td class="Colonne_Gauche">Type de transaction : </td>
                                        <td>
                                            <select class="Selecteur_Option_Monnaies" id="Selecteur_Option_Monnaie_Transaction">
                                                <option value="1" selected>Ajouter des monnaies</option>
                                                <option value="2">Enlever des monnaies</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="Colonne_Gauche">Devise : </td>
                                        <td>
                                            <select class="Selecteur_Option_Monnaies" id="Selecteur_Option_Monnaie_Devise">
                                                <option value="1" selected>Vamonaies</option>
                                                <option value="2">Tananaies</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div id="Zone_Raccourcies_Monnaies" class="Zone_Raccourcies_Monnaies">
                                <input type="button" class="Bouton_Monnaies_Raccourcies Bouton_Monnaie_500" onclick="Update_Monnaie(500)" value="500 monnaies"/>
                                <input type="button" class="Bouton_Monnaies_Raccourcies Bouton_Monnaie_1000" onclick="Update_Monnaie(1000)" value="1 000 monnaies"/>
                                <input type="button" class="Bouton_Monnaies_Raccourcies Bouton_Monnaie_5000" onclick="Update_Monnaie(5000)" value="5 000 monnaies"/>
                                <input type="button" class="Bouton_Monnaies_Raccourcies Bouton_Monnaie_20000" onclick="Update_Monnaie(20000)" value="20 000 monnaies"/>
                                <input type="button" class="Bouton_Monnaies_Raccourcies Bouton_Monnaie_50000" onclick="Update_Monnaie(50000)" value="50 000 monnaies"/>
                            </div>

                            <script type="text/javascript">

                                function Update_Monnaie(nombre_monnaies) {

                                    if ($("#Input_Nom_Joueur_Monnaie").val() == "") {

                                        window.parent.Barre_De_Statut("Vous n'avez pas indiquer de compte.");
                                        window.parent.Icone_Chargement(2);

                                    } else {
                                        window.parent.Barre_De_Statut("Distribution en cours...");
                                        window.parent.Icone_Chargement(1);

                                        $.ajax({
                                            type: "POST",
                                            url: "../ajax/SQL_Update_Monnaies.php",
                                            data: "nombre_monnaies=" + nombre_monnaies + "&transaction=" + $("#Selecteur_Option_Monnaie_Transaction").val() + "&devise=" + $("#Selecteur_Option_Monnaie_Devise").val() + "&compte=" + $("#Input_Nom_Joueur_Monnaie").val(),
                                            success: function (msg) {
                                                try {
                                                    Parse_Json = JSON.parse(msg);

                                                    if (Parse_Json.result == "WIN") {

                                                        window.parent.Barre_De_Statut("Transaction effectué.");
                                                        window.parent.Icone_Chargement(0);

                                                    } else if (Parse_Json.result == "FAIL") {

                                                        window.parent.Barre_De_Statut(Parse_Json.reasons);
                                                        window.parent.Icone_Chargement(2);

                                                    }

                                                } catch (e) {

                                                    window.parent.Barre_De_Statut("Problème lors de la récuperation.");
                                                    window.parent.Icone_Chargement(2);
                                                }
                                            }
                                        });
                                    }
                                }

                            </script>

                            <div class="Conteneur_Tableau_Historiques_Monnaies">
                                <div class="Defilement_Tableau_Historiques_Monnaies">

                                    <?php
                                    $Pseudo_Messagerie = "SELECT account.pseudo_messagerie
                                                  FROM account.account
                                                  WHERE account.id = :id_compte
                                                  LIMIT 1";
                                    $Parametres_Pseudo_Messagerie = $this->objConnection->prepare($Pseudo_Messagerie);
                                    ?>

                                    <?php
                                    $Login = "SELECT account.login
                                                  FROM account.account
                                                  WHERE account.id = :id_compte
                                                  LIMIT 1";
                                    $Parametres_Login = $this->objConnection->prepare($Login);
                                    ?>

                                    <?php
                                    /* ------------------------ Historique Monnaies ---------------------------- */
                                    $Historique_Gerer_Monnaies = "SELECT *
                                                          FROM site.administration_logs_gerer_monnaies
                                                          ORDER by date DESC
                                                          LIMIT 120";
                                    $Parametres_Historique_Gerer_Monnaies = $this->objConnection->prepare($Historique_Gerer_Monnaies);
                                    $Parametres_Historique_Gerer_Monnaies->execute();
                                    $Parametres_Historique_Gerer_Monnaies->setFetchMode(\PDO::FETCH_OBJ);
                                    $Nombre_De_Resultat_Historique_Gerer_Monnaies = $Parametres_Historique_Gerer_Monnaies->rowCount();
                                    /* -------------------------------------------------------------------------- */
                                    ?>
                                    <table class="Tableau_Historiques_Monnaies">
                                        <thead>
                                            <tr>
                                                <th>Qui</th>
                                                <th>Action</th>
                                                <th>Graçe à</th>
                                                <th>Date</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            <?php if ($Nombre_De_Resultat_Historique_Gerer_Monnaies != 0) { ?>
                                                <?php while ($Donnees_Historique_Gerer_Monnaies = $Parametres_Historique_Gerer_Monnaies->fetch()) { ?>
                                                    <?php
                                                    /* ------------------------ Vérification Données ---------------------------- */
                                                    $Parametres_Pseudo_Messagerie->execute(array(':id_compte' => $Donnees_Historique_Gerer_Monnaies->id_gm));
                                                    $Parametres_Pseudo_Messagerie->setFetchMode(\PDO::FETCH_OBJ);
                                                    $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch()
                                                    /* -------------------------------------------------------------------------- */
                                                    ?>
                                                    <tr>
                                                        <?php if ($Donnees_Historique_Gerer_Monnaies->id_compte != 0) { ?>
                                                            <?php
                                                            /* ------------------------ Vérification Données ---------------------------- */
                                                            $Parametres_Login->execute(array(':id_compte' => $Donnees_Historique_Gerer_Monnaies->id_compte));
                                                            $Parametres_Login->setFetchMode(\PDO::FETCH_OBJ);
                                                            $Donnees_Login = $Parametres_Login->fetch()
                                                            /* -------------------------------------------------------------------------- */
                                                            ?>
                                                            <td><?= $Donnees_Login->login; ?></td>
                                                        <?php } else { ?>
                                                            <td>Tout le monde</td>
                                                        <?php } ?>

                                                        <?php
                                                        $Phrase_Action = "";
                                                        if ($Donnees_Historique_Gerer_Monnaies->devise == "1") {
                                                            $Devise = "Vamonaies";
                                                        } else if ($Donnees_Historique_Gerer_Monnaies->devise == "2") {
                                                            $Devise = "Tananaies";
                                                        }
                                                        if ($Donnees_Historique_Gerer_Monnaies->operation == "1") {
                                                            $Operation = "a gagné";
                                                        } else if ($Donnees_Historique_Gerer_Monnaies->operation == "2") {
                                                            $Operation = "a perdu";
                                                        }

                                                        $Phrase_Action = "" . $Operation . " " . $Donnees_Historique_Gerer_Monnaies->montant . " " . $Devise . ".";
                                                        ?>
                                                        <td><?= $Phrase_Action; ?></td>
                                                        <td><?= $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></td>
                                                        <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Historique_Gerer_Monnaies->date); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr><td colspan="4">Aucuns historique enregistré.</td></tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        <?php } else { ?>
                            <?php include 'Interdiction_Acces.php'; ?>
                        <?php } ?>

                    <?php } else { ?>
                        <?php include 'Interdiction_Acces.php'; ?>
                    <?php } ?>

                <?php } else { ?>
                    <?php include 'Interdiction_Acces.php'; ?>
                <?php } ?>

            </body>
        </html>
        <?php
    }

}

$class = new Gestion_Monnaies();
$class->run();
