<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class SQL_Recuperer_Recidive extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    
    public function run() {

        $Raison = $_POST["raison"];

        /* ------------------------ Vérification Recidive ---------------------------- */
        $Recuperation_Recidive = "SELECT * 
                          FROM site.bannissement_raisons
                          WHERE bannissement_raisons.raison = :raison";
        $Parametres_Recuperation_Recidive = $this->objConnection->prepare($Recuperation_Recidive);
        $Parametres_Recuperation_Recidive->execute(array(':raison' => $Raison));
        $Parametres_Recuperation_Recidive->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recuperation_Recidive = $Parametres_Recuperation_Recidive->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>
        <?php if ($Nombre_De_Resultat_Recuperation_Recidive > 1) { ?> 

            <?php while ($Donnees_Recuperation_Recidive = $Parametres_Recuperation_Recidive->fetch()) { ?>
                <?php
                if ($Donnees_Recuperation_Recidive->recidive == 1) {
                    $Nomination_Recidive = "Première fois";
                } else if ($Donnees_Recuperation_Recidive->recidive == 2) {
                    $Nomination_Recidive = "Deuxième fois";
                } else if ($Donnees_Recuperation_Recidive->recidive == 3) {
                    $Nomination_Recidive = "Troisième fois";
                } else if ($Donnees_Recuperation_Recidive->recidive == 4) {
                    $Nomination_Recidive = "Quatrième fois";
                } else if ($Donnees_Recuperation_Recidive->recidive == 5) {
                    $Nomination_Recidive = "Cinquième fois";
                }
                ?>
                <option value="<?= $Donnees_Recuperation_Recidive->id ?>"><?= $Nomination_Recidive; ?></option>

            <?php } ?>

        <?php } else { ?>
            <?php $Donnees_Recuperation_Recidive = $Parametres_Recuperation_Recidive->fetch(); ?>
            <option value="<?= $Donnees_Recuperation_Recidive->id ?>">Première et dernière fois</option>
        <?php } ?>
        <?php
    }

}

$class = new SQL_Recuperer_Recidive();
$class->run();
