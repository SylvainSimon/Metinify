<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Gestion_Monnaies extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();

        $this->VerifyTheRight("gererMonnaies");
    }

    public function run() {
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Gestion des monnaies</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Selecteur_Option_Monnaie_Transaction">
                                        Action
                                    </label>

                                    <div class="input-group col-xs-12">
                                        <select class="form-control input-sm" id="Selecteur_Option_Monnaie_Transaction">
                                            <option value="1" selected>En ajouter</option>
                                            <option value="2">En enlever</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Selecteur_Option_Monnaie_Devise">
                                        Type
                                    </label>

                                    <div class="input-group col-xs-12">
                                        <select class="form-control input-sm" id="Selecteur_Option_Monnaie_Devise">
                                            <option value="1" selected>Vamonaies</option>
                                            <option value="2">Tananaies</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Input_Nom_Joueur_Monnaie">
                                        Compte
                                    </label>

                                    <div class="input-group col-xs-12">
                                        <input class="form-control input-sm" id="Input_Nom_Joueur_Monnaie" type="text" placeholder="Nom du compte..." autofocus />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-flat btn-success btn-sm" onclick="Update_Monnaie(500)">
                            500 monnaies
                        </button>
                        <button type="button" class="btn btn-flat btn-success btn-sm" onclick="Update_Monnaie(1000)">
                            1 000 monnaies
                        </button>
                        <button type="button" class="btn btn-flat btn-success btn-sm" onclick="Update_Monnaie(5000)">
                            5 000 monnaies
                        </button>
                        <button type="button" class="btn btn-flat btn-success btn-sm" onclick="Update_Monnaie(20000)">
                            20 000 monnaies
                        </button>
                        <button type="button" class="btn btn-flat btn-success btn-sm" onclick="Update_Monnaie(50000)">
                            50 000 monnaies
                        </button>
                    </div>


                    <script type="text/javascript">

                        function Update_Monnaie(nombre_monnaies) {

                            if ($("#Input_Nom_Joueur_Monnaie").val() == "") {

                                window.parent.Barre_De_Statut("Vous n'avez pas indiquer de compte.");
                                window.parent.Icone_Chargement(2);

                            } else {
                                window.parent.Barre_De_Statut("Distribution en cours...");
                                window.parent.Icone_Chargement(1);

                                $.ajax({
                                    type: "POST",
                                    url: "pages/Admin/ajax/SQL_Update_Monnaies.php",
                                    data: "nombre_monnaies=" + nombre_monnaies + "&transaction=" + $("#Selecteur_Option_Monnaie_Transaction").val() + "&devise=" + $("#Selecteur_Option_Monnaie_Devise").val() + "&compte=" + $("#Input_Nom_Joueur_Monnaie").val(),
                                    success: function (msg) {
                                        try {
                                            Parse_Json = JSON.parse(msg);

                                            if (Parse_Json.result == "WIN") {

                                                window.parent.Barre_De_Statut("Transaction effectué.");
                                                window.parent.Icone_Chargement(0);

                                            } else if (Parse_Json.result == "FAIL") {

                                                window.parent.Barre_De_Statut(Parse_Json.reasons);
                                                window.parent.Icone_Chargement(2);

                                            }

                                        } catch (e) {

                                            window.parent.Barre_De_Statut("Problème lors de la récuperation.");
                                            window.parent.Icone_Chargement(2);
                                        }
                                    }
                                });
                            }
                        }

                    </script>
                </div>
            </div>
            <div class="box-footer no-padding">
                <div class="row">
                    <div class="col-lg-12">

                        <?php
                        /* ------------------------ Historique Monnaies ---------------------------- */
                        $Historique_Gerer_Monnaies = "SELECT *
                                                          FROM site.administration_logs_gerer_monnaies
                                                          ORDER by date DESC
                                                          LIMIT 20";
                        $Parametres_Historique_Gerer_Monnaies = $this->objConnection->prepare($Historique_Gerer_Monnaies);
                        $Parametres_Historique_Gerer_Monnaies->execute();
                        $Parametres_Historique_Gerer_Monnaies->setFetchMode(\PDO::FETCH_OBJ);
                        $Nombre_De_Resultat_Historique_Gerer_Monnaies = $Parametres_Historique_Gerer_Monnaies->rowCount();
                        /* -------------------------------------------------------------------------- */
                        ?>
                        <table class="table table-condensed" style="border-collapse: collapse; margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th>Qui</th>
                                    <th>Action</th>
                                    <th>Graçe à</th>
                                    <th style="width: 250px;">Date</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php if ($Nombre_De_Resultat_Historique_Gerer_Monnaies != 0) { ?>
                                    <?php while ($Donnees_Historique_Gerer_Monnaies = $Parametres_Historique_Gerer_Monnaies->fetch()) { ?>
                                        <?php
                                        $objAccountDonateur = \Account\AccountHelper::getAccountRepository()->find($Donnees_Historique_Gerer_Monnaies->id_gm);
                                        ?>
                                        <tr>
                                            <?php if ($Donnees_Historique_Gerer_Monnaies->id_compte != 0) { ?>
                                                <?php $objAccountReceveur = \Account\AccountHelper::getAccountRepository()->find($Donnees_Historique_Gerer_Monnaies->id_compte); ?>
                                                <td><?= $objAccountReceveur->getLogin(); ?></td>
                                            <?php } else { ?>
                                                <td>Tout le monde</td>
                                            <?php } ?>

                                            <?php
                                            
                                            $Devise = \DeviseHelper::getLibelle($Donnees_Historique_Gerer_Monnaies->devise);
                                            
                                            if ($Donnees_Historique_Gerer_Monnaies->operation == "1") {
                                                $Operation = "a gagné";
                                            } else if ($Donnees_Historique_Gerer_Monnaies->operation == "2") {
                                                $Operation = "a perdu";
                                            }

                                            $Phrase_Action = "" . $Operation . " " . $Donnees_Historique_Gerer_Monnaies->montant . " " . $Devise . ".";
                                            ?>
                                            <td><?= $Phrase_Action; ?></td>
                                            <td><?= $objAccountDonateur->getPseudoMessagerie(); ?></td>
                                            <td><?= \FonctionsUtiles::Formatage_Date($Donnees_Historique_Gerer_Monnaies->date); ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr><td colspan="4">Aucuns historique enregistré.</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

}

$class = new Gestion_Monnaies();
$class->run();
