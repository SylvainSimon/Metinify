<?php @session_write_close(); ?>
<?php @session_start(); ?>

<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Changement du code d'entrepôt</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
        <hr class="Hr_Haut"/>
        <script type="text/javascript" src="./js/Controle_Code_Entrepot_Changement.js"></script>

        Changez ici le code qui sert à ouvrir votre entrepôt dans le jeux.

        <form action="javascript:void(0)" method="POST">

            <table class="Table_Modele">
                <tr>
                    <td class="Colonne_Gauche_Formulaire">Code d'entrepôt : </td>
                    <td>
                        <input type="password" maxlength="6" autofocus="autofocus" placeholder="●●●●●●●" id="Champs_Saisie_Ancien_Code_Entrepot" class="Zone_Saisie_Changement_Code_Entrepot"/>
                    </td>
                    <td class="Colonne_Droite_Formulaire">Votre code actuel</td>
                </tr>
                <tr>
                    <td class="Colonne_Gauche_Formulaire">Nouveau code : </td>
                    <td>
                        <input type="password" maxlength="6" placeholder="●●●●●●●" id="Champs_Saisie_Nouveau_Code_Entrepot" class="Zone_Saisie_Changement_Code_Entrepot" onkeyup="Verification_Longueur_Code(this.value);"/>
                    </td>
                    <td class="Colonne_Droite_Formulaire">Entrez le nouveau code souhaité</td>
                </tr>
                <tr>
                    <td class="Colonne_Gauche_Formulaire">Répétez code : </td>
                    <td>
                        <input type="password" maxlength="6" placeholder="●●●●●●●" id="Champs_Saisie_Repeter_Nouveau_Code_Entrepot" class="Zone_Saisie_Changement_Code_Entrepot" onkeyup="Verifier_Mot_De_Passe_Identique();"/>
                    </td>
                    <td class="Colonne_Droite_Formulaire">Répétez le nouveau code</td>
                </tr>
            </table>
            Pour faire le changement, cliquez sur le bouton "Changer".<br/>
            Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>
            <hr class="Hr_Bas">
            <input type="button" class="Bouton_Envoyer_Changer_Email Bouton_Normal" value="Changer" onclick="Changement_Code_Entrepot();" />
            <input type="button" class="Bouton_Annuler_Changer_Email Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />
        </form>
    </div>
</div>