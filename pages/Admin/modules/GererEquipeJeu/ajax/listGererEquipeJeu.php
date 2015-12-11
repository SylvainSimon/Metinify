<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../../../core/initialize.php';

class listGererEquipeJeu extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'PlayerEntity.name',
                'dtField' => 'name',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconJob($row["job"]) . " " . $d;
                }
            ),
            array(
                'dbField' => 'AccountEntity.login',
                'dtField' => 'compte',
            ),
            array(
                'dbField' => 'PlayerEntity.job',
                'dtField' => 'job',
            ),
            array(
                'dbField' => 'GmlistEntity.mauthority',
                'dtField' => 'authority',
                'formatter' => function( $d, $row ) {
                    return \AuthorityHelper::getLibelle($d);
                }
            ),
            array(
                'dbField' => 'PlayerEntity.playtime',
                'dtField' => 'playtime',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::minutesToString($d);
                }
            ),
            array(
                'dbField' => 'PlayerEntity.lastPlay',
                'dtField' => 'lastPlay',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
                }
            ),
            array(
                'dbField' => 'AccountEntity.status',
                'filterLevel' => 'strict',
                'dtField' => 'status',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconStatus($d);
                }
            ),
            array(
                'dbField' => 'PlayerEntity.ip',
                'dtField' => 'ip',
            ),
            array(
                'dbField' => 'GmlistEntity.mid',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" data-featherlight="ajax" href="pages/Admin/modules/GererEquipeJeu/GererEquipeJeuEdit.php?mode=mod&idMembre=' . $d . '"><i class="material-icons md-icon-edit"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-danger btn-sm " onclick="SuppressionMembreEquipe(' . $d . ')"><i class="material-icons md-icon-delete"></i></a>';

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

$class = new listGererEquipeJeu();
$class->run();
