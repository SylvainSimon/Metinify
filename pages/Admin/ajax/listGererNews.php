<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listGererNews extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'ActualitesEntity.date',
                'dtField' => 'date',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
                }
            ),
            array(
                'dbField' => 'ActualitesEntity.titre',
                'dtField' => 'titre',
            ),
            array(
                'dbField' => 'ActualitesEntity.contenu',
                'dtField' => 'message',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::Raccourcissement_Chaine($d, 50);
                }
            ),
            array(
                'dbField' => 'AccountEntity.login',
                'dtField' => 'compte',
            ),
            array(
                'dbField' => 'ActualitesEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" data-featherlight="ajax" href="pages/Admin/GererNewsEdit.php?mode=mod&idNews=' . $d . '"><i class="material-icons md-icon-edit"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-danger btn-sm" onclick="SuppressionNews(' . $d . ')"><i class="material-icons md-icon-delete"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\Actualites", "ActualitesEntity")
                ->leftJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = ActualitesEntity.idCompte");

        $datatable->getResult()->toJson();
    }

}

$class = new listGererNews();
$class->run();
