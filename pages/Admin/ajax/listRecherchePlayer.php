<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listHistoGererMonnaies extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {

        if ($_GET["sEcho"] == 1) {
            exit();
        }

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
                'dbField' => 'PlayerEntity.level',
                'filterLevel' => 'strict',
                'dtField' => 'level',
            ),
            array(
                'dbField' => 'PlayerEntity.gold',
                'dtField' => 'yangs',
                'formatter' => function( $d, $row ) {
                    return number_format($d, 0, '.', ',');
                }
            ),
            array(
                'dbField' => 'PlayerIndexEntity.empire',
                'filterLevel' => 'strict',
                'dtField' => 'empire',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconEmpire($d);
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
                'dbField' => 'AccountEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = "";

                    if ($row["status"] == \StatusHelper::ACTIF) {
                        if ($this->HaveTheRight(\DroitsHelper::BANNISSEMENT)) {
                            $varButton = '<a class="btn btn-material btn-danger btn-sm" data-featherlight="ajax" href="pages/Admin/BannissementAddForm.php?idAccount=' . $d . '" data-tooltip="Bannir"><i class="material-icons md-icon-lock"></i></a>';
                        }
                    }

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
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
