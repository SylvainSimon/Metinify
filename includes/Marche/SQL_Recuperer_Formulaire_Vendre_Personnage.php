<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class SQL_Recuperer_Formulaire_Vendre_Personnage extends \PageHelper {

    public function run() {
        ?>
        
        <?php
        $Id_Personnage = $_POST["id_personnage"];

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT player.name 
                         FROM player.player
                         WHERE id = ?
                         AND account_id = ?
                         LIMIT 1";
        $Parametres_Verification_Donnees = $this->objConnection->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $Id_Personnage,
            $_SESSION["ID"]));
        $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>

        <?php if ($Nombre_De_Resultat != 0) { ?>

            <?php
            /* ------------------------ Vérification Données ---------------------------- */
            $Recuperation_Devises = "SELECT marche_devises.devise, marche_devises.id AS id_devise
                             FROM site.marche_devises";
            $Parametres_Recuperation_Devises = $this->objConnection->prepare($Recuperation_Devises);
            $Parametres_Recuperation_Devises->execute();
            $Parametres_Recuperation_Devises->setFetchMode(\PDO::FETCH_OBJ);
            /* -------------------------------------------------------------------------- */
            ?>

            <?php $Donnees_Verification_Donnees = $Parametres_Verification_Donnees->fetch(); ?>

            <form id="Formulaire_Vente_Personnage" class="Formulaire_Vente_Personnage">

                <table class="Tableau_Formulaire_Vente_Personnage">
                    <tr>
                        <td class="Colonne_Gauche">Personnage : </td>
                        <td colspan="2">
                            <input type="text" id="Input_Vendre_Personnage_Personnage" maxlength="60" value="<?= $Donnees_Verification_Donnees->name; ?>" disabled />
                        </td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche" >Titre de votre article : </td>
                        <td colspan="2">
                            <input type="text" id="Input_Vendre_Personnage_Titre" maxlength="43" placeholder="Titre de votre article" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche" >Description de l'article : </td>
                        <td colspan="2">
                            <textarea id="Textarea_Vendre_Personnage_Description" class="Textarea_Vendre_Personnage_Description" maxlength="140" placeholder="Description de votre article" /></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Prix :
                        </td>
                        <td>
                            <input type="text" id="Prix_Vente_Personnage" placeholder="Prix..."/> 
                        </td>
                        <td>
                            <select id="Selecteur_Devise_Vente_Personnage" class="Selecteur_Devise_Vente_Personnage">
                                <?php while ($Donnees_Recuperation_Devises = $Parametres_Recuperation_Devises->fetch()) { ?>
                                    <option value="<?php echo $Donnees_Recuperation_Devises->id_devise; ?>"><?php echo $Donnees_Recuperation_Devises->devise; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="Bouton_Vendre_Personnage" onclick="Mettre_En_Vente()">
                                Mettre mon personnage en vente    
                            </div>
                        </td>
                    </tr>
                </table>
            </form>

            <script type="text/javascript">

                function Mettre_En_Vente() {

                    if ($("#Prix_Vente_Personnage").val() < 2000) {

                        window.parent.Barre_De_Statut("Le prix minimum est de 2 000 monnaies.");
                        window.parent.Icone_Chargement(2);

                    } else {

                        window.parent.Barre_De_Statut("Mise en vente...");
                        window.parent.Icone_Chargement(1);

                        $.ajax({
                            type: "POST",
                            url: "SQL_Mettre_En_Vente.php",
                            data: "id_personnage=<?= $Id_Personnage ?>&texte_titre=" + $("#Input_Vendre_Personnage_Titre").val() + "&texte_description=" + $("#Textarea_Vendre_Personnage_Description").val() + "&prix=" + $("#Prix_Vente_Personnage").val() + "&id_devise=" + $("#Selecteur_Devise_Vente_Personnage").val(),
                            success: function (msg) {

                                try {

                                    Parse_Json = JSON.parse(msg);

                                    if (Parse_Json.result == "WIN") {

                                        window.parent.Barre_De_Statut("Mise en vente réussi.");
                                        window.parent.Icone_Chargement(0);

                                        Ajax_Appel_Marche('Marche_Place.php');

                                    } else if (Parse_Json.result == "FAIL") {

                                        window.parent.Barre_De_Statut(Parse_Json.reasons);
                                        window.parent.Icone_Chargement(2);
                                    }

                                } catch (e) {

                                    window.parent.Barre_De_Statut("La mise en vente a échoué.");
                                    window.parent.Icone_Chargement(2);
                                }
                            }
                        });
                    }
                    return false;
                }

            </script>

        <?php } else { ?>

            <?= "0"; ?>

        <?php } ?>

        <?php
    }

}

$class = new SQL_Recuperer_Formulaire_Vendre_Personnage();
$class->run();
