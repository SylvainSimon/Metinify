<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php
if (empty($_SESSION['ID'])) {

    echo "Vous n'êtes pas connecté";
    exit();
}

/* ------------------------ Vérification Compte ---------------------------- */
$Verification_Compte = "SELECT id 
                        FROM $BDD_Site.administration_users
                        WHERE id_compte = ?
                        AND support_ticket = 1
                        LIMIT 1";
$Parametres_Verification_Compte = $Connexion->prepare($Verification_Compte);
$Parametres_Verification_Compte->execute(array(
    $_SESSION['ID']));
$Parametres_Verification_Compte->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Verification_Compte = $Parametres_Verification_Compte->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat_Verification_Compte == 1) {

    $Moderateur_Tickets = true;
} else {

    $Moderateur_Tickets = false;
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="../../js/Jquery 1.8.0.js"></script>
        <script type="text/javascript" src="../../js/ui/Jquery_UI_1.8.23.js"></script>
        <script type="text/javascript" src="../../js/Jquery_Inview.js"></script>

        <link rel="stylesheet" href="../../css/Messagerie.css">
        <link rel="stylesheet" href="../../css/jquery-ui-1.8.23.custom.css">

    </head>

    <body>

        <div id="Onglets">

            <?php if ($_SESSION['Pseudo_Messagerie'] != "") { ?>

                <ul class="user_no_select">

                    <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('Messagerie_Boite_De_Reception.php')">Boîte de Réception</a></li>
                    <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('Messagerie_Archives.php')">Discussions Archivés</a></li>
                    <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('Messagerie_Creer_Ticket_Support.php')">Créer un ticket support</a></li>
                    <?php if ($Moderateur_Tickets) { ?>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('Messagerie_Ticket_Attente.php')">Tickets en attentes</a></li>
                    <?php } ?>
                    <div class="Bouton_Fermer_Fenetre Pointer" onclick="window.parent.$.fancybox.close();"></div>

                </ul>

                <div id="Contenue_Cadre_Messagerie"></div>

                <script type="text/javascript">
                                            
                    function Ajax_Appel_Messagerie(url){
                                                        
                        window.parent.Barre_De_Statut("Appel de l'onglet...");
                        window.parent.Icone_Chargement(1);
                                    
                        $.ajax({
                            type: "POST",
                            url: ""+url,
                            success: function(msg){

                                $("#Contenue_Cadre_Messagerie").fadeOut("medium", function(){
                                    $("#Contenue_Cadre_Messagerie").html(msg);
                                    window.parent.Barre_De_Statut("Chargement terminé.");
                                    window.parent.Icone_Chargement(0);
                                    $("#Contenue_Cadre_Messagerie").fadeIn("medium");
                                });
                                                                                
                            }
                        });
                        return false;
                                                                                            
                    }         
                                            
                    function Ajax_Ouverture_Ticket(id_ticket){
                            
                        window.parent.Barre_De_Statut("Ouverture de la discussion...");
                        window.parent.Icone_Chargement(1);
                                                                	                                                       
                        $.ajax({
                            type: "POST",
                            url: "Messagerie_Lecture.php",
                            data: "id_ticket="+id_ticket,
                            success: function(msg){

                                $("#Contenue_Cadre_Messagerie").fadeOut("medium", function(){
                                    $("#Contenue_Cadre_Messagerie").html(msg);
                                    window.parent.Barre_De_Statut("Chargement terminé.");
                                    window.parent.Icone_Chargement(0);
                                    $("#Contenue_Cadre_Messagerie").fadeIn("medium");
                                });
                                                                                
                            }
                        });
                        return false;
                                                                                            
                    }
                                            
                    Ajax_Appel_Messagerie("Messagerie_Boite_De_Reception.php");
                                                                                                                                        
                </script>

            <?php } else { ?>

                <div class="Zone_De_Definition_Pseudo">

                    <span class="Titre_Definition_Pseudo">Veuillez définir votre pseudo messagerie</span>
                    <script type="text/javascript" src="Controle_Pseudo_Messagerie.js"></script>
                    <form action="javascript:void(0)" id="FormInscription" name="FormPseudoMessagerie" method="POST">

                        <table id="Table_Definition_Pseudo">
                            <tr>
                                <td>Pseudo : </td>
                            </tr>
                            <tr>
                                <td><input maxlength="16" placeholder="Pseudo de messagerie.." id="SaisiePseudo" class="Zone_Definition_Pseudo" type="text" name="user" onBlur="verifPseudo(this.value)"/></td>

                            </tr>
                            <tr>
                                <td id="ReponseDuTestPseudo">Indiquez un pseudo</td>
                            </tr>
                        </table>

                        <input class="Bouton_Zone_Definition_Pseudo" type="image" onclick="VerificationFormulairePseudo();" src="../../images/Bouton_Valider.png" value="OK" />
                    </form>
                </div>
            <?php } ?>
        </div>
    </body>
</html>