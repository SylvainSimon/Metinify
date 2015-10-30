<?php @session_write_close(); ?>
<?php @session_start(); ?>

<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Changement d'e-mail</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
        <hr class="Hr_Haut"/>

        Grâce à cette fonction, vous allez pouvoir changer votre adresse e-mail.<br/><br/>

        A la suite de ce formulaire, vous recevrez un code confidentiel par e-mail qui vous permettra
        de la modifier en toute sécurité.<br/><br/>

        Pour recevoir ce mail, cliquez sur le bouton "Envoyer".<br/>
        Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>
        <hr class="Hr_Bas">
        <input type="button" class="Bouton_Envoyer_Changer_Email Bouton_Normal" value="Envoyer" onclick="ChangerMail();" />
        <input type="button" class="Bouton_Annuler_Changer_Email Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />

    </div>
</div>

<script type="text/javascript">
                                     
    function ChangerMail(){
        
        Barre_De_Statut("Envoie du mail...");
        Icone_Chargement(1);
                                        
        $.ajax({
            type: "POST",
            url: "./ajax/SQL_Changer_Mail_EnvoieMail.php",
            success: function(msg){
                                                
                if(msg==1){
                    
                    Barre_De_Statut("Mail envoyé correctement...");
                    Icone_Chargement(0);
                    
                    Ajax("pages/Compte_ChangerMail_Mail_Envoye.php");
                }
                else{ 
                    
                    Barre_De_Statut("Erreur lors de l'envoie du mail.");
                    Icone_Chargement(2);
                }
            }
        });
        return false;
    }
                                    
</script>