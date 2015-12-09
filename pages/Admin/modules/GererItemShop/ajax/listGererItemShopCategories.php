<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../../../core/initialize.php';

class listGererItemShopCategories extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'ItemshopCategoriesEntity.nom',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopCategoriesEntity.nom',
                'dtField' => 'categorie',
            ),
            array(
                'dbField' => 'ItemshopCategoriesEntity.description',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopCategoriesEntity.description',
                'dtField' => 'description',
            ),
            array(
                'dbField' => 'ItemshopCategoriesEntity.cat',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopCategoriesEntity.cat',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" data-featherlight="ajax" href="pages/Admin/modules/GererItemShop/GererItemShopCategoriesEdit.php?mode=mod&idCategorie=' . $d . '" data-tooltip="Modifier"><i class="material-icons md-icon-edit"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-danger btn-sm " data-tooltip="Supprimer" onclick="SuppressionCategorie(' . $d . ')"><i class="material-icons md-icon-delete"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\ItemshopCategories", "ItemshopCategoriesEntity");

        $datatable->getResult()->toJson();
    }

}

$class = new listGererItemShopCategories();
$class->run();
