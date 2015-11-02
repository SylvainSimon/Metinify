<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class SQL_Statistiques extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Tableaux_Arrays.php'; ?>
        <?php include '../../pages/Fonctions_Utiles.php'; ?>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <script type="text/javascript" src="../../js/Jquery 1.8.0.js"></script>
                <script type="text/javascript" src="../../js/ui/Jquery_UI_1.8.23.js"></script>
                <script type="text/javascript" src="../../js/Jquery_Inview.js"></script>

                <link rel="stylesheet" href="../../css/Statistiques.css">
                <link rel="stylesheet" href="../../css/jquery-ui-1.8.23.custom.css">

            </head>
            <body>
                <div id="Onglets">
                    <ul class="user_no_select">

                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(1)">Statistiques du jour</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(2)">Statistiques de la semaine</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(3)">Statistiques du mois</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(4)">Statistiques complètes</a></li>


                        <div class="Bouton_Fermer_Fenetre Pointer" onclick="window.parent.$.fancybox.close();"></div>

                    </ul>

                    <div id="Contenue_Cadre_Statistiques">

                        <table id="Tableau_Statistiques_1" class="Tableau_Stat">
                            <tr>
                                <th colspan="2">Nouveaux :</th>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche" title="Les nouveaux comptes crées">
                                    <img class="Icone_Joueurs" src="../../images/icones/inscription.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Nombre d'inscriptions">Comptes :</span>
                                </td>
                                <td id="Contenue_Comptes"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche" title="Les premières connections de joueurs">
                                    <img class="Icone_Joueurs" src="../../images/icones/utilisateur.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Nombre de premières connexion">Joueurs :</span>
                                </td>
                                <td id="Contenue_Joueurs"></td>
                            </tr>
                        </table>

                        <table id="Tableau_Statistiques_2" class="Tableau_Stat">
                            <tr>
                                <th colspan="2">Par sexe :</th>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Sexe" src="../../images/icones/symbole_homme.png" height="14"/>&nbsp;
                                    <span class="Texte_Sexe" title="Le nombre de personnages masculins">Hommes</span>
                                </td>
                                <td id="Contenue_Hommes"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Sexe" src="../../images/icones/symbole_femme.png" height="14"/>&nbsp;
                                    <span class="Texte_Sexe" title="Le nombre de personnages féminins">Femmes</span>
                                </td>
                                <td id="Contenue_Femmes"></td>
                            </tr>
                        </table>

                        <table id="Tableau_Statistiques_3" class="Tableau_Stat">
                            <tr>
                                <th colspan="2">Par royaume :</th>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Empire" src="../../images/empire/red.jpg" height="14"/>&nbsp;
                                    <span class="Texte_Empire" title="Les joueurs du royaume rouge">Shinsoo</span>
                                </td>
                                <td id="Contenue_Shinsoo"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Empire" src="../../images/empire/yellow.jpg" height="14"/>&nbsp;
                                    <span class="Texte_Empire" title="Les joueurs du royaume jaune">Chunjo</span>
                                </td>
                                <td id="Contenue_Chunjo"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Empire" src="../../images/empire/blue.jpg" height="14"/>&nbsp;
                                    <span class="Texte_Empire" title="Les couleurs du royaume bleu">Jinno</span>
                                </td>
                                <td id="Contenue_Jinno"></td>
                            </tr>
                        </table>

                        <table id="Tableau_Statistiques_4" class="Tableau_Stat">
                            <tr>
                                <th colspan="2">Par race :</th>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Race" src="../../images/races/0_mini.png" height="14"/>&nbsp;
                                    <span class="Texte_Race" title="Les personnages guerriers">Guerriers</span>
                                </td>
                                <td id="Contenue_Guerriers"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Race" src="../../images/races/2_mini.png" height="14"/>&nbsp;
                                    <span class="Texte_Race" title="Les personnages suras">Suras</span>
                                </td>
                                <td id="Contenue_Suras"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Race" src="../../images/races/5_mini.png" height="14"/>&nbsp;
                                    <span class="Texte_Race" title="Les personnages ninjas">Ninjas</span>
                                </td>
                                <td id="Contenue_Ninjas"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche">
                                    <img class="Icone_Race" src="../../images/races/7_mini.png" height="14"/>&nbsp;
                                    <span class="Texte_Race" title="Les personnages shamans">Shamans</span>
                                </td>
                                <td id="Contenue_Shamans"></td>
                            </tr>

                        </table>

                        <table id="Tableau_Statistiques_5" class="Tableau_Stat">
                            <tr>
                                <th colspan="2">Site web :</th>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site" src="../../images/ok2.gif" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Le nombre de connexions réussi au site">Connexions au site</span>
                                </td>
                                <td id="Contenue_Connexion_Site"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site" src="../../images/ok2.gif" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Le nombre de connexions d'utilisateurs">Connexions uniques</span>
                                </td>
                                <td id="Contenue_Connexion_Site_Unique"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site" src="../../images/icones/mail.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Le nombre de changements d'email">Changements d'e-mail</span>
                                </td>
                                <td id="Contenue_Changement_Mail"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site_MDP" src="../../images/icones/motdepasse.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Le nombre de récupération de mots de passe">Récuperation de mots de passe</span>
                                </td>
                                <td id="Contenue_Recup_MDP"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site_MDP" src="../../images/icones/motdepasse.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Le nombre de changements de mot de passe">Changements de mot de passe</span>
                                </td>
                                <td id="Contenue_Changement_MDP"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site_MDP" src="../../images/icones/motdepasse.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Le nombre de changement de mot de passe entrepôt">Changements codes entrepôts</span>
                                </td>
                                <td id="Contenue_Changement_Code_Entrepot"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site_MDP" src="../../images/icones/yangs.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Nombre de deblocage de Yangs">Déblocages des Yangs</span>
                                </td>
                                <td id="Contenue_Deblocage_Yangs"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site_MDP" src="../../images/icones/vote.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Nombre de deblocage de Yangs">Nombre de votes</span>
                                </td>
                                <td id="Contenue_Nombre_Vote"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Site_MDP" src="../../images/icones/utilisateur.png" height="14"/>&nbsp;
                                    <span class="Texte_Site" title="Nombre d'achats de personnage">Achat de personnage</span>
                                </td>
                                <td id="Contenue_Nombre_Achat_Perso"></td>
                            </tr>
                        </table>

                        <table id="Tableau_Statistiques_6" class="Tableau_Stat">
                            <tr>
                                <th colspan="2">Messagerie :</th>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Messagerie" src="../../images/icones/add.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Nombre de tickets ouverts">Tickets ouverts</span>
                                </td>
                                <td id="Contenue_Tickets_Ouverts"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Messagerie" src="../../images/icones/message.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Nombre de messages écrits">Messages écrits</span>
                                </td>
                                <td id="Contenue_Messages_Ecrits"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_2">
                                    <img class="Icone_Messagerie" src="../../images/icones/message.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Nombre de discussions archivés">Discussions archivées</span>
                                </td>
                                <td id="Contenue_Discussions_Archives"></td>
                            </tr>
                        </table>

                        <table id="Tableau_Statistiques_7" class="Tableau_Stat">
                            <tr>
                                <th colspan="2">Provenances :</th>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/fr.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes français">France</span>
                                </td>
                                <td id="Contenue_Pays_FR"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/be.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes belges">Belgique</span>
                                </td>
                                <td id="Contenue_Pays_BE"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/ch.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes suisses">Suisse</span>
                                </td>
                                <td id="Contenue_Pays_CH"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/gb.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes anglais">Angleterre</span>
                                </td>
                                <td id="Contenue_Pays_GB"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/de.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes allemands">Allemagne</span>
                                </td>
                                <td id="Contenue_Pays_DE"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/ro.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes roumains">Roumanie</span>
                                </td>
                                <td id="Contenue_Pays_RO"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/us.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes états-uniens">USA</span>
                                </td>
                                <td id="Contenue_Pays_US"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/it.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes italiens">Italie</span>
                                </td>
                                <td id="Contenue_Pays_IT"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/es.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes espagnols">Espagne</span>
                                </td>
                                <td id="Contenue_Pays_ES"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/pl.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes polonais">Pologne</span>
                                </td>
                                <td id="Contenue_Pays_PL"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/pt.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes portugais">Portugal</span>
                                </td>
                                <td id="Contenue_Pays_PT"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/tn.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes tunisiens">Tunisie</span>
                                </td>
                                <td id="Contenue_Pays_TN"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/dz.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes algériens">Algérie</span>
                                </td>
                                <td id="Contenue_Pays_DZ"></td>
                            </tr>
                            <tr>
                                <td class="Colonne_Tableau_Gauche_3">
                                    <img class="Icone_Drapeaux" src="../../images/drapeaux/jp.png" height="14"/>&nbsp;
                                    <span class="Texte_Messagerie" title="Comptes japonais">Japon</span>
                                </td>
                                <td id="Contenue_Pays_JP"></td>
                            </tr>
                        </table>
                    </div>

                    <script type="text/javascript">

                        function Ajax_Appel_Statistiques(page) {

                            window.parent.Barre_De_Statut("Récuperation des statistiques...");
                            window.parent.Icone_Chargement(1);

                            $('#Contenue_Comptes').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Joueurs').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Hommes').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Femmes').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Shinsoo').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Chunjo').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Jinno').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Guerriers').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Suras').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Ninjas').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Shamans').html("<img src='../../images/chargement.gif' height='14' />");

                            $('#Contenue_Connexion_Site').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Connexion_Site_Unique').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Changement_Mail').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Recup_MDP').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Changement_MDP').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Changement_Code_Entrepot').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Deblocage_Yangs').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Nombre_Vote').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Nombre_Achat_Perso').html("<img src='../../images/chargement.gif' height='14' />");

                            $('#Contenue_Tickets_Ouverts').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Messages_Ecrits').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Discussions_Archives').html("<img src='../../images/chargement.gif' height='14' />");

                            $('#Contenue_Pays_FR').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_CH').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_GB').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_DE').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_RO').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_US').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_IT').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_ES').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_PL').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_PT').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_TN').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_DZ').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_JP').html("<img src='../../images/chargement.gif' height='14' />");
                            $('#Contenue_Pays_BE').html("<img src='../../images/chargement.gif' height='14' />");

                            $.ajax({
                                type: "POST",
                                url: "SQL_Statistiques.php",
                                data: "id_statistique=" + page,
                                success: function (msg) {

                                    try {
                                        Parse_Json = JSON.parse(msg);

                                        $("#Contenue_Comptes").html(Parse_Json.comptes);
                                        $("#Contenue_Joueurs").html(Parse_Json.joueurs);

                                        $("#Contenue_Hommes").html(Parse_Json.hommes);
                                        $("#Contenue_Femmes").html(Parse_Json.femmes);

                                        $("#Contenue_Shinsoo").html(Parse_Json.shinsoo);
                                        $("#Contenue_Chunjo").html(Parse_Json.chunjo);
                                        $("#Contenue_Jinno").html(Parse_Json.jinno);

                                        $("#Contenue_Guerriers").html(Parse_Json.guerriers);
                                        $("#Contenue_Suras").html(Parse_Json.suras);
                                        $("#Contenue_Ninjas").html(Parse_Json.ninjas);
                                        $("#Contenue_Shamans").html(Parse_Json.shamans);

                                        $("#Contenue_Connexion_Site").html(Parse_Json.connexion_site);
                                        $("#Contenue_Connexion_Site_Unique").html(Parse_Json.connexion_site_unique);
                                        $("#Contenue_Changement_Mail").html(Parse_Json.changement_mail);
                                        $("#Contenue_Recup_MDP").html(Parse_Json.recup_mdp);
                                        $("#Contenue_Changement_MDP").html(Parse_Json.changement_mdp);
                                        $("#Contenue_Changement_Code_Entrepot").html(Parse_Json.changement_entrepot);
                                        $("#Contenue_Deblocage_Yangs").html(Parse_Json.deblocage_yangs);
                                        $("#Contenue_Nombre_Vote").html(Parse_Json.nombre_vote);
                                        $("#Contenue_Nombre_Achat_Perso").html(Parse_Json.nombre_achats_perso);

                                        $("#Contenue_Tickets_Ouverts").html(Parse_Json.tickets_ouvert);
                                        $("#Contenue_Messages_Ecrits").html(Parse_Json.message_ecrits);
                                        $("#Contenue_Discussions_Archives").html(Parse_Json.discussion_archives);

                                        $("#Contenue_Pays_FR").html(Parse_Json.pays_fr);
                                        $("#Contenue_Pays_CH").html(Parse_Json.pays_ch);
                                        $("#Contenue_Pays_GB").html(Parse_Json.pays_gb);
                                        $("#Contenue_Pays_DE").html(Parse_Json.pays_de);
                                        $("#Contenue_Pays_RO").html(Parse_Json.pays_ro);
                                        $("#Contenue_Pays_US").html(Parse_Json.pays_us);
                                        $("#Contenue_Pays_IT").html(Parse_Json.pays_it);
                                        $("#Contenue_Pays_ES").html(Parse_Json.pays_es);
                                        $("#Contenue_Pays_PL").html(Parse_Json.pays_pl);
                                        $("#Contenue_Pays_PT").html(Parse_Json.pays_pt);
                                        $("#Contenue_Pays_TN").html(Parse_Json.pays_tn);
                                        $("#Contenue_Pays_DZ").html(Parse_Json.pays_dz);
                                        $("#Contenue_Pays_JP").html(Parse_Json.pays_jp);
                                        $("#Contenue_Pays_BE").html(Parse_Json.pays_be);

                                        window.parent.Barre_De_Statut("Chargement terminé.");
                                        window.parent.Icone_Chargement(0);

                                    } catch (e) {

                                    }

                                }
                            });
                            return false;
                        }

                        Ajax_Appel_Statistiques(1);
                    </script>
                </div>
            </body>
        </html>
        <?php
    }

}

$class = new SQL_Statistiques();
$class->run();
