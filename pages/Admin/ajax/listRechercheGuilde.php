<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listRechercheGuilde extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {

        if ($_GET["sEcho"] == 1) {
            exit();
        }
        
        $columnsParameters = array(
            array(
                'dbField' => 'GuildEntity.name',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GuildEntity.name',
                'dtField' => 'name',
            ),
            array(
                'dbField' => 'GuildEntity.level',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GuildEntity.level',
                'dtField' => 'level',
            ),
            array(
                'dbField' => ["GuildEntity.victoire", "GuildEntity.defaite", "GuildEntity.egalite"],
                'dbSortReplaceField' => [],
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => ["GuildEntity.victoire", "GuildEntity.defaite", "GuildEntity.egalite"],
                'dtField' => 'scores',
            ),
            array(
                'dbField' => 'AccountEntity.login',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'AccountEntity.login',
                'dtField' => 'chef',
            ),
            array(
                'dbField' => 'PlayerIndexEntity.empire',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerIndexEntity.empire',
                'dtField' => 'empire',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconEmpire($d);
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
            )
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Player\Entity\Guild", "GuildEntity")
                ->innerJoin("\Account\Entity\Account", "AccountEntity", "WITH", "AccountEntity.id = GuildEntity.master")
                ->innerJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id");

        $datatable->getResult()->toJson();
    }

}

$class = new listRechercheGuilde();
$class->run();
