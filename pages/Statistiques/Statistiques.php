<?php

namespace Pages\Statistiques;

require __DIR__ . '../../../core/initialize.php';

class Statistiques extends \PageHelper {

    public function run() {

        include '../../pages/Tableaux_Arrays.php';
        ?>


        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Statistiques</h3>
            </div>

            <div class="box-body no-padding">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(1, this)">Statistiques du jour</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(2, this)">Statistiques de la semaine</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(3, this)">Statistiques du mois</a></li>
                        <li><a href="javascript:void(0)" onclick="Ajax_Appel_Statistiques(4, this)">Statistiques complètes</a></li>
                    </ul>

                    <div>
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                                            <tr>
                                                <th style="border-top: 0px;" colspan="2">Nouveau</th>
                                            </tr>
                                            <tr data-tooltip="Les nouveaux comptes crées">
                                                <td style="line-height: 10px;" class="Colonne_Tableau_Gauche">
                                                    <i class="material-icons md-icon-account-box"></i>
                                                    <span style="vertical-align: super;">Comptes</span>
                                                </td>
                                                <td id="Contenue_Comptes"></td>
                                            </tr>
                                            <tr data-tooltip="Les premières connections de joueurs">
                                                <td>
                                                    <i class="material-icons md-icon-person"></i>
                                                    <span style="vertical-align: super;">Joueurs</span>
                                                </td>
                                                <td id="Contenue_Joueurs"></td>
                                            </tr>
                                        </table>

                                        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                                            <tr data-tooltip="Le nombre de personnages masculins">
                                                <td  style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-person text-blue"></i>
                                                    <span style="vertical-align: super;">Hommes</span>
                                                </td>
                                                <td id="Contenue_Hommes"></td>
                                            </tr>
                                            <tr data-tooltip="Le nombre de personnages féminins">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-person text-fuchsia"></i>
                                                    <span style="vertical-align: super;">Femmes</span>
                                                </td>
                                                <td id="Contenue_Femmes"></td>
                                            </tr>
                                        </table>

                                        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                                            <tr data-tooltip="Les joueurs du royaume rouge">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-map text-red"></i>
                                                    <span style="vertical-align: super;">Shinsoo</span>
                                                </td>
                                                <td id="Contenue_Shinsoo"></td>
                                            </tr>
                                            <tr data-tooltip="Les joueurs du royaume jaune">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-map text-yellow"></i>
                                                    <span style="vertical-align: super;">Chunjo</span>
                                                </td>
                                                <td id="Contenue_Chunjo"></td>
                                            </tr>
                                            <tr data-tooltip="Les couleurs du royaume bleu">
                                                <td  style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-map text-blue"></i>
                                                    <span style="vertical-align: super;">Jinno</span>
                                                </td>
                                                <td id="Contenue_Jinno"></td>
                                            </tr>
                                        </table>

                                        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                                            <tr data-tooltip="Les personnages guerriers">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-person text-red"></i>
                                                    <span style="vertical-align: super;">Guerriers</span>
                                                </td>
                                                <td id="Contenue_Guerriers"></td>
                                            </tr>
                                            <tr data-tooltip="Les personnages suras">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-person text-gray"></i>
                                                    <span style="vertical-align: super;">Suras</span>
                                                </td>
                                                <td id="Contenue_Suras"></td>
                                            </tr>
                                            <tr data-tooltip="Les personnages ninjas">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-person text-green"></i>
                                                    <span style="vertical-align: super;">Ninjas</span>
                                                </td>
                                                <td id="Contenue_Ninjas"></td>
                                            </tr>
                                            <tr data-tooltip="Les personnages shamans">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-person text-yellow"></i>
                                                    <span style="vertical-align: super;">Shamans</span>
                                                </td>
                                                <td id="Contenue_Shamans"></td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="col-lg-6">

                                        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                                            <tr>
                                                <th style="border-top: 0px;" colspan="2">Site web :</th>
                                            </tr>
                                            <tr data-tooltip="Le nombre de connexions réussi au site">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-power text-green"></i>
                                                    <span style="vertical-align: super;">Connexions au site</span>
                                                </td>
                                                <td id="Contenue_Connexion_Site"></td>
                                            </tr>
                                            <tr data-tooltip="Le nombre de connexions d'utilisateurs">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-power text-purple"></i>
                                                    <span style="vertical-align: super;">Connexions uniques</span>
                                                </td>
                                                <td id="Contenue_Connexion_Site_Unique"></td>
                                            </tr>
                                            <tr data-tooltip="Le nombre de changements d'email">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-mail text-yellow"></i>
                                                    <span style="vertical-align: super;">Changements d'e-mail</span>
                                                </td>
                                                <td id="Contenue_Changement_Mail"></td>
                                            </tr>
                                            <tr data-tooltip="Le nombre de récupération de mots de passe">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-settings_backup_restore text-blue"></i>
                                                    <span style="vertical-align: super;">Récuperation de mots de passe</span>
                                                </td>
                                                <td id="Contenue_Recup_MDP"></td>
                                            </tr>
                                            <tr data-tooltip="Le nombre de changements de mot de passe">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-lock text-yellow"></i>
                                                    <span style="vertical-align: super;">Changements de mot de passe</span>
                                                </td>
                                                <td id="Contenue_Changement_MDP"></td>
                                            </tr>
                                            <tr data-tooltip="Le nombre de changement de mot de passe entrepôt">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-lock text-yellow"></i>
                                                    <span style="vertical-align: super;">Changements codes entrepôts</span>
                                                </td>
                                                <td id="Contenue_Changement_Code_Entrepot"></td>
                                            </tr>
                                            <tr data-tooltip="Nombre de deblocage de Yangs">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-settings_backup_restore text-blue"></i>
                                                    <span style="vertical-align: super;">Déblocages des Yangs</span>
                                                </td>
                                                <td id="Contenue_Deblocage_Yangs"></td>
                                            </tr>
                                            <tr data-tooltip="Nombre de vote pour le serveur">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-poll text-olive"></i>
                                                    <span style="vertical-align: super;">Nombre de votes</span>
                                                </td>
                                                <td id="Contenue_Nombre_Vote"></td>
                                            </tr>
                                            <tr data-tooltip="Nombre d'achats de personnage">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-shopping_cart text-olive"></i>
                                                    <span style="vertical-align: super;">Achat de personnage</span>
                                                </td>
                                                <td id="Contenue_Nombre_Achat_Perso"></td>
                                            </tr>
                                        </table>

                                        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                                            <tr data-tooltip="Nombre de tickets ouverts">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-forum text-green"></i>
                                                    <span style="vertical-align: super;">Tickets ouverts</span>
                                                </td>
                                                <td id="Contenue_Tickets_Ouverts"></td>
                                            </tr>
                                            <tr data-tooltip="Nombre de messages écrits">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-chat_bubble text-blue"></i>
                                                    <span style="vertical-align: super;">Messages écrits</span>
                                                </td>
                                                <td id="Contenue_Messages_Ecrits"></td>
                                            </tr>
                                            <tr data-tooltip="Nombre de discussions archivés">
                                                <td style="line-height: 10px;" >
                                                    <i class="material-icons md-icon-chat_bubble_outline text-gray"></i>
                                                    <span style="vertical-align: super;">Discussions archivées</span>
                                                </td>
                                                <td id="Contenue_Discussions_Archives"></td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">

                                <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                                    <tr>
                                        <th style="border-top: 0px;" colspan="2">Provenances :</th>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/fr.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">France</span>
                                        </td>
                                        <td id="Contenue_Pays_FR"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/be.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Belgique</span>
                                        </td>
                                        <td id="Contenue_Pays_BE"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/ch.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Suisse</span>
                                        </td>
                                        <td id="Contenue_Pays_CH"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/gb.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Angleterre</span>
                                        </td>
                                        <td id="Contenue_Pays_GB"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/de.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Allemagne</span>
                                        </td>
                                        <td id="Contenue_Pays_DE"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/ro.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Roumanie</span>
                                        </td>
                                        <td id="Contenue_Pays_RO"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/us.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">USA</span>
                                        </td>
                                        <td id="Contenue_Pays_US"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/it.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Italie</span>
                                        </td>
                                        <td id="Contenue_Pays_IT"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/es.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Espagne</span>
                                        </td>
                                        <td id="Contenue_Pays_ES"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/pl.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Pologne</span>
                                        </td>
                                        <td id="Contenue_Pays_PL"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/pt.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Portugal</span>
                                        </td>
                                        <td id="Contenue_Pays_PT"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/tn.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Tunisie</span>
                                        </td>
                                        <td id="Contenue_Pays_TN"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/dz.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Algérie</span>
                                        </td>
                                        <td id="Contenue_Pays_DZ"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 10px;" >
                                            <img class="Icone_Drapeaux" src="../../images/drapeaux/jp.png" height="14"/>&nbsp;
                                            <span style="vertical-align: super;">Japon</span>
                                        </td>
                                        <td id="Contenue_Pays_JP"></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <script type="text/javascript">

                function Ajax_Appel_Statistiques(page, objet) {

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
                        url: "pages/Statistiques/ajax/StatistiquesGet.php",
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

                                if (objet !== false) {
                                    $(".nav-tabs-custom li").attr("class", "");
                                    $(objet).parent("li").attr("class", "active");
                                }

                            } catch (e) {

                            }

                        }
                    });
                    return false;
                }

                Ajax_Appel_Statistiques(1, false);
            </script>
        </div>
        <?php
    }

}

$class = new Statistiques();
$class->run();
