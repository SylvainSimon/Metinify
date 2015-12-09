<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../../../core/initialize.php';

class listGererItemShopArticles extends \ScriptHelper {

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'ItemshopEntity.nameItem',
                'dbConcatSeparator' => ", ",
                'dbType' => "",
                'dbSortField' => 'ItemshopEntity.nameItem',
                'dtField' => 'article',
            ),
            array(
                'dbField' => 'ItemshopEntity.nbItem',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopEntity.nbItem',
                'dtField' => 'nombre',
                'formatter' => function( $d, $row ) {
                    if ($row["type"] == "2") {
                        if ($d == 9999) {
                            return "A vie";
                        } else {
                            return $d . " jours";
                        }
                    } else {
                        return $d;
                    }
                }
            ),
            array(
                'dbField' => 'ItemshopCategoriesEntity.nom',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopCategoriesEntity.nom',
                'dtField' => 'categorie',
            ),
            array(
                'dbField' => 'ItemshopEntity.prix',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopEntity.prix',
                'dtField' => 'prix',
                'formatter' => function( $d, $row ) {
                    if ($row["type"] == "1") {
                        return number_format($d, 0, ",", " ") . " <span style='position: relative; top:3px;'>" . \FonctionsUtiles::findIconDevise(\DeviseHelper::CASH) . "</span>";
                    } elseif ($row["type"] == "2") {
                        return number_format($d, 0, ",", " ") . " <span style='position: relative; top:3px;'>" . \FonctionsUtiles::findIconDevise(\DeviseHelper::CASH) . "</span>";
                    } elseif ($row["type"] == "3") {
                        return number_format($d, 0, ",", " ") . " <span style='position: relative; top:3px;'>" . \FonctionsUtiles::findIconDevise(\DeviseHelper::MILEAGE);
                    }
                }
            ),
            array(
                'dbField' => 'ItemshopEntity.type',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopEntity.type',
                'dtField' => 'type',
            ),
            array(
                'dbField' => 'ItemshopEntity.id',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'ItemshopEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" data-featherlight="ajax" href="pages/Admin/modules/GererItemShop/GererItemShopArticlesEdit.php?mode=mod&idArticle=' . $d . '" data-tooltip="Modifier"><i class="material-icons md-icon-edit"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-danger btn-sm " data-tooltip="Supprimer" onclick="SuppressionArticle(' . $d . ')"><i class="material-icons md-icon-delete"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\Itemshop", "ItemshopEntity")
                ->leftJoin("\Site\Entity\ItemshopCategories", "ItemshopCategoriesEntity", "WITH", "ItemshopCategoriesEntity.cat = ItemshopEntity.cat");

        $datatable->getResult()->toJson();
    }

}

$class = new listGererItemShopArticles();
$class->run();
