<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Recherche_Joueurs extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::RECHERCHE_JOUEUR);
    }

    public function run() {

        $Terme_A_Recherche = $_POST["terme"];
        $Param_Recherche = $_POST["param"];
        $Param_Grandeur = $_POST["grandeur"];

        $Tableau_Grandeurs = array("ASC", "DESC");
        $Tableau_Parametres = array("player.name", "player.level", "account.login", "player.job", "player.gold", "player_index.empire", "player.ip", "account.status");

        if (in_array($Param_Recherche, $Tableau_Parametres)) {

            if (in_array($Param_Grandeur, $Tableau_Grandeurs)) {

                $Listage_Joueur = "SELECT player.name,
                                  player.level,
                                  player.id,
								  player.last_play,
                                  player.playtime,
								  player.ip,
                                  player.job,
                                  player_index.empire,
                                      account.status
                               FROM player.player
                               LEFT JOIN account.account
                               ON account.id = player.account_id
                               LEFT JOIN player.player_index
                               ON account.id = player_index.id
                               WHERE player.name LIKE '%' ? '%'
							   AND player.name != 'PvPStory'
                               ORDER by $Param_Recherche $Param_Grandeur";
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
                    <td><?= $Donnees_Listage_Joueur->name; ?></td>
                    <td><?= $Donnees_Listage_Joueur->last_play; ?></td>
                    <td><?= $Donnees_Listage_Joueur->level; ?></td>
                    <td><?= $Donnees_Listage_Joueur->playtime; ?></td>
                    <td>
                        <img class="Images_Recherches" title="<?= \FonctionsUtiles::Find_Name_Race($Donnees_Listage_Joueur->job); ?>" src="<?= \FonctionsUtiles::Find_Image_Race($Donnees_Listage_Joueur->job); ?>" height="20" />
                    </td>

                    <td>
                        <?php echo \FonctionsUtiles::FindIconeEmpire($Donnees_Listage_Joueur->empire); ?>
                    </td>

                    <td><?= $Donnees_Listage_Joueur->ip; ?></td>
                    <?php if ($Donnees_Listage_Joueur->status == "OK") { ?>
                        <?php if ($Donnees_Recuperation_Droits->bannissement == 1) { ?>
                            <td id="Personnage_ID_<?php echo $Donnees_Listage_Joueur->id; ?>" class="fancybox" data-fancybox-type="iframe" href="pages/Admin/includes/Bannissement.php?player_id=<?= $Donnees_Listage_Joueur->id; ?>">
                                <img class="Images_Recherches Pointer" title="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                            </td>
                        <?php } else { ?>
                            <td>
                                <img class="Images_Recherches" title="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                            </td>
                        <?php } ?>
                    <?php } else if ($Donnees_Listage_Joueur->status == "BLOCK") { ?>
                        <?php if ($Donnees_Recuperation_Droits->debannissement == 1) { ?>
                            <td id="Personnage_ID_<?php echo $Donnees_Listage_Joueur->id; ?>" class="fancybox" data-fancybox-type="iframe" href="pages/Admin/includes/Debannissement.php?player_id=<?= $Donnees_Listage_Joueur->id; ?>">
                                <img class="Images_Recherches Pointer" title="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                            </td>
                        <?php } else { ?>
                            <td>
                                <img class="Images_Recherches" title="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
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


        <?php
    }

}

$class = new SQL_Recherche_Joueurs();
$class->run();
