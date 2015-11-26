<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listGererEquipe extends \ScriptHelper {

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
                'dbField' => 'GmlistEntity.mauthority',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GmlistEntity.mauthority',
                'dtField' => 'authority',
                'formatter' => function( $d, $row ) {
                    return \AuthorityHelper::getLibelle($d);
                }
            ),
            array(
                'dbField' => 'PlayerEntity.playtime',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerEntity.playtime',
                'dtField' => 'playtime',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::minutesToString($d);
                }
            ),
            array(
                'dbField' => 'PlayerEntity.lastPlay',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerEntity.lastPlay',
                'dtField' => 'lastPlay',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
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
            ),
            array(
                'dbField' => 'GmlistEntity.mid',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GmlistEntity.mid',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" data-featherlight="ajax" href="pages/Admin/GererEquipeEdit.php?mode=mod&idMembre=' . $d . '" data-tooltip="Modifier"><i class="material-icons md-icon-edit"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-danger btn-sm " data-tooltip="Supprimer" onclick="SuppressionMembreEquipe(' . $d . ')"><i class="material-icons md-icon-delete"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Common\Entity\Gmlist", "GmlistEntity")
                ->innerJoin("\Player\Entity\Player", "PlayerEntity", "WITH", "PlayerEntity.name = GmlistEntity.mname")
                ->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.login = GmlistEntity.maccount");

        $datatable->getResult()->toJson();
    }

}

$class = new listGererEquipe();
$class->run();
