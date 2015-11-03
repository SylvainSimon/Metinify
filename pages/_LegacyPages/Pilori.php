<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Pilori extends \PageHelper {

    public function run() {
        ?>

        <?php
        /* ------------------------ Classement Joueur ---------------------------- */
        $Liste_Comptes_Banni = "SELECT bannissements_actifs.date_debut_bannissement,
                               bannissement_raisons.sanction,
                               bannissement_raisons.raison,
                               account.id AS account_id
                        FROM account.account 
                        INNER JOIN site.bannissements_actifs
                        ON account.id = bannissements_actifs.id_compte
                        INNER JOIN site.bannissement_raisons
                        ON bannissement_raisons.id = bannissements_actifs.raison_bannissement
                        WHERE account.status = 'BLOCK'
                        ORDER BY bannissements_actifs.date_debut_bannissement DESC
                        LIMIT 0,15";
        $Parametres_Liste_Comptes_Banni = $this->objConnection->query($Liste_Comptes_Banni);
        $Parametres_Liste_Comptes_Banni->execute();
        $Parametres_Liste_Comptes_Banni->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Liste_Comptes_Banni = $Parametres_Liste_Comptes_Banni->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>

        <div class="Cadre_Principal">
            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Pilori des membres sanctionnés récemment</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                <table class="Table_Classement_Modele">

                    <thead>
                        <tr>
                            <th class="Colonne_Gauche_Formulaire">Nom de joueur</th>
                            <th align="center">Level</th>
                            <th align="left" class="Colonne_Droite_Formulaire" style="text-indent: 5px;">Date du bannissement</th>
                            <th align="left">Raison</th>
                            <th align="left">Durée</th>
                            <th align="center" class="Colonne_Droite_Formulaire">Empire</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($Nombre_De_Resultat_Liste_Comptes_Banni != 0) { ?>
                            <?php while ($Donnees_Liste_Comptes_Banni = $Parametres_Liste_Comptes_Banni->fetch()) { ?>

                                <?php
                                /* ------------------------ Classement Joueur ---------------------------- */
                                $Liste_Joueurs_Bannis = "SELECT player.name,
                                                player.level,
                                                player.job,
                                                player_index.empire
                                             FROM player.player 
                                             INNER JOIN player.player_index
                                             ON player_index.id = player.account_id
                                             WHERE player.account_id = $Donnees_Liste_Comptes_Banni->account_id
                                             ORDER BY player.level DESC";
                                /* -------------------------------------------------------------------------- */
                                $Parametres_Liste_Joueurs_Bannis = $this->objConnection->query($Liste_Joueurs_Bannis);
                                $Parametres_Liste_Joueurs_Bannis->execute();
                                $Parametres_Liste_Joueurs_Bannis->setFetchMode(\PDO::FETCH_OBJ);
                                ?>

                                <?php while ($Donnees_Liste_Joueurs_Bannis = $Parametres_Liste_Joueurs_Bannis->fetch()) { ?>
                                    <tr>
                                        <td style="text-indent: 5px;" class="Colonne_Gauche_Formulaire"><?= $Donnees_Liste_Joueurs_Bannis->name; ?></td>
                                        <td align="center"><?= $Donnees_Liste_Joueurs_Bannis->level; ?></td>
                                        <td class="Colonne_Droite_Formulaire" style="text-indent: 5px;"><?= \FonctionsUtiles::Formatage_Date($Donnees_Liste_Comptes_Banni->date_debut_bannissement); ?></td>
                                        <td><?= $Donnees_Liste_Comptes_Banni->raison; ?></td>
                                        <?php if ($Donnees_Liste_Comptes_Banni->sanction != 999) { ?>
                                            <td><?= $Donnees_Liste_Comptes_Banni->sanction . " jours"; ?></td>
                                        <?php } else { ?>
                                            <td>Définitif</td>
                                        <?php } ?>
                                        <td class="Colonne_Droite_Formulaire" align="center">
                                            <?php if ($Donnees_Liste_Joueurs_Bannis->empire == 1) { ?>
                                                <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/red.jpg" height="20"/> 
                                            <?php } else if ($Donnees_Liste_Joueurs_Bannis->empire == 2) { ?>
                                                <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/yellow.jpg"/> 
                                            <?php } else if ($Donnees_Liste_Joueurs_Bannis->empire == 3) { ?>
                                                <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/blue.jpg"/>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr><td colspan="6">Aucun membres bannis.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr class="Hr_Bas">
            </div>
        </div>
        <?php
    }

}

$class = new Pilori();
$class->run();
