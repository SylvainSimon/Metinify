<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listHistoGererMonnaies extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'LogsAdminGererMonnaieEntity.idCompte',
                'dtField' => 'idCompte',
            ),
            array(
                'dbField' => 'AccountEntityUser.login',
                'dtField' => 'recepteur',
                'formatter' => function( $d, $row ) {
                    if ($row["idCompte"] == 0) {
                        return "Tout le monde";
                    } else {
                        return $d;
                    }
                }
            ),
            array(
                'dbField' => 'LogsAdminGererMonnaieEntity.date',
                'dtField' => 'date',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
                }
            ),
            array(
                'dbField' => 'AccountEntityAdmin.login',
                'dtField' => 'emetteur'
            ),
            array(
                'dbField' => 'LogsAdminGererMonnaieEntity.operation',
                'filterLevel' => 'strict',
                'dtField' => 'operation',
                'formatter' => function( $d, $row ) {
                    if ($d == 1) {
                        return "a donné";
                    } else {
                        return "a enlevé";
                    }
                }
            ),
            array(
                'dbField' => 'LogsAdminGererMonnaieEntity.montant',
                'filterLevel' => 'strict',
                'dtField' => 'montant'
            ),
            array(
                'dbField' => 'LogsAdminGererMonnaieEntity.devise',
                'filterLevel' => 'strict',
                'dtField' => 'devise',
                'formatter' => function( $d, $row ) {
                    return \DeviseHelper::getLibelle($d);
                }
            ),
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\LogsAdminGererMonnaie", "LogsAdminGererMonnaieEntity")
                ->leftJoin("\Account\Entity\Account", "AccountEntityUser", "WITH", "AccountEntityUser.id = LogsAdminGererMonnaieEntity.idCompte")
                ->innerJoin("\Account\Entity\Account", "AccountEntityAdmin", "WITH", "AccountEntityAdmin.id = LogsAdminGererMonnaieEntity.idGm");

        $datatable->getResult()->toJson();
    }

}

$class = new listHistoGererMonnaies();
$class->run();
