<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listGererNews extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'AdminNewsEntity.date',
                'dbConcatSeparator' => ", ",
                'dbType' => "",
                'dbSortField' => 'AdminNewsEntity.date',
                'dtField' => 'date',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
                }
            ),
            array(
                'dbField' => 'AdminNewsEntity.titreMessage',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AdminNewsEntity.titreMessage',
                'dtField' => 'titre',
            ),
            array(
                'dbField' => 'AdminNewsEntity.contenueMessage',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AdminNewsEntity.contenueMessage',
                'dtField' => 'message',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::Raccourcissement_Chaine($d, 50);
                }
            ),
            array(
                'dbField' => 'AccountEntity.login',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.login',
                'dtField' => 'auteur',
            ),
            array(
                'dbField' => 'AdminNewsEntity.id',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AdminNewsEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" data-featherlight="ajax" href="pages/Admin/GererNewsEdit.php?mode=mod&idNews=' . $d . '" data-tooltip="Modifier"><i class="material-icons md-icon-edit"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-danger btn-sm " data-tooltip="Supprimer" onclick="SuppressionNews(' . $d . ')"><i class="material-icons md-icon-delete"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\AdminNews", "AdminNewsEntity")
                ->leftJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = AdminNewsEntity.auteur");

        $datatable->getResult()->toJson();
    }

}

$class = new listGererNews();
$class->run();