<?php @session_write_close(); ?>
<?php @session_start(); ?>

<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Changement Mot de Passe</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
        <hr class="Hr_Haut"/>
        <script type="text/javascript" src="./js/Controle_Changer_Mot_De_Passe.js"></script>

        <form action="javascript:void(0)" method="POST">

            <table class="Table_Modele">

                <tr>
                    <td class="Colonne_Gauche_Formulaire">Mot de passe actuel : </td>
                    <td><input maxlength="18" autofocus="autofocus" id="Saisie_Ancien_Mot_De_Passe" placeholder="●●●●●●●●" class="Zone_Saisie_Changer_Mot_De_Passe" type="password" onKeyUp="OldMDP(this.value);" name="user"/></td>
                    <td class="Colonne_Droite_Formulaire">Indiquez votre mot de passe</td>
                </tr>

                <tr>
                    <td class="Colonne_Gauche_Formulaire">Nouveau mot de passe : </td>
                    <td><input maxlength="18" id="Saisie_Nouveau_Mot_De_Passe" class="Zone_Saisie_Changer_Mot_De_Passe" placeholder="●●●●●●●●" type="password" name="password" onKeyUp="NouveauMDP(this.value);"/></td>
                    <td class="Colonne_Droite_Formulaire">Saisissez un nouveau mot de passe</td>
                </tr>

                <tr>
                    <td class="Colonne_Gauche_Formulaire">Répétez mot de passe : </td>
                    <td><input maxlength="18" id="SaisieRepeterNewMDP" class="Zone_Saisie_Changer_Mot_De_Passe" placeholder="●●●●●●●●" type="password" name="password" onKeyUp="RepeterNouveauMDP(this.value);"/></td>
                    <td class="Colonne_Droite_Formulaire">Répétez le nouveau mot de passe</td>
                </tr>

            </table>
            <hr class="Hr_Bas">
            <input type="button" class="Bouton_Envoyer_Modele Bouton_Normal" value="Valider" onclick="VerificationNewMDP();" />
            <input type="button" class="Bouton_Annuler_Modele Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />

        </form>

    </div>
</div>