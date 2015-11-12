<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Recherche_IP extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    
    public function run() {
        ?>
        

        <?php if (!empty($_SESSION["Administration_PannelAdmin_Jeton"])) { ?>

            <?php
            /* ------------------------ Vérification Données ---------------------------- */
            $Recuperation_Droits = "SELECT * 
                            FROM site.administration_users
                            WHERE id_compte = :id_compte
                            LIMIT 1";
            $Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
            $Parametres_Recuperation_Droits->execute(array(':id_compte' => $this->objAccount->getId()));
            $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>

            <?php if ($Nombre_De_Resultat_Recuperation_Droits != 0) { ?>
                <?php $Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch(); ?>

                <?php if ($Donnees_Recuperation_Droits->recherche_ip == 1) { ?>

                    <?php
                    //Requète qui recupère les joueurs du jeu
                    $Listage_Joueur = "SELECT account.login,
                                  account.email,
								  player.level,
                                  player.id,
                                  player.gold,
                                  player.job,
                                  player.ip,
								  player.last_play,
                                  player_index.empire,
								  account.cash,
								  player.name,
                                  account.status
                           FROM player.player
                           LEFT JOIN account.account
                           ON account.id = player.account_id
                           LEFT JOIN player.player_index
                           ON account.id = player_index.id
                           ORDER by player.ip ASC
                           LIMIT 0, 30";
                    $Parametres_Listage_Joueur = $this->objConnection->prepare($Listage_Joueur);
                    $Parametres_Listage_Joueur->execute();
                    $Parametres_Listage_Joueur->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Listage_Joueur = $Parametres_Listage_Joueur->rowCount();
                    ?>

                    <div class="box box-default flat">

                        <div class="box-header">
                            <h3 class="box-title">Recherche d'IP</h3>
                        </div>

                        <div class="box-body no-padding">
                            <form action="javascript:void(0);" name="Recherche_Joueurs" onsubmit="Declenchement_Recherche('player.name');" id="Form_Rechercher_Joueurs" class="Form_Recherche_Joueurs">
                                <input type="text" placeholder="Nom de compte..." id="Input_Rechercher_Joueurs" class="Input_Rechercher_Joueurs" autofocus />
                                <input type="submit" valu="Rechercher" id="Bouton_Rechercher_Joueurs" class="Bouton_Rechercher_Joueurs" />
                                <div id="Nombre_De_Resultat_Recherches" class="Nombre_De_Resultat_Recherches">
                                    Faites une recherche...
                                </div>
                                <div class="Choix_Grandeur" id="Choix_Grandeur">
                                    <input type="radio" class="Input_Radio_Recherches" name="grandeur" value="ASC" checked> Croissant<br/>
                                    <input type="radio" class="Input_Radio_Recherches" name="grandeur" value="DESC"> Décroissant
                                </div>
                            </form>

                            <table class="table table-condensed" style="border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th onclick="Declenchement_Recherche('account.login')" data-tooltip="Trier par le nom de compte" class="Pointer Cellule_Pseudonyme">Compte</th>
                                        <th onclick="Declenchement_Recherche('account.email')" data-tooltip="Trier par email du compte" class="Pointer Cellule_Compte">Email</th>
                                        <th onclick="Declenchement_Recherche('player.name')" data-tooltip="Trier par pseudo du compte" class="Pointer Cellule_Level">Pseudo</th>
                                        <th onclick="Declenchement_Recherche('player_index.empire')" data-tooltip="Trier par empire du joueur" class="Pointer Cellule_Empire">Emp.</th>
                                        <th onclick="Declenchement_Recherche('player.ip')" data-tooltip="Trier par IP du joueur" class="Pointer Cellule_IP">Date</th>
                                        <th onclick="Declenchement_Recherche('account.status')" data-tooltip="Trier par status du compte du joueur" class="Pointer Cellule_Status">Sta.</th>
                                    </tr>
                                </thead>
                                <tbody id="Tbody_Recherches">
                                    <?php if ($Nombre_De_Resultat_Listage_Joueur != 0) { ?>
                                        <?php while ($Donnees_Listage_Joueur = $Parametres_Listage_Joueur->fetch()) { ?>
                                            <tr>
                                                <td><?= $Donnees_Listage_Joueur->login; ?></td>
                                                <td><?= $Donnees_Listage_Joueur->email; ?></td>
                                                <td><?= $Donnees_Listage_Joueur->name; ?></td>
                                                <td>
                                                    <?php echo \FonctionsUtiles::FindIconeEmpire($Donnees_Listage_Joueur->empire); ?>
                                                </td>
                                                <td><?= $Donnees_Listage_Joueur->last_play; ?></td>

                                                <?php if ($Donnees_Listage_Joueur->status == "OK") { ?>
                                                    <?php if ($Donnees_Recuperation_Droits->bannissement == 1) { ?>
                                                        <td id="Personnage_ID_<?php echo $Donnees_Listage_Joueur->id; ?>" class="fancybox" data-fancybox-type="iframe" href="pages/Admin/includes/Bannissement.php?player_id=<?= $Donnees_Listage_Joueur->id; ?>">
                                                            <img class="Images_Recherches Pointer" data-tooltip="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <img class="Images_Recherches" data-tooltip="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                                        </td>
                                                    <?php } ?>
                                                <?php } else if ($Donnees_Listage_Joueur->status == "BLOCK") { ?>
                                                    <?php if ($Donnees_Recuperation_Droits->debannissement == 1) { ?>
                                                        <td id="Personnage_ID_<?php echo $Donnees_Listage_Joueur->id; ?>" class="fancybox" data-fancybox-type="iframe" href="pages/Admin/includes/Debannissement.php?player_id=<?= $Donnees_Listage_Joueur->id; ?>">
                                                            <img class="Images_Recherches Pointer" data-tooltip="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <img class="Images_Recherches" data-tooltip="<?= \FonctionsUtiles::Find_Title_Status($Donnees_Listage_Joueur->status) ?>" src="<?= \FonctionsUtiles::Find_Image_Status($Donnees_Listage_Joueur->status) ?>" height="20" />
                                                        </td>
                                                    <?php } ?>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr><td colspan="7">Aucun résultat n'as pu être affiché.</td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <script type="text/javascript">

                        function Declenchement_Recherche(param) {

                            Barre_De_Statut("Recherche en cours...");
                            Icone_Chargement(1);

                            if ($("#Input_Rechercher_Joueurs").val().trim().length > 2) {

                                $.ajax({
                                    type: "POST",
                                    url: "pages/Admin/ajax/SQL_Recherche_IP.php",
                                    data: "terme=" + $("#Input_Rechercher_Joueurs").val() + "&param=" + param + "&grandeur=" + $('input[type=radio][name=grandeur]:checked').attr('value'),
                                    success: function (retour_recherche) {

                                        if (retour_recherche.indexOf("Paramètre non-valide.") != -1) {

                                            Barre_De_Statut("Le paramètre de tri n'est pas valide.");
                                            Icone_Chargement(2);

                                        } else if (retour_recherche.indexOf("Interdiction_Acces") != -1) {
                                            Barre_De_Statut("Interdiction d'acces.");
                                            Icone_Chargement(2);
                                            Ajax('pages/Admin/Interdiction_Acces.php')
                                        } else {

                                            tableau_retour = retour_recherche.split("|");

                                            $("#Nombre_De_Resultat_Recherches").html("Il y a " + tableau_retour[0] + " résultat(s) pour votre recherche.");

                                            $("#Tbody_Recherches").fadeOut("fast", function () {
                                                $("#Tbody_Recherches").html(tableau_retour[1]);
                                                Barre_De_Statut("Recherche terminé.");
                                                Icone_Chargement(0);
                                                $("#Tbody_Recherches").fadeIn("fast");
                                            });
                                        }
                                    }
                                });
                                return false;

                            } else {
                                Barre_De_Statut("Recherche trop courte.");
                                Icone_Chargement(2);
                            }

                        }

                        $(document).ready(function () {
                            $(".fancybox").fancybox({
                                minWidth: 800,
                                minHeight: 540,
                                maxHeight: 540,
                                padding: 0,
                                closeBtn: false,
                                scrolling: 'no',
                                scrollOutside: false,
                                fitToView: true,
                                autoSize: false,
                                closeClick: false,
                                openEffect: 'elastic',
                                closeEffect: 'elastic',
                                openSpeed: 400,
                                closeSpeed: 200
                            });
                        });

                    </script>

                <?php } else { ?>
                    <?php include 'Interdiction_Acces.php'; ?>
                <?php } ?>
            <?php } else { ?>
                <?php include 'Interdiction_Acces.php'; ?>
            <?php } ?>
        <?php } else { ?>
            <?php include 'Interdiction_Acces.php'; ?>
        <?php } ?>
        <?php
    }

}

$class = new Recherche_IP();
$class->run();
