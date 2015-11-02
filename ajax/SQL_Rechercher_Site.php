<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Rechercher_Site extends \PageHelper {

    public function run() {
        $Id_site = $_POST['id_site'];

        /* ------------------------ Vérification Données ---------------------------- */
        $Rechercher_Lien_Site_Vote = "SELECT lien_site_vote FROM site.votes_liste_sites
                                  WHERE id_site_vote = ?
                                  LIMIT 1";
        $Parametres_Rechercher_Lien_Site_Vote = $this->objConnection->prepare($Rechercher_Lien_Site_Vote);
        $Parametres_Rechercher_Lien_Site_Vote->execute(array(
            $Id_site));
        $Parametres_Rechercher_Lien_Site_Vote->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Rechercher_Lien_Site_Vote = $Parametres_Rechercher_Lien_Site_Vote->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat_Rechercher_Lien_Site_Vote != 0) {
            $Donnees_Rechercher_Lien_Site_Vote = $Parametres_Rechercher_Lien_Site_Vote->fetch();
            echo $Donnees_Rechercher_Lien_Site_Vote->lien_site_vote;
        }
    }

}

$class = new SQL_Rechercher_Site();
$class->run();
