<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../../../core/initialize.php';

class listGererItemShopLogsAchats extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'LogAchatsEntity.date',
                'dtField' => 'date',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
                }
            ),
            array(
                'dbField' => 'LogAchatsEntity.item',
                'dtField' => 'article',
            ),
            array(
                'dbField' => 'LogAchatsEntity.quantite',
                'filterLevel' => 'strict',
                'dtField' => 'quantite',
            ),
            array(
                'dbField' => 'LogAchatsEntity.monnaie',
                'dtField' => 'monnaie',
            ),
            array(
                'dbField' => 'LogAchatsEntity.prix',
                'filterLevel' => 'strict',
                'dtField' => 'prix',
                'formatter' => function( $d, $row ) {
                    return number_format($d, 0, '.', ',') . "<span style='position:relative; top:2px;'>" . \FonctionsUtiles::findIconDevise($row["monnaie"]) . "</span>";
                }
            ),
            array(
                'dbField' => 'AccountEntity.login',
                'dtField' => 'compte',
            ),
            array(
                'dbField' => 'LogAchatsEntity.resultat',
                'dtField' => 'result',
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\LogAchats", "LogAchatsEntity")
                ->leftJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = LogAchatsEntity.idCompte");


        $datatable->getResult()->toJson();
    }

}

$class = new listGererItemShopLogsAchats();
$class->run();
