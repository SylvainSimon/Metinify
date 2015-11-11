<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie_Ticket_Attente extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        $arrObjSupportDiscussions = \Site\SiteHelper::getSupportDiscussionsRepository()->findDiscussionsEnAttente(20);
        ?>

        <script src='pages/Messagerie/js/Controle_Nouveau_Ticket.js' type='text/javascript'></script>


        <div class="row">
            <div class="col-lg-3">
                <table class="table table-condensed" style="border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 0px;" title="Nombre de discussion ouverte">Tickets en attente :</td>
                        <td style="border-top: 0px;"><?= count($arrObjSupportDiscussions); ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-9">

                <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;">

                    <thead>
                        <tr>
                            <th width="180">Objet</th>
                            <th>Message</th>
                            <th width="100">Expediteur</th>
                            <th width="150">Date</th>
                            <th width="100">IP</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (count($arrObjSupportDiscussions) > 0) { ?>

                            <?php foreach ($arrObjSupportDiscussions AS $objSupportDiscussion) { ?>

                                <tr onclick="Assignation_Ticket(<?php echo $objSupportDiscussion["id"]; ?>);" class="Pointer">

                                    <td><?php echo $objSupportDiscussion["objet"]; ?></td>
                                    <td><?= \FonctionsUtiles::Raccourcissement_Chaine($objSupportDiscussion["message"], 30); ?></td>
                                    
                                    <td><?= $objSupportDiscussion["user"]; ?></td>
                                    <td><?php echo \DateTimeHelper::dateTimeToFormatedString($objSupportDiscussion["date"]); ?></td>
                                    <td><?= $objSupportDiscussion["ip"]; ?></td>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>
                        <td colspan="6">Aucun messages en attente.</td>
                    <?php } ?>

                    </tbody>
                </table>


            </div>
        </div>

        <?php
    }

}

$class = new Messagerie_Ticket_Attente();
$class->run();
