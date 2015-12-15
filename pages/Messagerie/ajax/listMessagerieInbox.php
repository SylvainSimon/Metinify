<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class listMessagerieInbox extends \ScriptHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        $columnsParameters = array(
            array(
                'dbField' => 'SupportObjetsEntity.objet',
                'dtField' => 'objet',
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
                'dbField' => 'SupportDiscussionsEntity.dateDernierMessage',
                'dtField' => 'lastMessage',
                'formatter' => function( $d, $row ) {

                    $firstDate = date("Y-m-d");
                    $secondDate = $d->format('Y-m-d');

                    if ($firstDate == $secondDate) {
                        return \DateTimeHelper::dateTimeToFormatedString($d, "H:i:s");
                    } else {
                        return \DateTimeHelper::dateTimeToFormatedString($d);
                    }
                }
            ),
            array(
                'dbField' => 'SupportMessagesEntity.id',
                'dtField' => 'nonLuInDiscussion',
                'formatter' => function( $d, $row ) {
                    if ($d === null) {
                        return "";
                    } else {
                        return "lineGreen";
                    }
                }
            ),
            array(
                'dbField' => 'SupportDiscussionsEntity.id',
                'dtField' => 'actions',
                'formatter' => function( $d, $row ) {

                    $varButton = '<a class="btn btn-material btn-primary btn-sm" onclick="DiscussionOpen(\'' . \Encryption::encrypt($d) . '\')"><i class="material-icons md-icon-message"></i></a>';
                    $varButton .= '<a class="btn btn-material btn-warning btn-sm" onclick="DiscussionArchivage(\'' . \Encryption::encrypt($d) . '\', 1)"><i class="material-icons md-icon-archive"></i></a>';

                    return '<div class="btn-toolbar">' . $varButton . "</div>";
                }
            )
        );
        $datatable = new \DataTable();
        $datatable->setColumnsParameters($columnsParameters)
                ->setRequest($_GET)
                ->from("\Site\Entity\SupportDiscussions", "SupportDiscussionsEntity")
                ->innerJoin("\Site\Entity\SupportObjets", "SupportObjetsEntity", "WITH", "SupportObjetsEntity.id = SupportDiscussionsEntity.idObjet")
                ->innerJoin("\Account\Entity\Account", "AccountEntityAdmin", "WITH", "AccountEntityAdmin.id = SupportDiscussionsEntity.idAdmin")
                ->leftJoin("\Account\Entity\Account", "AccountEntityUser", "WITH", "AccountEntityUser.id = SupportDiscussionsEntity.idCompte")
                ->leftJoin("\Site\Entity\SupportMessages", "SupportMessagesEntity", "WITH", "SupportMessagesEntity.idDiscussion = SupportDiscussionsEntity.id AND SupportMessagesEntity.etat = " . \Site\SupportEtatMessageHelper::NON_LU . " AND SupportMessagesEntity.idCompte != " . $this->objAccount->getId() . "")
                ->andWhere("SupportDiscussionsEntity.idCompte = " . $this->objAccount->getId() . " OR SupportDiscussionsEntity.idAdmin = " . $this->objAccount->getId() . "")
                ->andWhere("SupportDiscussionsEntity.estArchive = 0")
                ->groupBy("SupportDiscussionsEntity.id");

        $datatable->getResult()->toJson();
    }

}

$class = new listMessagerieInbox();
$class->run();
