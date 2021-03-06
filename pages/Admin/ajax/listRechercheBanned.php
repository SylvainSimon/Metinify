<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listHistoGererMonnaies extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'AccountEntity.login',
                'dtField' => 'compte',
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
                'dbField' => ['PlayerEntity1.name', 'PlayerEntity2.name', 'PlayerEntity3.name', 'PlayerEntity4.name'],
                'dbSortReplaceField' => [
                    "PlayerEntity1.name" => "PlayerEntity2.name",
                    "PlayerEntity2.name" => "PlayerEntity3.name",
                    "PlayerEntity3.name" => "PlayerEntity4.name",
                    "PlayerEntity4.name" => "PlayerEntity1.name"],
                'dbConcatSeparator' => "|VAMOS|",
                'dtField' => 'names',
                'formatter' => function( $d, $row ) {
            $arrReturn = array_unique(explode("|VAMOS|", $d));
            return implode(", ", $arrReturn);
        }
            ),
            array(
                'dbField' => 'BannissementsActifsEntity.raisonBannissement',
                'dtField' => 'raison',
                'formatter' => function( $d, $row ) {
                    return \BanRaisonHelper::getLibelle($d);
                }
            ),
            array(
                'dbField' => 'BannissementsActifsEntity.duree',
                'filterLevel' => 'strict',
                'dtField' => 'duree',
                'formatter' => function( $d, $row ) {

                    if ($d == 999) {
                        return "Définitif";
                    } else {
                        return \BanDureeHelper::getLibelle($d);
                    }
                }
            ),
            array(
                'dbField' => 'AccountEntity.ipCreation',
                'dtField' => 'ip',
            ),
            array(
                'dbField' => 'AccountEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    if ($this->HaveTheRight(\DroitsHelper::DEBANNISSEMENT)) {
                        $varButton = '<a class="btn btn-material btn-success btn-sm" onclick="SuppressionBannissement(' . $d . ')" data-tooltip="Lever"><i class="material-icons md-icon-lock-open"></i></a>';
                    } else {
                        $varButton = "";
                    }

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );

        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Account\Entity\Account", "AccountEntity")
                ->leftJoin("\Player\Entity\PlayerIndex", "PlayerIndexEntity", "WITH", "PlayerIndexEntity.id = AccountEntity.id")
                ->leftJoin("\Player\Entity\Player", "PlayerEntity1", "WITH", "PlayerEntity1.id = PlayerIndexEntity.pid1")
                ->leftJoin("\Player\Entity\Player", "PlayerEntity2", "WITH", "PlayerEntity2.id = PlayerIndexEntity.pid2")
                ->leftJoin("\Player\Entity\Player", "PlayerEntity3", "WITH", "PlayerEntity3.id = PlayerIndexEntity.pid3")
                ->leftJoin("\Player\Entity\Player", "PlayerEntity4", "WITH", "PlayerEntity4.id = PlayerIndexEntity.pid4")
                ->leftJoin("\Site\Entity\BannissementsActifs", "BannissementsActifsEntity", "WITH", "BannissementsActifsEntity.idCompte = AccountEntity.id")
                ->andWhere("AccountEntity.status = '" . \StatusHelper::BANNI . "'");

        $datatable->getResult()->toJson();
    }

}

$class = new listHistoGererMonnaies();
$class->run();
