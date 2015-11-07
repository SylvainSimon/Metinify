<?php
$Recuperation_Site_De_Vote = "SELECT votes_liste_sites.id_site_vote, votes_liste_sites.nom_site_vote, votes_liste_sites.lien_site_vote
                              FROM site.votes_liste_sites
                              WHERE actif = '1'";
$Parametres_Recuperation_Site_De_Vote = $this->objConnection->prepare($Recuperation_Site_De_Vote);
$Parametres_Recuperation_Site_De_Vote->execute();
$Parametres_Recuperation_Site_De_Vote->setFetchMode(\PDO::FETCH_OBJ);
$Nombre_De_Resultat_Recuperation_Site_De_Vote = $Parametres_Recuperation_Site_De_Vote->rowCount();
?>
<?php if ($Nombre_De_Resultat_Recuperation_Site_De_Vote != 0) { ?>

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

                                    setTimeout(Distribuer_Monnaies, 15000);
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

        $(function () {
            $("#dialog_Avertissement_Vote").dialog({
                resizable: false,
                autoOpen: false,
                height: 220,
                width: 400,
                buttons: {
                    "Ouvrir tout de même": function () {
                        $(this).dialog("close");

                        $.ajax({
                            type: "POST",
                            url: "pages/Votes/ajax/ajaxGetUrlSite.php",
                            data: "id_site=" + $("#Id_Tempo_id_site").val(),
                            success: function (msg) {
                                $("#Lien_Popup").attr("href", msg);
                                $("#Lien_Popup").click();
                            }
                        });
                        return false;

                    },
                    "Ne pas ouvrir": function () {
                        $(this).dialog("close");
                    }
                }
            });

        });

    </script>

    <div class="box box-default flat">
        <div class="box-header">
            <h3 class="box-title">Votez</h3>
        </div>

        <div class="box-body">
            <?php while ($Donnees_Recuperation_Site_De_Vote = $Parametres_Recuperation_Site_De_Vote->fetch()) { ?>
                <input data-tooltip="Voter et gagner 20 Vamonaies" data-tooltip-position="left" class="btn btn-default btn-flat btn-pile" style="width: 100%;" type="button" onclick=" Verification_Connection_Vote(<?php echo $Donnees_Recuperation_Site_De_Vote->id_site_vote ?>);
                        window.open('<?php echo $Donnees_Recuperation_Site_De_Vote->lien_site_vote; ?>');" value="<?php echo $Donnees_Recuperation_Site_De_Vote->nom_site_vote; ?> " />
                   <?php } ?>
        </div>
    </div>
<?php } ?>