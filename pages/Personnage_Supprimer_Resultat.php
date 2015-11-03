<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Personnage_Supprimer_Resultat extends \PageHelper {

    public function run() {
        ?>

        <?php include '../pages/Fonctions_Utiles.php'; ?>
        <?php if (!empty($_GET["result"])) { ?>

            <?php if ($_GET["result"] == "Oui") { ?>
                <div class="box box-default flat">

                    <div class="box-header">
                        <h3 class="box-title">La suppression du personnage est un succès</h3>
                    </div>

                    <div class="box-body">
                        Votre personnage a été complètement effacer de nos serveurs.<br/><br/>

                        Tous les items, les amis et autres données ont été supprimées également.<br/><br/>

                        Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                        support de VamosMt2.<br/>

                    </div>

                    <div class="box-footer">
                        <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                    </div>

                </div>

            <?php } else if ($_GET["result"] == "Bad") { ?>
                <div class="box box-default flat">

                    <div class="box-header">
                        <h3 class="box-title">La suppression du personnage est un échec</h3>
                    </div>

                    <div class="box-body">
                        La suppression du personnage a été annulé a cause de vos erreurs<br/><br/>

                        Vous avez indiqué trois fois un mauvais numéro de vérification, ce qui entraine une annulation de la demande de suppression.<br/>
                        Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

                        Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                        support de VamosMt2.<br/>

                    </div>

                    <div class="box-footer">
                        <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                    </div>

                </div>
            <?php } else if ($_GET["result"] == "Chef") { ?>
                <div class="box box-default flat">

                    <div class="box-header">
                        <h3 class="box-title">La suppression du personnage est un échec</h3>
                    </div>

                    <div class="box-body">
                        La suppression du personnage a été annulé.<br/><br/>

                        Nous avons détecté que votre personnage est Chef d'une guilde, il faut d'abord que vous transfériez votre rôle à un autre joueur et que vous quittiez la guilde.<br/>
                        Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

                        Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                        support de VamosMt2.<br/>

                    </div>

                    <div class="box-footer">
                        <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                    </div>

                </div>
            <?php } else if ($_GET["result"] == "Membre") { ?>
                <div class="box box-default flat">

                    <div class="box-header">
                        <h3 class="box-title">La suppression du personnage est un échec</h3>
                    </div>

                    <div class="box-body">
                        La suppression du personnage a été annulé.<br/><br/>

                        Nous avons détecté que votre personnage est Membre d'une guilde, il faut d'abord que vous quittiez la guilde afin de ne pas générer de problème de place.<br/>
                        Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

                        Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                        support de VamosMt2.<br/>

                    </div>

                    <div class="box-footer">
                        <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                    </div>

                </div>
            <?php } else if ($_GET["result"] == "Expire") { ?>
                <div class="box box-default flat">

                    <div class="box-header">
                        <h3 class="box-title">La suppression du personnage est un échec</h3>
                    </div>

                    <div class="box-body">
                        La suppression du personnage a été annulé.<br/><br/>

                        Nous avons détecté que votre demande concernait sois un compte inexistant, sois vous n'avez pas suivie les procédures réglementaires.<br/>
                        Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

                        Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                        support de VamosMt2.<br/>
                    </div>

                    <div class="box-footer">
                        <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                    </div>

                </div>
            <?php } ?>
        <?php } else { ?>

        <?php } ?>
        <?php
    }

}

$class = new Personnage_Supprimer_Resultat();
$class->run();
