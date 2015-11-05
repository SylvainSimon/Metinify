<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Bannissement extends \PageHelper {

    public function run() {

        /* ------------------------ Recuperation Bannissement ---------------------------- */
        $Recuperation_Bannissement = "SELECT bannissements_actifs.date_debut_bannissement,
                                     bannissements_actifs.date_fin_bannissement,
                                     bannissements_actifs.commentaire_bannissement,
                                     bannissements_actifs.definitif,
                                     bannissements_actifs.duree,
                                     bannissement_raisons.raison,
                                     account.pseudo_messagerie
                              FROM site.bannissements_actifs
                              LEFT JOIN site.bannissement_raisons
                              ON bannissements_actifs.raison_bannissement = bannissement_raisons.id
                              LEFT JOIN account.account
                              ON account.id = bannissements_actifs.id_compte_gm
                              WHERE bannissements_actifs.id_compte = ?
                              LIMIT 1";
        $Parametres_Recuperation_Bannissement = $this->objConnection->prepare($Recuperation_Bannissement);
        $Parametres_Recuperation_Bannissement->execute(array($_SESSION["ID"]));
        $Parametres_Recuperation_Bannissement->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recuperation_Bannissement = $Parametres_Recuperation_Bannissement->rowCount();
        /* -------------------------------------------------------------------------------- */
        ?>
        <div class="Cadre_Principal">
            <?php if ($Nombre_De_Resultat_Recuperation_Bannissement != 0) { ?>
                <?php while ($Donnees_Recuperation_Bannissement = $Parametres_Recuperation_Bannissement->fetch()) { ?>
                    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                        <h1>Votre compte <?= $this->objAccount->getLogin(); ?> est banni</h1>
                    </div>
                    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                        <hr class="Hr_Haut"/>
                        En effet, le membre de l'équipe <b><?= $Donnees_Recuperation_Bannissement->pseudo_messagerie; ?></b> a procédé à une sanction envers votre compte.<br/><br/>
                        Cette sanction a été appliqué <b><?= \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Bannissement->date_debut_bannissement); ?></b> pour : <b><?= $Donnees_Recuperation_Bannissement->raison; ?></b>
                        <br/><br/>
                        <?php if ($Donnees_Recuperation_Bannissement->commentaire_bannissement != "") { ?>
                            Le modérateur a laissé un commentaire :
                            <div class="Commentaire_Bannissement">
                                <?= $Donnees_Recuperation_Bannissement->commentaire_bannissement; ?>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($Donnees_Recuperation_Bannissement->definitif == "1") { ?>
                            La suspension de ce compte et de tout ses personnage est définitive.<br/><br />
                            Si vous souhaitez contester, vous pouvez nous contacter via la page de <span onclick="Ajax('pages/Contact.php')" class="Pointer">contact</span> de VamosMt2.
                            <hr class="Hr_Bas">
                        <?php } else { ?>

                            Votre compte sera débloqué <?= \FonctionsUtiles::Formatage_Date($Donnees_Recuperation_Bannissement->date_fin_bannissement); ?>.<br/>
                            <hr class="Hr_Bas">
                            <br/>
                            Temps restant : <br/><br/>
                            <div id="countdown_dashboard">

                                <div class="dash weeks_dash">
                                    <span class="dash_title">weeks</span>
                                    <div class="digit">0</div>
                                    <div class="digit">0</div>
                                </div>

                                <div class="dash days_dash">
                                    <span class="dash_title">days</span>
                                    <div class="digit">0</div>
                                    <div class="digit">0</div>
                                </div>

                                <div class="dash hours_dash">
                                    <span class="dash_title">hours</span>
                                    <div class="digit">0</div>
                                    <div class="digit">0</div>
                                </div>

                                <div class="dash minutes_dash">
                                    <span class="dash_title">minutes</span>
                                    <div class="digit">0</div>
                                    <div class="digit">0</div>
                                </div>

                                <div class="dash seconds_dash">
                                    <span class="dash_title">seconds</span>
                                    <div class="digit">0</div>
                                    <div class="digit">0</div>
                                </div>

                            </div>
                            <script language="javascript" type="text/javascript">
                                jQuery(document).ready(function () {
                                    $('#countdown_dashboard').countDown({
                                        targetDate: {
                                            'day': <?= \FonctionsUtiles::Obtenir_Jours_Date($Donnees_Recuperation_Bannissement->date_fin_bannissement) ?>,
                                            'month': <?= \FonctionsUtiles::Obtenir_Mois_Date($Donnees_Recuperation_Bannissement->date_fin_bannissement) ?>,
                                            'year': <?= \FonctionsUtiles::Obtenir_Annee_Date($Donnees_Recuperation_Bannissement->date_fin_bannissement) ?>,
                                            'hour': <?= \FonctionsUtiles::Obtenir_Heure_Date($Donnees_Recuperation_Bannissement->date_fin_bannissement) ?>,
                                            'min': <?= \FonctionsUtiles::Obtenir_Minute_Date($Donnees_Recuperation_Bannissement->date_fin_bannissement) ?>,
                                            'sec': <?= \FonctionsUtiles::Obtenir_Seconde_Date($Donnees_Recuperation_Bannissement->date_fin_bannissement) ?>
                                        },
                                        omitWeeks: true
                                    });
                                });
                            </script>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                    <h1>Votre compte <?= $this->objAccount->getLogin(); ?> est suspendue.</h1>
                </div>
                <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                    <hr class="Hr_Haut"/>
                    En effet, un membre de l'équipe a procédé à une sanction envers votre compte.<br/><br/>
                    La suspension de ce compte et de tout ses personnage est définitive.<br/><br />
                    Si vous souhaitez contester, vous pouvez nous contacter via la page de <span onclick="Ajax('pages/Contact.php')" class="Pointer">contact</span> de VamosMt2.
                    <hr class="Hr_Bas">
                </div>
            <?php } ?>
        </div>
        <?php
    }

}

$class = new Bannissement();
$class->run();
