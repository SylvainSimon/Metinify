<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../../../core/initialize.php';

class listGererItemShopLogsAchats extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'LogsItemshopAchatsEntity.date',
                'dtField' => 'date',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
                }
            ),
            array(
                'dbField' => 'LogsItemshopAchatsEntity.item',
                'dtField' => 'article',
            ),
            array(
                'dbField' => 'LogsItemshopAchatsEntity.quantite',
                'filterLevel' => 'strict',
                'dtField' => 'quantite',
            ),
            array(
                'dbField' => 'LogsItemshopAchatsEntity.devise',
                'dtField' => 'devise',
            ),
            array(
                'dbField' => 'LogsItemshopAchatsEntity.prix',
                'filterLevel' => 'strict',
                'dtField' => 'prix',
                'formatter' => function( $d, $row ) {
                    return number_format($d, 0, '.', ',') . "<span style='position:relative; top:2px;'>" . \FonctionsUtiles::findIconDevise($row["devise"]) . "</span>";
                }
            ),
            array(
                'dbField' => 'AccountEntity.login',
                'dtField' => 'compte',
            ),
            array(
                'dbField' => 'LogsItemshopAchatsEntity.resultat',
                'dtField' => 'result',
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\LogsItemshopAchats", "LogsItemshopAchatsEntity")
                ->leftJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = LogsItemshopAchatsEntity.idCompte");


        $datatable->getResult()->toJson();
    }

}

$class = new listGererItemShopLogsAchats();
$class->run();
