<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        global $session;

        $countModerateur = \Site\SiteHelper::getSupportModerateursRepository()->countByIdAccount($this->objAccount->getId());
        if ($countModerateur > 0) {
            $Moderateur_Tickets = true;
        } else {
            $Moderateur_Tickets = false;
        }
        ?>            
        <script type="text/javascript" src="../../assets/js/jquery.inview/jquery.inview.min.js"></script>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Support</h3>
            </div>

            <?php if ($session->get("Pseudo_Messagerie") != "") { ?>

                <div class="box-body no-padding">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">

                            <li class="active"><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/MessagerieInbox.php', this)">Boîte de réception</a></li>
                            <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/MessagerieArchive.php', this)">Discussions archivés</a></li>
                            <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/MessagerieCreate.php', this)">Créer un ticket</a></li>
                            <?php if ($Moderateur_Tickets) { ?>
                                <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/MessagerieWaiting.php', this)">Tickets en attentes</a></li>
                            <?php } ?>
                        </ul>

                        <div id="Contenue_Cadre_Messagerie"></div>

                    </div>


                    <script type="text/javascript">

                        function Ajax_Appel_Messagerie(url, objet) {

                            window.parent.Barre_De_Statut("Appel de l'onglet...");
                            window.parent.Icone_Chargement(1);

                            $.ajax({
                                type: "POST",
                                url: "" + url,
                                success: function (msg) {

                                    $("#Contenue_Cadre_Messagerie").html(msg);
                                    window.parent.Barre_De_Statut("Chargement terminé.");
                                    window.parent.Icone_Chargement(0);

                                    redraw();

                                    if (objet !== false) {
                                        $(".nav-tabs-custom li").attr("class", "");
                                        $(objet).parent("li").attr("class", "active");
                                    }
                                }
                            });
                            return false;

                        }

                        function Ajax_Ouverture_Ticket(id_ticket) {

                            window.parent.Barre_De_Statut("Ouverture de la discussion...");
                            window.parent.Icone_Chargement(1);

                            $.ajax({
                                type: "POST",
                                url: "pages/Messagerie/MessagerieView.php",
                                data: "id_ticket=" + id_ticket,
                                success: function (msg) {

                                    $("#Contenue_Cadre_Messagerie").html(msg);
                                    window.parent.Barre_De_Statut("Chargement terminé.");
                                    window.parent.Icone_Chargement(0);

                                }
                            });
                            return false;

                        }

                        Ajax_Appel_Messagerie("pages/Messagerie/MessagerieInbox.php", false);

                    </script>
                    <div class="clear"></div>
                </div>
            <?php } else { ?>

                <script type="text/javascript" src="pages/Messagerie/js/Controle_Pseudo_Messagerie.js"></script>
                <form action="javascript:void(0)" id="FormInscription" name="FormPseudoMessagerie" method="POST">

                    <div class="box-body">

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group" style="margin-bottom: 0px;">
                                    <label for="SaisiePseudo">
                                        Pseudo
                                    </label>

                                    <div class="input-group col-xs-12">
                                        <input maxlength="16" placeholder="Pseudo de messagerie.." id="SaisiePseudo" class="form-control input-sm" type="text" name="user" onBlur="verifPseudo(this.value)"/>
                                    </div>

                                    <span class="help-block">    
                                        <ul class="list-unstyled">
                                            <li id="ReponseDuTestPseudo"></li>
                                        </ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-flat" onclick="VerificationFormulairePseudo();">
                            Choisir ce pseudo
                        </button>
                    </div>
                </form>
            <?php } ?>
        </div>
        <?php
    }

}

$class = new Messagerie();
$class->run();
