<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Procedure_Bannissement extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {

        global $request;
        
        $raison = $request->request->get("raison");
        $id_raison = $request->request->get("id_raison");
        $id_compte = $request->request->get("id_compte");
        $commentaire = $request->request->get("commentaire");
        $this->objConnection_Ip = $request->server->get("REMOTE_ADDR");

        if ($Donnees_Recuperation_Raison->sanction == 999) { ?>
                <?php $Definitif = '1'; ?>
            <?php } else { ?>
                <?php $Definitif = '0'; ?>
                <?php

            }


            $Insertion_Logs = "INSERT INTO site.bannissements_actifs (id_compte, date_debut_bannissement, date_fin_bannissement, raison_bannissement, commentaire_bannissement, id_compte_gm, ip_gm, duree, definitif) 
                          VALUES (:id_compte, NOW(), (NOW() + INTERVAL $Donnees_Recuperation_Raison->sanction DAY), :raison_bannissement, :commentaire_bannissement, :id_compte_gm, :ip_gm, :duree, :definitif)";

            $Paremetres_Insertion = $this->objConnection->prepare($Insertion_Logs);
            $Paremetres_Insertion->execute(array(
                ':id_compte' => $id_compte,
                ':raison_bannissement' => $id_raison,
                ':commentaire_bannissement' => $commentaire,
                ':id_compte_gm' => $this->objAccount->getId(),
                ':ip_gm' => $this->objConnection_Ip,
                ':duree' => $Donnees_Recuperation_Raison->sanction,
                ':definitif' => $Definitif,
            ));
            /* ----------------------------------------------------------------------------------------------------------------------------------- */


            $Tableau_Retour_Json = array(
                'result' => "WIN",
                'id_compte' => $id_compte,
                'reasons' => "Le bannissement est effectif."
            );

        echo json_encode($Tableau_Retour_Json);
        

    }

}

$class = new SQL_Procedure_Bannissement();
$class->run();
