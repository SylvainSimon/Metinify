<?php

namespace Pages\MonCompte;

require __DIR__ . '../../core/initialize.php';

class CodeEffacementCreateForm extends \PageHelper {

    public function run() {
        ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Création du code d'effacement</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                <script type="text/javascript" src="./js/Controle_Code_Effacement_Creation.js"></script>

                Entre ici le code qui servira à effacé l'un de vos personnage dans le jeux.

                <form action="javascript:void(0)" method="POST">

                    <table class="Table_Modele">
                        <tr>
                            <td class="Colonne_Gauche_Formulaire">Code d'effacement : </td>
                            <td>
                                <input type="text" maxlength="7" placeholder="●●●●●●●" autofocus="autofocus" id="ChampsSaisieSecu" class="Zone_Saisie_Creation_Code_Effacement" onkeyup="verifchiffre(this.value);"/>
                            </td>
                            <td class="Colonne_Droite_Formulaire">Le code doit faire 7 chiffres</td>
                        </tr>
                    </table>

                    Pour créer ce mot de passe, cliquez sur le bouton "Créer".<br/>
                    Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>
                    <hr class="Hr_Bas">
                    <input type="button" class="Bouton_Envoyer_Changer_Email Bouton_Normal" value="Créer" onclick="VerificationSecu();" />
                    <input type="button" class="Bouton_Annuler_Changer_Email Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />

            </div>
        </form>

        </div>
        </div>
        <?php
    }

}

$class = new CodeEffacementCreateForm();
$class->run();
