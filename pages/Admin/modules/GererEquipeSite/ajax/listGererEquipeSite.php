<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../../../core/initialize.php';

class listGererEquipeSite extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'AccountEntity.login',
                'dtField' => 'compte',
            ),
            array(
                'dbField' => 'AdminsEntity.name',
                'dtField' => 'nom',
            ),
            array(
                'dbField' => 'AdminsEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" data-featherlight="ajax" data-featherlight-variant="featherLightbox_90" href="pages/Admin/modules/GererEquipeSite/GererEquipeSiteEdit.php?mode=mod&idAdmins=' . $d . '"><i class="material-icons md-icon-edit"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-danger btn-sm " onclick="SuppressionMembreEquipeSite(' . $d . ')"><i class="material-icons md-icon-delete"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\Admins", "AdminsEntity")
                ->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = AdminsEntity.idCompte");

        $datatable->getResult()->toJson();
    }

}

$class = new listGererEquipeSite();
$class->run();
