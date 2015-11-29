<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listRechercheGuilde extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'GuildEntity1.name',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GuildEntity1.name',
                'dtField' => 'firstGuild',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconEmpire($row["firstEmpire"]) . " " . $d;
                }
            ),
            array(
                'dbField' => 'GuildEntity2.name',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GuildEntity2.name',
                'dtField' => 'secondGuild',
                'formatter' => function( $d, $row ) {
                    return \FonctionsUtiles::findIconEmpire($row["secondEmpire"]) . " " . $d;
                }
            ),
            array(
                'dbField' => 'PlayerMaster1Entity.name',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerMaster1Entity.name',
                'dtField' => 'firstChef',
            ),
            array(
                'dbField' => 'GuildWarReservationEntity.time',
                'dbConcatSeparator' => ", ",
                'dbType' => "",
                'dbSortField' => 'GuildWarReservationEntity.time',
                'dtField' => 'date',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d);
                }
            ),
            array(
                'dbField' => 'PlayerMaster2Entity.name',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerMaster2Entity.name',
                'dtField' => 'secondChef',
            ),
            array(
                'dbField' => 'GuildWarReservationEntity.result1',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GuildWarReservationEntity.result1',
                'dtField' => 'result1',
            ),
            array(
                'dbField' => 'GuildWarReservationEntity.result2',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GuildWarReservationEntity.result2',
                'dtField' => 'result2',
            ),
            array(
                'dbField' => 'GuildEntityWin.name',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'GuildEntityWin.name',
                'dtField' => 'winner',
                'formatter' => function( $d, $row ) {

                    if ($row["result1"] > $row["result2"]) {
                        return $d . " (<span class='text-green'>" . $row["result1"] . "</span> / <span class='text-red'>" . $row["result2"] . "</span>)";
                    } else if ($row["result1"] < $row["result2"]) {
                        return $d . " (<span class='text-green'>" . $row["result2"] . "</span> / <span class='text-red'>" . $row["result1"] . "</span>)";
                    }else{
                        return "Match nul";
                    }
                }
            ),
            array(
                'dbField' => 'PlayerIndexMaster1Entity.empire',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerIndexMaster1Entity.empire',
                'dtField' => 'firstEmpire',
            ),
            array(
                'dbField' => 'PlayerIndexMaster2Entity.empire',
                'dbConcatSeparator' => "",
                'dbType' => "",
                'dbSortField' => 'PlayerIndexMaster2Entity.empire',
                'dtField' => 'secondEmpire',
            )
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Player\Entity\GuildWarReservation", "GuildWarReservationEntity")
                ->leftJoin("\Player\Entity\Guild", "GuildEntity1", "WITH", "GuildEntity1.id = GuildWarReservationEntity.guild1")
                ->leftJoin("\Player\Entity\Guild", "GuildEntity2", "WITH", "GuildEntity2.id = GuildWarReservationEntity.guild2")
                ->leftJoin("\Player\Entity\Guild", "GuildEntityWin", "WITH", "GuildEntityWin.id = GuildWarReservationEntity.winner")
                ->innerJoin("\Player\Entity\Player", "PlayerMaster1Entity", "WITH", "PlayerMaster1Entity.id = GuildEntity1.master")
                ->innerJoin("\Player\Entity\Player", "PlayerMaster2Entity", "WITH", "PlayerMaster2Entity.id = GuildEntity2.master")
                ->leftJoin("\Account\Entity\Account", "AccountMaster1Entity", "WITH", "AccountMaster1Entity.id = PlayerMaster1Entity.idAccount")
                ->leftJoin("\Account\Entity\Account", "AccountMaster2Entity", "WITH", "AccountMaster2Entity.id = PlayerMaster2Entity.idAccount")
                ->leftJoin("\Player\Entity\PlayerIndex", "PlayerIndexMaster1Entity", "WITH", "PlayerIndexMaster1Entity.id = AccountMaster1Entity.id")
                ->leftJoin("\Player\Entity\PlayerIndex", "PlayerIndexMaster2Entity", "WITH", "PlayerIndexMaster2Entity.id = AccountMaster2Entity.id");

        $datatable->getResult()->toJson();
    }

}

$class = new listRechercheGuilde();
$class->run();
