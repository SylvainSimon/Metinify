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
                'dtField' => 'name',
            ),
            array(
                'dbField' => 'GuildEntity.level',
                'filterLevel' => 'strict',
                'dtField' => 'level',
            ),
            array(
                'dbField' => ["GuildEntity.victoire", "GuildEntity.defaite", "GuildEntity.egalite"],
                'dbSortReplaceField' => [],
                'dbConcatSeparator' => "|VAMOS|",
                'dtField' => 'scores',
                'formatter' => function( $d, $row ) {

            $explosion = explode("|VAMOS|", $d);

            $scores = "<span class='text-green'>" . $explosion[0] . "</span>";
            $scores .= " / <span class='text-red'>" . $explosion[1] . "</span>";
            $scores .= " / <span>" . $explosion[2] . "</span>";

            return $scores;
        }
            ),
            array(
                'dbField' => 'AccountEntity.login',
                'dtField' => 'chef',
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
