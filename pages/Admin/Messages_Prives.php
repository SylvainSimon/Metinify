<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Messages_Prives extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    
    public function run() {
        
        if (!empty($_SESSION["Administration_PannelAdmin_Jeton"])) { ?>

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

                <?php if ($Donnees_Recuperation_Droits->mp == 1) { ?>

                    <?php
                    //Requète qui recupère les joueurs du jeu
                    $Listage_Joueur = "SELECT *
                           FROM log.messages_prives
						   ORDER BY date DESC
                           LIMIT 0, 200";
                    $Parametres_Listage_Joueur = $this->objConnection->prepare($Listage_Joueur);
                    $Parametres_Listage_Joueur->execute();
                    $Parametres_Listage_Joueur->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Listage_Joueur = $Parametres_Listage_Joueur->rowCount();
                    ?>

                    <div class="box box-default flat">

                        <div class="box-header">
                            <h3 class="box-title">Historique des messages privés</h3>
                        </div>

                        <div class="box-body no-padding">

                            <table class="table table-condensed" style="border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th onclick="Declenchement_Recherche('messages_prives.de')" title="Trier par le nom de compte" class="Pointer Cellule_Pseudonyme">De</th>
                                        <th onclick="Declenchement_Recherche('messages_prives.destinaire')" title="Trier par email du compte" class="Pointer Cellule_Compte">Pour</th>
                                        <th onclick="Declenchement_Recherche('messages_prives.message')" title="Trier par vamonaies du compte" class="Pointer Cellule_IP">Contenu du message privé</th>
                                    </tr>
                                </thead>
                                <tbody id="Tbody_Recherches">
                                    <?php if ($Nombre_De_Resultat_Listage_Joueur != 0) { ?>
                                        <?php while ($Donnees_Listage_Joueur = $Parametres_Listage_Joueur->fetch()) { ?>
                                            <tr>
                                                <td><?= $Donnees_Listage_Joueur->de; ?></td>
                                                <td><?= $Donnees_Listage_Joueur->destinataire; ?></td>
                                                <td><?= $Donnees_Listage_Joueur->message; ?></td>

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
                                    url: "pages/Admin/ajax/SQL_Recherche_MP.php",
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

$class = new Messages_Prives();
$class->run();
