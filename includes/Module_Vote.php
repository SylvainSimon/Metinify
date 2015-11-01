<?php
$Recuperation_Site_De_Vote = "SELECT votes_liste_sites.id_site_vote, votes_liste_sites.nom_site_vote, votes_liste_sites.lien_site_vote
                              FROM $BDD_Site.votes_liste_sites
                              WHERE actif = '1'";
$Parametres_Recuperation_Site_De_Vote = $Connexion->prepare($Recuperation_Site_De_Vote);
$Parametres_Recuperation_Site_De_Vote->execute();
$Parametres_Recuperation_Site_De_Vote->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Recuperation_Site_De_Vote = $Parametres_Recuperation_Site_De_Vote->rowCount();
?>
<?php if ($Nombre_De_Resultat_Recuperation_Site_De_Vote != 0) { ?>

    <div id="dialog_Avertissement_Vote" title="Erreur lors du vote">Il semble que vous ayez voté il y à moins de 2 heures.<br/>Pour recevoir de nouveau des Vamonaies, il faut patienter.<br/><br/>Désirez-vous aller sur les sites de votes tout de même ?</div>
    <div id="dialog_Avertissement_Connection" title="Information intéressante">Vous n'êtes pas/plus connecté sur VamosMT2.<br/>En vous reconnectant, vous pouvez bénificier de 20 Vamonaies pour votre vote.<br/><br/>Voulez-vous vraiment continuer?</div>
    <input style="display: none;" id="Id_Tempo_id_site" value="" />
    <script type="text/javascript">

        function Distribuer_Monnaies() {

            $.ajax({
                type: "POST",
                url: "ajax/SQL_Actualiser_VamoNaies.php",
                success: function (msg) {

                    if (msg != "") {
                        Fonction_Reteneuse_Vamonaies(msg);
                        Barre_De_Statut("Monnaies recu avec succès.");
                        Icone_Chargement(0);
                    }
                }
            });
            return false;

        }

        function Verification_Connection_Vote(id_site_vote) {

            $.ajax({
                type: "POST",
                url: "ajax/Test_Connexion.php",
                success: function (msg) {
                    if (msg == 1) {

                        $.ajax({
                            type: "POST",
                            url: "ajax/Verification_Vote.php",
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
                                    $("#dialog_Avertissement_Vote").dialog("open");
                                    $("#Id_Tempo_id_site").val(id_site_vote);
                                }
                            }
                        });

                    }
                    else if (msg == 0) {
                        $("#dialog_Avertissement_Connection").dialog("open");
                        $("#Id_Tempo_id_site").val(id_site_vote);
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
                            url: "ajax/SQL_Rechercher_Site.php",
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

        $(function () {
            $("#dialog_Avertissement_Connection").dialog({
                resizable: false,
                autoOpen: false,
                height: 240,
                width: 400,
                buttons: {
                    "Continuer": function () {
                        $(this).dialog("close");

                        $.ajax({
                            type: "POST",
                            url: "ajax/SQL_Rechercher_Site.php",
                            data: "id_site=" + $("#Id_Tempo_id_site").val(),
                            success: function (msg) {
                                $("#Lien_Popup").attr("href", msg);
                                $("#Lien_Popup").click();
                            }
                        });
                        return false;

                    },
                    "Annuler l'action": function () {
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