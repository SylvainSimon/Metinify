<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listHistoGererMonnaies extends \ScriptHelper {

    public function run() {

        if($_GET["sEcho"] == 1){
            exit();
        }
        
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
                'dbField' => 'AccountEntity.login',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.login',
                'dtField' => 'compte',
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
            ),
            array(
                'dbField' => 'PlayerEntity.gold',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerEntity.gold',
                'dtField' => 'yangs',
                'formatter' => function( $d, $row ) {
                    return number_format($d, 0, '.', ',');
                }
            ),
            array(
                'dbField' => 'PlayerIndexEntity.empire',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerIndexEntity.empire',
                'dtField' => 'empire',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconEmpire($d);
                }
            ),
            array(
                'dbField' => 'AccountEntity.status',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.status',
                'dtField' => 'status',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconStatus($d);
                }
            ),
            array(
                'dbField' => 'PlayerEntity.ip',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerEntity.ip',
                'dtField' => 'ip',
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
