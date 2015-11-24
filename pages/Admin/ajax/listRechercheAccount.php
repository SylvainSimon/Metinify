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
                'dbField' => 'AccountEntity.login',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.login',
                'dtField' => 'compte',
            ),
            array(
                'dbField' => 'AccountEntity.email',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.email',
                'dtField' => 'email',
            ),
            array(
                'dbField' => 'AccountEntity.cash',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.cash',
                'dtField' => 'cash',
                'formatter' => function( $d, $row ) {
                    return number_format($d, 0, '.', ',') . "<span style='position:relative; top:2px;'>".\FonctionsUtiles::findIconDevise(\DeviseHelper::CASH)."</span>";
                }
            ),
            array(
                'dbField' => 'AccountEntity.mileage',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.mileage',
                'dtField' => 'mileage',
                'formatter' => function( $d, $row ) {
                    return number_format($d, 0, '.', ',') . "<span style='position:relative; top:2px;'>".\FonctionsUtiles::findIconDevise(\DeviseHelper::MILEAGE)."</span>";
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
                'dbField' => 'AccountEntity.ipCreation',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.ipCreation',
                'dtField' => 'ip',
            )
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Account\Entity\Account", "AccountEntity")
                ->leftJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");

        $datatable->getResult()->toJson();
    }

}

$class = new listHistoGererMonnaies();
$class->run();
