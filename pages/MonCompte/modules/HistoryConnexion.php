<?php

namespace Pages;

require __DIR__ . '../../../../core/initialize.php';

class HistoryConnexion extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        
    ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Historique de vos connexions</h3>

            </div>

            <div class="box-body no-padding">

                <?php
                /* ------------------------ Listage Connexions ---------------------------- */
                $Listage_Connexions = "SELECT * 
                               FROM site.logs_connexion
                               WHERE id_compte = ?
                               OR compte = ?
                               ORDER BY date DESC
                               LIMIT 0, 20";
                $Parametres_Listage_Connexions = $this->objConnection->prepare($Listage_Connexions);
                $Parametres_Listage_Connexions->execute(array(
                    $this->objAccount->getId(),
                    $this->objAccount->getLogin()));
                $Parametres_Listage_Connexions->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Listage_Connexions = $Parametres_Listage_Connexions->rowCount();
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Recherche Pays ---------------------------- */
                $Recherche_Pays = "SELECT * 
                           FROM site.ip_to_country 
                           WHERE ? BETWEEN IP_FROM AND IP_TO ";
                $Parametres_Recherche_Pays = $this->objConnection->prepare($Recherche_Pays);
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Traduction Pays ---------------------------- */
                $Traduction_Pays = "SELECT country_name_fr 
                            FROM site.ip_pays_fr 
                            WHERE country_name = ?";
                $Parametres_Traduction_Pays = $this->objConnection->prepare($Traduction_Pays);
                /* -------------------------------------------------------------------------- */
                ?>
                <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;"> 
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Provenance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($Nombre_De_Resultat_Listage_Connexions != 0) { ?>

                            <?php while ($Donnees_Listage_Connexions = $Parametres_Listage_Connexions->fetch()) { ?>
                                <tr>
                                    <td style="line-height: 10px;">
                                        <?php if ($Donnees_Listage_Connexions->resultat == 1) { ?>
                                            <i class="material-icons md-icon-done text-green md-20"></i>
                                        <?php } else if ($Donnees_Listage_Connexions->resultat == 3) { ?>
                                            <i title="Compte banni" class="material-icons md-icon-lock text-red md-20"></i>
                                        <?php } else { ?>
                                            <i title="Connexion échouée" class="material-icons md-icon-close text-red md-20"></i>
                                        <?php } ?>

                                        <span style="vertical-align: super">
                                            <?= \FonctionsUtiles::Formatage_Date($Donnees_Listage_Connexions->date, true); ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= $Donnees_Listage_Connexions->ip; ?>
                                        <?php if ($Donnees_Listage_Connexions->ip != "") { ?>

                                            <?php $ip_formate = \FonctionsUtiles::ipAdressNumber($Donnees_Listage_Connexions->ip); ?>

                                            <?php
                                            $Parametres_Recherche_Pays->execute(array(
                                                $ip_formate));
                                            $Parametres_Recherche_Pays->setFetchMode(\PDO::FETCH_OBJ);
                                            $Nombre_De_Resultat_Recherche_Pays = $Parametres_Recherche_Pays->rowCount();
                                            $Donnees_Recherche_Pays = $Parametres_Recherche_Pays->fetch();

                                            $Nom_Pays_Original = $Donnees_Recherche_Pays->COUNTRY;
                                            $Lien_Drapeau = "images/drapeaux/" . strtolower($Donnees_Recherche_Pays->CTRY) . ".png";

                                            $Parametres_Traduction_Pays->execute(array(
                                                addslashes($Nom_Pays_Original)));
                                            $Parametres_Traduction_Pays->setFetchMode(\PDO::FETCH_OBJ);
                                            $Nombre_De_Resultat_Traduction_Pays = $Parametres_Traduction_Pays->rowCount();
                                            $Donnees_Traduction_Pays = $Parametres_Traduction_Pays->fetch();

                                            if ($Nombre_De_Resultat_Traduction_Pays != 0) {
                                                $Nom_Pays_Original = $Donnees_Traduction_Pays->country_name_fr;
                                            }
                                            ?>

                                            <?php if ($Nombre_De_Resultat_Recherche_Pays != 0) { ?>

                                                <span title="<?= $Nom_Pays_Original; ?>"><img src="<?= $Lien_Drapeau ?>" height="11"/></span>

                                            <?php } else { ?>
                                                Inconnu
                                            <?php } ?>
                                        </td>
                                    <?php } else { ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>
                            <tr><td colspan="">Il n'y a aucuns enregistrement dans votre historique de connexion.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

        </div>
        <?php
    }

}

$class = new HistoryConnexion();
$class->run();
