<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieArchive extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        $arrObjSupportDiscussions = \Site\SiteHelper::getSupportDiscussionsRepository()->findDiscussions($this->objAccount->getId(), true, 50);
        ?>

        <div class="row">


            <div class="col-lg-12">
                <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;">

                    <thead>
                        <tr>
                            <th width="120" data-tooltip="Expediteur du premier message de la discussion">Expediteur</th>
                            <th width="120" data-tooltip="Destinataire du premier message de la discussion">Destinataire</th>
                            <th data-tooltip="Objet de la discussion">Objet</th>
                            <th width="240" data-tooltip="Date du début de la discussion">Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (count($arrObjSupportDiscussions) > 0) { ?>

                            <?php foreach ($arrObjSupportDiscussions AS $objSupportDiscussion) { ?>

                                <tr onclick="Ajax_Ouverture_Ticket(<?= $objSupportDiscussion["id"] ?>)" class="Pointer">
                                    <td><?= $objSupportDiscussion["user"]; ?></td>
                                    <td><?= $objSupportDiscussion["admin"]; ?></td>
                                    <td><?= $objSupportDiscussion["objet"]; ?></td>
                                    <td><?= \DateTimeHelper::dateTimeToFormatedString($objSupportDiscussion["date"]); ?></td>
                                </tr>

                            <?php } ?>

                        <?php } else { ?>
                            <tr><td colspan="7">Aucune de vos discussions n'est stocké en archives.</td></tr>
                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>
        <?php
    }

}

$class = new MessagerieArchive();
$class->run();
