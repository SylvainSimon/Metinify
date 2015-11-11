<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieInbox extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        $arrObjSupportDiscussions = \Site\SiteHelper::getSupportDiscussionsRepository()->findDiscussions($this->objAccount->getId(), false, 20);
        $countMessageNonLu = \Site\SiteHelper::getSupportMessagesRepository()->countMessagesNonLu($this->objAccount->getId());
        ?>

        <div class="row">
            <div class="col-lg-3">
                <table class="table table-condensed" style="border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 0px;" title="Nombre de discussion ouverte">Discussions</td>
                        <td style="border-top: 0px;"><?= count($arrObjSupportDiscussions); ?></td>
                    </tr>
                    <tr>
                        <td title="Nombre de message non-lu dans la boite de réception">Non-lu</td>
                        <td><?= $countMessageNonLu; ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-9">
                <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;">

                    <thead>
                        <tr>
                            <th width="140">Gérer par</th>
                            <th>Objet</th>
                            <th>Contenue</th>
                            <th width="240">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (count($arrObjSupportDiscussions) > 0) { ?>

                            <?php foreach ($arrObjSupportDiscussions AS $objSupportDiscussion) { ?>

                                <tr data-tooltip="Ouvrir la discussion" class="Pointer" onclick="Ajax_Ouverture_Ticket(<?= $objSupportDiscussion["id"] ?>)">
                                    <td><?= $objSupportDiscussion["admin"]; ?></td>
                                    <td><?= $objSupportDiscussion["objet"]; ?></td>
                                    <td><?= \FonctionsUtiles::Raccourcissement_Chaine($objSupportDiscussion["message"], 20); ?></td>
                                    <td><?= \DateTimeHelper::dateTimeToFormatedString($objSupportDiscussion["date"]); ?></td>
                                </tr>

                                </tr>
                            <?php } ?>

                        <?php } else { ?>
                        <td colspan="6">Vous n'avez reçu aucun messages</td>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

}

$class = new MessagerieInbox();
$class->run();
