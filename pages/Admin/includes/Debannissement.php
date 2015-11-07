<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class Debannissement extends \PageHelper {

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

                        <?php if ($Donnees_Recuperation_Droits->debannissement == 1) { ?>
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
                                               AND account.status = 'BLOCK'
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
                                    Procédure de debannissement de <?= $Donnees_Recuperation_Identite->name; ?>
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
                                        <?php
                                        /* ------------------------ Selection du bannissement ---------------------------- */
                                        $Selection_Bannissement = "SELECT bannissements_actifs.date_debut_bannissement,
                                                                  bannissements_actifs.date_fin_bannissement,
                                                                  bannissements_actifs.definitif,
                                                                  bannissements_actifs.duree,
                                                                  bannissement_raisons.raison,
                                                                  bannissement_raisons.recidive,
                                                                  account.pseudo_messagerie
                                                    FROM site.bannissements_actifs
                                                    LEFT JOIN account.account
                                                    ON bannissements_actifs.id_compte_gm = account.id
                                                    LEFT JOIN site.bannissement_raisons
                                                    ON bannissement_raisons.id = bannissements_actifs.raison_bannissement
                                                    WHERE bannissements_actifs.id_compte = :id_compte";
                                        $Parametres_Selection_Bannissement = $this->objConnection->prepare($Selection_Bannissement);
                                        $Parametres_Selection_Bannissement->execute(array(':id_compte' => $Donnees_Recuperation_Identite->id));
                                        $Parametres_Selection_Bannissement->setFetchMode(\PDO::FETCH_OBJ);
                                        $Nombre_De_Resultat_Selection_Bannissement = $Parametres_Selection_Bannissement->rowCount();
                                        /* -------------------------------------------------------------------------- */

                                        if ($Nombre_De_Resultat_Selection_Bannissement != 0) {

                                            $Donnees_Selection_Bannissement = $Parametres_Selection_Bannissement->fetch();
                                            $Raison = $Donnees_Selection_Bannissement->raison;
                                            $Date_Debut_Bann = \FonctionsUtiles::Formatage_Date($Donnees_Selection_Bannissement->date_debut_bannissement);

                                            if ($Donnees_Selection_Bannissement->duree != 999) {

                                                $Duree = $Donnees_Selection_Bannissement->duree . " jour(s).";
                                            } else {
                                                $Duree = "Jamais";
                                            }

                                            if ($Donnees_Selection_Bannissement->definitif == 1) {

                                                $Date_Fin_Bann = "Jamais";
                                            } else {
                                                $Date_Fin_Bann = \FonctionsUtiles::Formatage_Date($Donnees_Selection_Bannissement->date_fin_bannissement);
                                            }

                                            $GM_Bann = $Donnees_Selection_Bannissement->pseudo_messagerie;

                                            if ($Donnees_Selection_Bannissement->recidive == 1) {
                                                $Recidive = "Première fois.";
                                            } else if ($Donnees_Selection_Bannissement->recidive == 2) {
                                                $Recidive = "Deuxième fois.";
                                            } else if ($Donnees_Selection_Bannissement->recidive == 3) {
                                                $Recidive = "Troisième fois.";
                                            }
                                        } else {

                                            $Raison = "Aucun historique.";
                                            $Recidive = "Aucun historique.";
                                            $Date_Debut_Bann = "Aucun historique.";
                                            $Date_Fin_Bann = "Aucun historique.";
                                            $GM_Bann = "Aucun historique.";
                                            $Duree = "Aucun historique.";
                                        }
                                        $date_actuel = date("Y-m-d H:i:s");
                                        ?>
                                        <form class="Formulaire_Bannissement" id="Formulaire_Bannissement">
                                            <table class="Tableau_Formulaire_Bannissement">
                                                <tr>
                                                    <td class="Colonne_Gauche">Date : </td>
                                                    <td><?= \FonctionsUtiles::Formatage_Date($date_actuel); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Date Bann. : </td>
                                                    <td><?= $Date_Debut_Bann ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Durée : </td>
                                                    <td><?= $Duree ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Date Debann. : </td>
                                                    <td><?= $Date_Fin_Bann ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Pour : </td>
                                                    <td><?= $Raison ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Récidive : </td>
                                                    <td><?= $Recidive ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="Colonne_Gauche">Par : </td>
                                                    <td><?= $GM_Bann ?></td>
                                                </tr>
                                            </table>
                                            <input class="Bouton_Valider_Le_Bannissement" onclick="Procedure_Debannissement()" type="button" value="Lever le bannissement !" />
                                        </form>
                                    </div>
                                    <script type="text/javascript">
                                        function Procedure_Debannissement() {

                                            window.parent.Barre_De_Statut("Debannissement en cours...");
                                            window.parent.Icone_Chargement(1);

                                            $.ajax({
                                                type: "POST",
                                                url: "../ajax/SQL_Procedure_Debannissement.php",
                                                data: "id_compte=<?php echo $Donnees_Recuperation_Identite->id; ?>",
                                                success: function (msg) {
                                                    if (msg == "1") {

                        <?php
                        $Parametres_Liste_Personnage2 = $this->objConnection->prepare($Liste_Personnage);
                        $Parametres_Liste_Personnage2->execute(array(':id_compte' => $Donnees_Recuperation_Identite->id));
                        $Parametres_Liste_Personnage2->setFetchMode(\PDO::FETCH_OBJ);
                        ?>

                        <?php while ($Donnees_Liste_Personnage2 = $Parametres_Liste_Personnage2->fetch()) { ?>

                                                            if (window.parent.$("#Personnage_ID_<?php echo $Donnees_Liste_Personnage2->id ?>")) {
                                                                window.parent.$("#Personnage_ID_<?php echo $Donnees_Liste_Personnage2->id ?>").html("<img class='Images_Recherches Pointer' title='Compte Banni' src='images/valid.gif' height='20' />");
                                                                window.parent.$("#Personnage_ID_<?php echo $Donnees_Liste_Personnage2->id ?>").attr("href", "pages/Admin/includes/Bannissement.php?player_id=<?php echo $Donnees_Liste_Personnage2->id ?>");
                                                            }

                        <?php } ?>

                                                        window.parent.Barre_De_Statut("Debannissement terminé.");
                                                        window.parent.Icone_Chargement(0);

                                                        window.parent.$.fancybox.close();

                                                    } else if (msg == "Interdiction_Acces") {



                                                    }
                                                }
                                            });
                                        }
                                    </script>
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
                                                    WHERE historique_bannissements.id_compte = :id_compte";
                                    $Parametres_Historique_Bannissement = $this->objConnection->prepare($Historique_Bannissement);
                                    $Parametres_Historique_Bannissement->execute(array(':id_compte' => $Donnees_Recuperation_Identite->id));
                                    $Parametres_Historique_Bannissement->setFetchMode(\PDO::FETCH_OBJ);
                                    $Nombre_De_Resultat_Historique_Bannissement = $Parametres_Historique_Bannissement->rowCount();
                                    /* -------------------------------------------------------------------------- */

                                    /* ------------------------ Historique Bannissements ---------------------------- */
                                    $Bannissement_En_Cours = "SELECT bannissements_actifs.date_debut_bannissement,
                                                           bannissements_actifs.date_fin_bannissement,
                                                           bannissements_actifs.definitif,
                                                           account.pseudo_messagerie,
                                                           bannissement_raisons.raison
                                                    FROM site.bannissements_actifs
                                                    LEFT JOIN account.account
                                                    ON bannissements_actifs.id_compte_gm = account.id
                                                    LEFT JOIN site.bannissement_raisons
                                                    ON bannissement_raisons.id = bannissements_actifs.raison_bannissement
                                                    WHERE bannissements_actifs.id_compte = :id_compte
                                                    LIMIT 1";
                                    $Parametres_Bannissement_En_Cours = $this->objConnection->prepare($Bannissement_En_Cours);
                                    $Parametres_Bannissement_En_Cours->execute(array(':id_compte' => $Donnees_Recuperation_Identite->id));
                                    $Parametres_Bannissement_En_Cours->setFetchMode(\PDO::FETCH_OBJ);
                                    $Nombre_De_Resultat_Bannissement_En_Cours = $Parametres_Bannissement_En_Cours->rowCount();
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
                                                <?php if ($Nombre_De_Resultat_Bannissement_En_Cours != 0) { ?>
                                                    <?php $Donnees_Bannissement_En_Cours = $Parametres_Bannissement_En_Cours->fetch() ?>
                                                    <tr>
                                                        <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Bannissement_En_Cours->date_debut_bannissement); ?></td>
                                                        <?php if ($Donnees_Bannissement_En_Cours->definitif == 1) { ?>
                                                            <td>Définitif</td>
                                                        <?php } else { ?>
                                                            <td title="<?= \FonctionsUtiles::Formatage_Date($Donnees_Bannissement_En_Cours->date_fin_bannissement); ?>">Bannissement actif....</td>
                                                        <?php } ?>
                                                        <td><?= $Donnees_Bannissement_En_Cours->pseudo_messagerie ?></td>
                                                        <td><?= $Donnees_Bannissement_En_Cours->raison ?></td>
                                                    </tr>
                                                <?php } ?>

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
                                                    <?php if ($Nombre_De_Resultat_Bannissement_En_Cours == 0) { ?>
                                                        <tr><td colspan="4">Aucun historique de bannissement.</td></tr>
                                                    <?php } ?>
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

$class = new Debannissement();
$class->run();
