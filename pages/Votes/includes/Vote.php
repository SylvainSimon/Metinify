<?php
$arrObjVotesListeSites = Site\SiteHelper::getVotesListeSitesRepository()->findVotesListeSites(true);

if (count($arrObjVotesListeSites) > 0) {
    ?>
    <div class="box box-default flat">
        <div class="box-header">
            <h3 class="box-title">Votez</h3>
        </div>

        <div class="box-body">

            <?php foreach ($arrObjVotesListeSites AS $objVotesListeSites) { ?>
                <input data-tooltip="Voter et gagner 20 Vamonaies" data-tooltip-position="left" class="btn btn-default btn-flat btn-pile" style="width: 100%;" type="button" onclick="Verification_Connection_Vote(<?php echo $objVotesListeSites->getIdSiteVote() ?>);
                        window.open('<?php echo $objVotesListeSites->getLienSiteVote(); ?>');" value="<?php echo $objVotesListeSites->getNomSiteVote(); ?> " />
                   <?php } ?>
        </div>
    </div>

    <script type="text/javascript">

        function Verification_Connection_Vote(id_site_vote) {

            $.ajax({
                type: "POST",
                url: "ajax/ajaxTestConnexion.php",
                success: function (msg) {
                    if (msg == 1) {

                        $.ajax({
                            type: "POST",
                            url: "pages/Votes/ajax/ajaxVerification.php",
                            data: "id_site=" + id_site_vote,
                            success: function (msg) {
                                if (msg != 1) {
                                    $("#Lien_Popup").attr("href", msg);
                                    $("#Lien_Popup").click();

                                    Barre_De_Statut("En attente de votre vote...");
                                    Icone_Chargement(1);
                                }
                                else {
                                    bootbox.dialog({
                                        message: "Votre vote ne vous a pas rapporté de Vamonaies.<br/><br/>Il semble que vous ayez voté il y à moins de 2 heures.<br/>Pour recevoir de nouveau des Vamonaies, il faut patienter.",
                                        animate: false,
                                        className: "myBootBox",
                                        title: 'Information',
                                        buttons: {
                                            success: {
                                                label: "J'ai compris",
                                                className: "btn-primary",
                                                callback: function () {

                                                }
                                            }
                                        }
                                    });
                                }
                            }
                        });

                    }
                    else if (msg == 0) {

                        bootbox.dialog({
                            message: "Vous n'êtes pas/plus connecté sur VamosMT2.<br/>En vous reconnectant, vous pourrez bénificier de 20 Vamonaies pour votre vote.",
                            animate: false,
                            className: "myBootBox",
                            title: 'Information',
                            buttons: {
                                success: {
                                    label: "J'ai compris",
                                    className: "btn-primary",
                                    callback: function () {

                                    }
                                }
                            }
                        });

                    }
                }
            });
        }
    </script>
<?php } ?>