<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listHistoGererMonnaies extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'PlayerEntity.name',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerEntity.name',
                'dtField' => 'name',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconJob($row["job"]) . " " . $d;
                }
            ),
            array(
                'dbField' => 'PlayerEntity.job',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerEntity.job',
                'dtField' => 'job',
            ),
            array(
                'dbField' => 'PlayerEntity.level',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerEntity.level',
                'dtField' => 'level',
            )
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Player\Entity\Player", "PlayerEntity")
                ->leftJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = PlayerEntity.idAccount")
                ->leftJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");

        $datatable->getResult()->toJson();
    }

}

$class = new listHistoGererMonnaies();
$class->run();
