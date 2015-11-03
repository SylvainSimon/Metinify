<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Bannissement extends \PageHelper {

    public function run() {
        ?>
        
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link rel="stylesheet" href="../css/Administration.css">
                <script src='../../components/jquery/jquery.min.js' type='text/javascript'></script>
                <script src='../../components/jquery-ui/jquery-ui.min.js' type='text/javascript'></script>

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

                        <?php if ($Donnees_Recuperation_Droits->bannissement == 1) { ?>
                            <?php
                            /* ------------------------ Vérification Données ---------------------------- */
                            $Recuperation_Identite = "SELECT player.name,
                                                     account.login,
                                                     account.id,
                                                     account.cash,
                                                     account.mileage
                                               FROM player.player
                                               LEFT JOIN account.account
                                               ON account.id = player.account_id
                                               WHERE player.id = :id_perso
                                               AND account.status = 'OK'
                                               LIMIT 1";
                            $Parametres_Recuperation_Identite = $this->objConnection->prepare($Recuperation_Identite);
                            $Parametres_Recuperation_Identite->execute(array(':id_perso' => $_GET["player_id"]));
                            $Parametres_Recuperation_Identite->setFetchMode(\PDO::FETCH_OBJ);
                            $Nombre_De_Resultat_Recuperation_Identite = $Parametres_Recuperation_Identite->rowCount();
                            /* -------------------------------------------------------------------------- */
                            ?>
                            <?php if ($Nombre_De_Resultat_Recuperation_Identite != 0) { ?>
                                <?php $Donnees_Recuperation_Identite = $Parametres_Recuperation_Identite->fetch(); ?>  

                                <?php
                                /* ------------------------ Vérification Données ---------------------------- */
                                $Liste_Personnage = "SELECT player.name,
                                                    player.level,
                                                    player.id,
                                                    player.ip
                                             FROM player.player
                                             WHERE player.account_id = :id_compte
                                             LIMIT 4";
                                $Parametres_Liste_Personnage = $this->objConnection->prepare($Liste_Personnage);
                                $Parametres_Liste_Personnage->execute(array(':id_compte' => $Donnees_Recuperation_Identite->id));
                                $Parametres_Liste_Personnage->setFetchMode(\PDO::FETCH_OBJ);
                                /* -------------------------------------------------------------------------- */
                                ?>
                                <div class="Administration_Header">
                                    Procédure de bannissement de <?= $Donnees_Recuperation_Identite->name; ?>
                                </div>
                                <div class="Contenue_Bannissement">

                                    <div class="Information_Bannissement">
                                        <table class="Tableau_Rappel">
                                            <tr>
                                                <th colspan="3">Rappel des informations :</th>
                                            </tr>
                                            <tr>
                                                <td class="Colonne_Gauche">Compte : </td>
                                                <?php if ($Donnees_Recuperation_Droits->voir_compte == 1) { ?>
                                                    <td title="Voir les détails du compte" class="Administration_Survol_TD Pointer" colspan="2"><?= $Donnees_Recuperation_Identite->login; ?></td>
                                                <?php } else { ?>
                                                    <td colspan="2"><?= $Donnees_Recuperation_Identite->login; ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td class="Colonne_Gauche">Monnaies : </td>
                                                <td class="Administration_Survol_TD Pointer">
                                                    <img class="Bannissement_Piece_Monnaie" src="../../images/rectopiece.png" height="17" />
                                                    <span class="Texte_Monnaie_Bannissement"><?= $Donnees_Recuperation_Identite->cash; ?></span>
                                                </td>

                                                <td class="Administration_Survol_TD Pointer">
                                                    <img class="Bannissement_Piece_Monnaie" src="../../images/versopiece.png" height="17" />
                                                    <span class="Texte_Monnaie_Bannissement"><?= $Donnees_Recuperation_Identite->mileage; ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="Tableau_Rappel_Personnages">
                                            <tr>
                                                <th colspan="3">Personnages :</th>
                                            </tr>
                                            <?php while ($Donnees_Liste_Personnage = $Parametres_Liste_Personnage->fetch()) { ?>
                                                <tr>
                                                    <?php if ($Donnees_Recuperation_Droits->voir_personnage == 1) { ?>
                                                        <td title="Voir le profil du personnage" class="Colonne_Gauche Administration_Survol_TD Pointer"><?= $Donnees_Liste_Personnage->name; ?></td>
                                                    <?php } else { ?>
                                                        <td><?= $Donnees_Liste_Personnage->name; ?> : </td>
                                                    <?php } ?>
                                                    <td width="35"><?= $Donnees_Liste_Personnage->level; ?></td>

                                                    <?php if ($Donnees_Recuperation_Droits->recherche_ip == 1) { ?>
                                                        <td title="Rechercher cette IP" class="Administration_Survol_TD Pointer"><?= $Donnees_Liste_Personnage->ip; ?></td>
                                                    <?php } else { ?>
                                                        <td title="Ip du joueur"><?= $Donnees_Liste_Personnage->ip; ?></td>
                                                    <?php } ?>

                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <form class="Formulaire_Bannissement" id="Formulaire_Bannissement">
                                            <?php
                                            /* ------------------------ Recuperation Raisons ---------------------------- */
                                            $Recuperation_Raisons = "SELECT DISTINCT raison
                                                             FROM site.bannissement_raisons";
                                            $Parametres_Recuperation_Raisons = $this->objConnection->prepare($Recuperation_Raisons);
                                            $Parametres_Recuperation_Raisons->execute();
                                            $Parametres_Recuperation_Raisons->setFetchMode(\PDO::FETCH_OBJ);
                                            /* -------------------------------------------------------------------------- */

                                            $date_actuel = date("Y-m-d H:i:s");
                                            ?>
                                            <table class="Tableau_Formulaire_Bannissement">
                                                <tr>
                                                    <td class="Colonne_Gauche">Date : </td>
                                                    <td><?= \FonctionsUtiles::Formatage_Date($date_actuel); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Modérateur : </td>
                                                    <td><?= $_SESSION['Pseudo_Messagerie']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Raison : </td>
                                                    <td>
                                                        <select id="Selecteur_Raison_Bannissement" class="Selecteur_Bannissement" onchange="Recuperer_Recidive(this.value)">
                                                            <option value="---"> --- </option>
                                                            <?php while ($Donnees_Recuperation_Raisons = $Parametres_Recuperation_Raisons->fetch()) { ?>
                                                                <option value="<?= $Donnees_Recuperation_Raisons->raison; ?>"><?= $Donnees_Recuperation_Raisons->raison; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Récidive : </td>
                                                    <td>
                                                        <select class="Selecteur_Bannissement" onchange="Recuperer_Sanction()" disabled id="Selecteur_Bannissement_Recidive">

                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Sanction : </td>
                                                    <td id="Zone_Sanction">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Date debann. : </td>
                                                    <td id="Zone_Debann">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Commentaire : </td>
                                                    <td>
                                                        <input id="Zone_Commentaire" class="Zone_Commentaire" type="text" placeholder="Commentaire facultatif...">
                                                    </td>
                                                </tr>
                                            </table>
                                            <input class="Bouton_Valider_Le_Bannissement" onclick="Procedure_Bannissement()" type="button" value="Valider le bannissement !" />
                                        </form>
                                        <script type="text/javascript">

                                            function Procedure_Bannissement() {

                                                if (($("#Selecteur_Raison_Bannissement").val() != "---") && ($("#Selecteur_Bannissement_Recidive").val() != "") && ($("#Zone_Sanction").html() != "") && ($("#Zone_Debann").html() != "")) {

                                                    window.parent.Barre_De_Statut("Bannissement en cours...");
                                                    window.parent.Icone_Chargement(1);

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../ajax/SQL_Procedure_Bannissement.php",
                                                        data: "raison=" + $("#Selecteur_Raison_Bannissement").val() + "&id_raison=" + $("#Selecteur_Bannissement_Recidive").val() + "&id_compte=<?php echo $Donnees_Recuperation_Identite->id; ?>&commentaire=" + $("#Zone_Commentaire").val(),
                                                        success: function (msg) {

                                                            try {
                                                                Parse_Json = JSON.parse(msg);
                                                                if (Parse_Json.result == "WIN") {

                                                                    window.parent.Barre_De_Statut("Bannissement réussi.");
                                                                    window.parent.Icone_Chargement(0);


                        <?php
                        $Parametres_Liste_Personnage2 = $this->objConnection->prepare($Liste_Personnage);
                        $Parametres_Liste_Personnage2->execute(array(':id_compte' => $Donnees_Recuperation_Identite->id));
                        $Parametres_Liste_Personnage2->setFetchMode(\PDO::FETCH_OBJ);
                        ?>

                        <?php while ($Donnees_Liste_Personnage2 = $Parametres_Liste_Personnage2->fetch()) { ?>

                                                                        if (window.parent.$("#Personnage_ID_<?php echo $Donnees_Liste_Personnage2->id ?>")) {

                                                                            window.parent.$("#Personnage_ID_<?php echo $Donnees_Liste_Personnage2->id ?>").html("<img class='Images_Recherches Pointer' title='Compte Banni' src='images/invalid.gif' height='20' />");
                                                                            window.parent.$("#Personnage_ID_<?php echo $Donnees_Liste_Personnage2->id ?>").attr("href", "administration/includes/Debannissement.php?player_id=<?php echo $Donnees_Liste_Personnage2->id ?>");

                                                                        }

                        <?php } ?>

                                                                    window.parent.$.fancybox.close();

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

                                                } else {
                                                    window.parent.Barre_De_Statut("Renseignez les champs !");
                                                    window.parent.Icone_Chargement(2);
                                                }
                                            }

                                            function Recuperer_Recidive(raison) {
                                                if (raison == "---") {
                                                    $("#Zone_Debann").html("");
                                                    $("#Selecteur_Bannissement_Recidive").html("");
                                                    $("#Selecteur_Bannissement_Recidive").val("");
                                                    $("#Selecteur_Bannissement_Recidive").attr('disabled', true);
                                                    $("#Zone_Sanction").html("");

                                                } else {
                                                    window.parent.Barre_De_Statut("Récupération récidives...");
                                                    window.parent.Icone_Chargement(1);

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../ajax/SQL_Recuperer_Recidive.php",
                                                        data: "raison=" + raison,
                                                        success: function (msg) {

                                                            $("#Selecteur_Bannissement_Recidive").html(msg);
                                                            $("#Selecteur_Bannissement_Recidive").removeAttr("disabled");
                                                            window.parent.Barre_De_Statut("Liste récidive généré.");
                                                            window.parent.Icone_Chargement(1);

                                                            Recuperer_Sanction();
                                                        }
                                                    });
                                                    return false;
                                                }
                                            }

                                            function Recuperer_Sanction() {

                                                window.parent.Barre_De_Statut("Récupération de la sanction...");
                                                window.parent.Icone_Chargement(1);

                                                $.ajax({
                                                    type: "POST",
                                                    url: "../ajax/SQL_Recuperer_Sanction.php",
                                                    data: "id_sanction=" + $("#Selecteur_Bannissement_Recidive").val(),
                                                    success: function (msg) {

                                                        try {
                                                            Parse_Json = JSON.parse(msg);

                                                            $("#Zone_Sanction").html(Parse_Json.phrase);
                                                            window.parent.Barre_De_Statut("Sanction recupéré.");
                                                            window.parent.Icone_Chargement(0);

                                                            if (Parse_Json.fin == "Jamais") {
                                                                $("#Zone_Debann").html(Parse_Json.fin);
                                                                window.parent.Barre_De_Statut("Date calculé.");
                                                                window.parent.Icone_Chargement(0);
                                                            } else {

                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "../ajax/SQL_\FonctionsUtiles::Formatage_Date.php",
                                                                    data: "date=" + Parse_Json.fin,
                                                                    success: function (msg) {

                                                                        $("#Zone_Debann").html(msg);
                                                                        window.parent.Barre_De_Statut("Date calculé.");
                                                                        window.parent.Icone_Chargement(0);
                                                                    }
                                                                });
                                                            }

                                                        } catch (e) {

                                                            $("#Zone_Sanction").html("Problème de connection");
                                                            window.parent.Barre_De_Statut("Problème lors de la récuperation.");
                                                            window.parent.Icone_Chargement(2);
                                                        }

                                                    }
                                                });
                                                return false;
                                            }
                                        </script>
                                    </div>
                                    <?php
                                    /* ------------------------ Historique Bannissements ---------------------------- */
                                    $Historique_Bannissement = "SELECT historique_bannissements.date_debut_bannissement,
                                                           historique_bannissements.date_fin_bannissement,
                                                           historique_bannissements.definitif,
                                                           historique_bannissements.debann_par,
                                                           account.pseudo_messagerie,
                                                           bannissement_raisons.raison
                                                    FROM site.historique_bannissements
                                                    LEFT JOIN account.account
                                                    ON historique_bannissements.id_compte_gm = account.id
                                                    LEFT JOIN site.bannissement_raisons
                                                    ON bannissement_raisons.id = historique_bannissements.raison_bannissement
                                                    WHERE historique_bannissements.id_compte = :id_compte
                                                    ORDER by date_debut_bannissement DESC";
                                    $Parametres_Historique_Bannissement = $this->objConnection->prepare($Historique_Bannissement);
                                    $Parametres_Historique_Bannissement->execute(array(':id_compte' => $Donnees_Recuperation_Identite->id));
                                    $Parametres_Historique_Bannissement->setFetchMode(\PDO::FETCH_OBJ);
                                    $Nombre_De_Resultat_Historique_Bannissement = $Parametres_Historique_Bannissement->rowCount();
                                    /* -------------------------------------------------------------------------- */
                                    ?>
                                    <div class="Conteneur_Tableau_Historiques_Bannissement">
                                        <table class="Tableau_Historiques_Bannissements">
                                            <thead>
                                                <tr>
                                                    <th width="210">Date début : </th>
                                                    <th width="210">Date fin : </th>
                                                    <th width="180">Par : </th>
                                                    <th>Pour : </th>
                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php
                                                $Pseudo_Messagerie = "SELECT account.pseudo_messagerie
                                                              FROM account.account
                                                              WHERE account.id = :id_compte
                                                              LIMIT 1";
                                                $Parametres_Pseudo_Messagerie = $this->objConnection->prepare($Pseudo_Messagerie);
                                                ?>

                                                <?php if ($Nombre_De_Resultat_Historique_Bannissement != 0) { ?>
                                                    <?php while ($Donnees_Historique_Bannissement = $Parametres_Historique_Bannissement->fetch()) { ?>

                                                        <tr>
                                                            <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Historique_Bannissement->date_debut_bannissement); ?></td>
                                                            <?php if (($Donnees_Historique_Bannissement->debann_par == "") && ($Donnees_Historique_Bannissement->debann_par != "0")) { ?>
                                                                <?php if ($Donnees_Historique_Bannissement->definitif == 1) { ?>
                                                                    <td>Définitif</td>
                                                                <?php } else { ?>
                                                                    <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Historique_Bannissement->date_fin_bannissement); ?></td>
                                                                <?php } ?>
                                                                <td><?= $Donnees_Historique_Bannissement->pseudo_messagerie ?></td>
                                                            <?php } else { ?>

                                                                <?php if ($Donnees_Historique_Bannissement->debann_par != "0") { ?>
                                                                    <?php
                                                                    /* ------------------------ Vérification Données ---------------------------- */
                                                                    $Parametres_Pseudo_Messagerie->execute(array(':id_compte' => $Donnees_Historique_Bannissement->debann_par));
                                                                    $Parametres_Pseudo_Messagerie->setFetchMode(\PDO::FETCH_OBJ);
                                                                    $Donnees_Pseudo_Messagerie = $Parametres_Pseudo_Messagerie->fetch()
                                                                    /* -------------------------------------------------------------------------- */
                                                                    ?>
                                                                    <td>Bannissement interrompu.</td>
                                                                    <td><?php echo $Donnees_Pseudo_Messagerie->pseudo_messagerie; ?></td>
                                                                <?php } else { ?>
                                                                    <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Historique_Bannissement->date_fin_bannissement); ?></td>
                                                                    <td>Script automatique.</td>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <td><?= $Donnees_Historique_Bannissement->raison ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <tr><td colspan="4">Aucun historique de bannissement.</td></tr>
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

                <?php } else { ?>
                    <?php include 'Interdiction_Acces.php'; ?>
                <?php } ?>
            </body>
        </html>
        <?php
    }

}

$class = new Bannissement();
$class->run();
