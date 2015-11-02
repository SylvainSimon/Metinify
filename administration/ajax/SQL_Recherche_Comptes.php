<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class SQL_Recherche_Comptes extends \PageHelper {

    public function run() {
        ?>

        <?php @include '../../pages/Fonctions_Utiles.php'; ?>
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

                <?php if ($Donnees_Recuperation_Droits->recherche_comptes == 1) { ?>

                    <?php
                    $Terme_A_Recherche = $_POST["terme"];
                    $Param_Recherche = $_POST["param"];
                    $Param_Grandeur = $_POST["grandeur"];

                    $Tableau_Grandeurs = array("ASC", "DESC");
                    $Tableau_Parametres = array("player.name", "player.level", "account.login", "player.job", "player.gold", "player_index.empire", "player.ip", "account.status");

                    if (in_array($Param_Recherche, $Tableau_Parametres)) {

                        if (in_array($Param_Grandeur, $Tableau_Grandeurs)) {

                            $Listage_Joueur = "SELECT account.login,
                                  account.email,
								  player.level,
                                  player.id,
                                  player.gold,
                                  player.job,
                                  player.ip,
                                  player_index.empire,
								  account.cash,
								  account.mileage,
								  player.name,
                                  account.status
							   FROM player.player
							   LEFT JOIN account.account
                               ON account.id = player.account_id
                               LEFT JOIN player.player_index
                               ON account.id = player_index.id
                               WHERE account.login LIKE  ? '%'
                               ORDER by $Param_Recherche $Param_Grandeur
							   ";
                        } else {
                            echo "Paramètre non-valide.";
                            exit();
                        }
                    } else {

                        echo "Paramètre non-valide.";
                        exit();
                    }
                    $Parametres_Listage_Joueur = $this->objConnection->prepare($Listage_Joueur);
                    $Parametres_Listage_Joueur->execute(array(
                        $Terme_A_Recherche
                    ));
                    $Parametres_Listage_Joueur->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Listage_Joueur = $Parametres_Listage_Joueur->rowCount();
                    ?>

                    <?php echo $Nombre_De_Resultat_Listage_Joueur . "|"; ?>

                    <?php if ($Nombre_De_Resultat_Listage_Joueur != 0) { ?>

                        <?php while ($Donnees_Listage_Joueur = $Parametres_Listage_Joueur->fetch()) { ?>
                            <tr>
                                <td><?= $Donnees_Listage_Joueur->login; ?></td>
                                <td><?= $Donnees_Listage_Joueur->email; ?></td>
                                <td><?= $Donnees_Listage_Joueur->cash; ?></td>
                                <td><?= $Donnees_Listage_Joueur->name; ?></td>
                                <td>
                                    <img class="Images_Recherches" title="<?= Find_Name_Empire($Donnees_Listage_Joueur->empire); ?>" src="<?= Find_Image_Empire($Donnees_Listage_Joueur->empire); ?>" height="20" />
                                </td>
                                <td><?= $Donnees_Listage_Joueur->ip; ?></td>

                                <?php if ($Donnees_Listage_Joueur->status == "OK") { ?>
                                    <?php if ($Donnees_Recuperation_Droits->bannissement == 1) { ?>
                                        <td id="Personnage_ID_<?php echo $Donnees_Listage_Joueur->id; ?>" class="fancybox" data-fancybox-type="iframe" href="administration/includes/Bannissement.php?player_id=<?= $Donnees_Listage_Joueur->id; ?>">
                                            <img class="Images_Recherches Pointer" title="<?= Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <img class="Images_Recherches" title="<?= Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                        </td>
                                    <?php } ?>
                                <?php } else if ($Donnees_Listage_Joueur->status == "BLOCK") { ?>
                                    <?php if ($Donnees_Recuperation_Droits->debannissement == 1) { ?>
                                        <td id="Personnage_ID_<?php echo $Donnees_Listage_Joueur->id; ?>" class="fancybox" data-fancybox-type="iframe" href="administration/includes/Debannissement.php?player_id=<?= $Donnees_Listage_Joueur->id; ?>">
                                            <img class="Images_Recherches Pointer" title="<?= Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <img class="Images_Recherches" title="<?= Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                        <?php } ?>

                    <?php } else { ?>
                        <tr>
                            <td colspan='7'>Aucun résultat n'as été trouvé.</td>
                        </tr>
                    <?php } ?>

                <?php } else { ?>
                    <?= "Interdiction_Acces"; ?>
                <?php } ?>
            <?php } else { ?>
                <?= "Interdiction_Acces"; ?>
            <?php } ?>
        <?php } else { ?>
            <?= "Interdiction_Acces"; ?>
        <?php } ?>
        <?php
    }

}

$class = new SQL_Recherche_Comptes();
$class->run();
