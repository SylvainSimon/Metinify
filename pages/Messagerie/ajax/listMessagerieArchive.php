<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listMessagerieArchive extends \ScriptHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'SupportDiscussionsEntity.idObjet',
                'dtField' => 'objet',
                'formatter' => function( $d, $row ) {
                    return \SupportObjetsHelper::getLibelle($d);
                }
            ),
            array(
                'dbField' => 'AccountEntityAdmin.pseudoMessagerie',
                'dtField' => 'compte',
                'formatter' => function( $d, $row ) {

                    if ($this->isAdmin) {
                        return $row["user"];
                    } else {
                        return $d;
                    }
                }
            ),
            array(
                'dbField' => 'AccountEntityUser.login',
                'dtField' => 'user',
            ),
            array(
                'dbField' => 'SupportDiscussionsEntity.date',
                'dtField' => 'date',
                'formatter' => function( $d, $row ) {
                    return \DateTimeHelper::dateTimeToFormatedString($d, "d/m/Y");
                }
            ),
            array(
                'dbField' => 'SupportDiscussionsEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" onclick="DiscussionOpen(\'' . \Encryption::encrypt($d) . '\')"><i class="material-icons md-icon-search"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity")
                ->innerJoin("\Account\Entity\Account", "AccountEntityAdmin", "WITH", "AccountEntityAdmin.id = SupportDiscussionsEntity.idAdmin")
                ->leftJoin("\Account\Entity\Account", "AccountEntityUser", "WITH", "AccountEntityUser.id = SupportDiscussionsEntity.idCompte")
                ->andWhere("SupportDiscussionsEntity.idCompte = " . $this->objAccount->getId() . " OR SupportDiscussionsEntity.idAdmin = " . $this->objAccount->getId() . "")
                ->andWhere("SupportDiscussionsEntity.estArchive = 1");

        $datatable->getResult()->toJson();
    }

}

$class = new listMessagerieArchive();
$class->run();
