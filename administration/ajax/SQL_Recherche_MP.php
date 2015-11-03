<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class SQL_Recherche_MP extends \PageHelper {

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

                <?php if ($Donnees_Recuperation_Droits->recherche_comptes == 1) { ?>

                    <?php
                    $Terme_A_Recherche = $_POST["terme"];
                    $Param_Recherche = $_POST["param"];
                    $Param_Grandeur = $_POST["grandeur"];

                    $Tableau_Grandeurs = array("ASC", "DESC");
                    $Tableau_Parametres = array("messages_prives.de", "messages_prives.destinataire", "messages_prives.message");

                    if (in_array($Param_Recherche, $Tableau_Parametres)) {

                        if (in_array($Param_Grandeur, $Tableau_Grandeurs)) {

                            $Listage_Joueur = "SELECT *
							   FROM $BDD_Log.messages_prives
                               WHERE messages_prives.de LIKE ? '%'
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
                                <td><?= $Donnees_Listage_Joueur->de; ?></td>
                                <td><?= $Donnees_Listage_Joueur->destinataire; ?></td>
                                <td><?= $Donnees_Listage_Joueur->message; ?></td>
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

$class = new SQL_Recherche_MP();
$class->run();
