<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {

        /* ------------------------ Vérification Compte ---------------------------- */
        $Verification_Compte = "SELECT id 
                        FROM site.support_moderateurs
                        WHERE id_compte = ?
                        AND support_ticket = 1
                        LIMIT 1";
        $Parametres_Verification_Compte = $this->objConnection->prepare($Verification_Compte);
        $Parametres_Verification_Compte->execute(array(
            $_SESSION['ID']));
        $Parametres_Verification_Compte->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Verification_Compte = $Parametres_Verification_Compte->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat_Verification_Compte == 1) {

            $Moderateur_Tickets = true;
        } else {

            $Moderateur_Tickets = false;
        }
        ?>            
        <link rel="stylesheet" href="../../css/Messagerie.css">
        <script type="text/javascript" src="../../js/Jquery_Inview.js"></script>


        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Support</h3>
            </div>

            <div class="box-body no-padding">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/Messagerie_Boite_De_Reception.php', this)">Boîte de réception</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/Messagerie_Archives.php', this)">Discussions archivés</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/Messagerie_Creer_Ticket_Support.php', this)">Créer un ticket support</a></li>
                        <?php if ($Moderateur_Tickets) { ?>
                            <li><a href="javascript:void(0)" onclick="Ajax_Appel_Messagerie('pages/Messagerie/Messagerie_Ticket_Attente.php', this)">Tickets en attentes</a></li>
                        <?php } ?>
                    </ul>

                    <div id="Contenue_Cadre_Messagerie"></div>

                </div>

                <div class="clear"></div>
            </div>
        </div>


        <?php if ($_SESSION['Pseudo_Messagerie'] != "") { ?>
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
                        url: "Messagerie_Lecture.php",
                        data: "id_ticket=" + id_ticket,
                        success: function (msg) {

                            $("#Contenue_Cadre_Messagerie").html(msg);
                            window.parent.Barre_De_Statut("Chargement terminé.");
                            window.parent.Icone_Chargement(0);

                        }
                    });
                    return false;

                }

                Ajax_Appel_Messagerie("pages/Messagerie/Messagerie_Boite_De_Reception.php", false);

            </script>

        <?php } else { ?>

            <div class="Zone_De_Definition_Pseudo">

                <span class="Titre_Definition_Pseudo">Veuillez définir votre pseudo messagerie</span>
                <script type="text/javascript" src="js/Controle_Pseudo_Messagerie.js"></script>
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
        <?php
    }

}

$class = new Messagerie();
$class->run();
