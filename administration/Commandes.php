<?php

namespace Administration;

require __DIR__ . '../../core/initialize.php';

class Commandes extends \PageHelper {

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
            $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
            $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>

            <?php if ($Nombre_De_Resultat_Recuperation_Droits != 0) { ?>
                <?php $Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch(); ?>

                <?php if ($Donnees_Recuperation_Droits->commandes == 1) { ?>

                    <?php
                    //Requète qui recupère les joueurs du jeu
                    $Listate_Commandes = "SELECT *
                           FROM $BDD_Log.commandes_gm
						   WHERE ( not (username like '[Admin]%' ))
						   AND ( not (username like '[Dev]%' ))
						   AND ( not (username like '[TM]Faylinn' ))
						   AND ( not (username like 'TESTFaylinn' ))
						   AND ( not (username like 'SWATFaylinn' ))
						   AND ( not (username like 'TestFaylinn' ))
						   AND ( not (username like 'FaylinnTest' ))
						   AND ( not (command like 'r' ))
						   AND ( not (command like 'inv' ))
						   AND ( not (command like 'priv_empire%' ))
						   AND ( not (command like 'gm_on' ))
						   AND ( not (command like 'gm_off' ))
                           ORDER by commandes_gm.date DESC
                           LIMIT 0, 300";
                    $Parametres_Listate_Commandes = $this->objConnection->prepare($Listate_Commandes);
                    $Parametres_Listate_Commandes->execute();
                    $Parametres_Listate_Commandes->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Listate_Commandes = $Parametres_Listate_Commandes->rowCount();
                    ?>

                    <div class="Cadre_Principal">
                        <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal(1);">                  
                            <h1>Historique des commandes de l'équipe</h1>
                        </div>
                        <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 

                            <table id="Table_Recherche_Joueurs" class="Table_Recherche_Joueurs Table_Recherches">
                                <thead>
                                    <tr>
                                        <th onclick="Declenchement_Recherche('player.name')" title="Trier par pseudonyme du joueur" class="Pointer Cellule_Pseudonyme">Pseudonyme</th>
                                        <th onclick="Declenchement_Recherche('account.login')" title="Trier par compte du joueur" class="Pointer Cellule_Compte">Commande</th>
                                        <th onclick="Declenchement_Recherche('player.playtime')" title="Trier par temps de jeu du joueur" class="Pointer Cellule_Level">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="Tbody_Recherches">
                                    <?php if ($Nombre_De_Resultat_Listate_Commandes != 0) { ?>
                                        <?php while ($Donnees_Listate_Commandes = $Parametres_Listate_Commandes->fetch()) { ?>
                                            <tr>
                                                <td><?= $Donnees_Listate_Commandes->username; ?></td>
                                                <td><?= $Donnees_Listate_Commandes->command; ?></td>
                                                <td><?= $Donnees_Listate_Commandes->date; ?></td>
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
                                    url: "administration/ajax/SQL_Recherche_Joueurs_Admin.php",
                                    data: "terme=" + $("#Input_Rechercher_Joueurs").val() + "&param=" + param + "&grandeur=" + $('input[type=radio][name=grandeur]:checked').attr('value'),
                                    success: function (retour_recherche) {

                                        if (retour_recherche.indexOf("Paramètre non-valide.") != -1) {

                                            Barre_De_Statut("Le paramètre de tri n'est pas valide.");
                                            Icone_Chargement(2);

                                        } else if (retour_recherche.indexOf("Interdiction_Acces") != -1) {
                                            Barre_De_Statut("Interdiction d'acces.");
                                            Icone_Chargement(2);
                                            Ajax('administration/Interdiction_Acces.php')
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

$class = new Commandes();
$class->run();
