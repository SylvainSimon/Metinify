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
                <input data-tooltip="Voter et gagner 20 <?php echo DeviseHelper::getLibelle(1) ?>" data-tooltip-position="left" class="btn btn-default btn-flat btn-pile" style="width: 100%;" type="button" onclick="Verification_Connection_Vote(<?php echo $objVotesListeSites->getIdSiteVote() ?>, '<?php echo $objVotesListeSites->getLienSiteVote(); ?>');" value="<?php echo $objVotesListeSites->getNomSiteVote(); ?> " />
            <?php } ?>
        </div>
    </div>

    <script type="text/javascript">

        function Verification_Connection_Vote(id_site_vote, linkWebsite) {

            var isConnected = false;
            var message = "";

            $.ajax({
                type: "POST",
                url: "ajax/ajaxTestConnexion.php",
                success: function (msg) {

                    if (msg == 1) {
                        isConnected = true;
                        message = "Si vous souhaitez voter et obtenir les monnaies, merci de cliquer sur le bouton suivant.<br/><br/><a target='_blank' onclick='DistributionVote(" + id_site_vote + "); bootbox.hideAll()' class='btn btn-primary btn-flat' href='" + linkWebsite + "'>Se rendre sur le site</a>";
                    } else if (msg == 0) {
                        message = "Vous n'êtes pas connecté sur VamosMT2.<br/>En vous reconnectant, vous pourrez bénéficier de 20 <?php echo DeviseHelper::getLibelle(1) ?> pour votre vote.<br/><br/>Vous pouvez toutefois vous rendre sur le site de vote en cliquant sur le bouton suivant.<br/><br/><a onclick='bootbox.hideAll();' target='_blank' class='btn btn-primary btn-flat' href='" + linkWebsite + "'>Se rendre sur le site</a>";
                    }

                    bootbox.dialog({
                        message: message,
                        animate: false,
                        className: "myBootBox",
                        title: 'Vérification et confirmation',
                        buttons: {
                            success: {
                                label: "Fermer",
                                className: "btn-danger",
                                callback: function () {

                                }
                            }
                        }
                    });

                }
            });
        }

        function DistributionVote(id_site_vote) {

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

                        $("#overlayMt2").html('<div style="position: relative;top: 45%;width: 200px; margin: 0 auto 0 auto;"><h2>Vote en cours...</h2></div>');
                        $("#overlayMt2").css('display', "inline");

                        setTimeout(DistribuerMonnaiesVote, 15000);

                    } else {
                        bootbox.dialog({
                            message: "Votre vote ne vous a pas rapporté de <?php echo DeviseHelper::getLibelle(1) ?>.<br/><br/>Il semble que vous ayez voté il y à moins de 2 heures.<br/>Pour recevoir de nouveau des <?php echo DeviseHelper::getLibelle(1) ?>, il faut patienter.",
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