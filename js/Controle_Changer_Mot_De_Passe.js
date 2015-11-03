var AncienMDP = 1;
var NewMotdePasse = 1;
var NewMotdePasseVerif = 1;

function OldMDP(ancienmdp){

    if (ancienmdp == ""){
        AncienMDP = 1;
    }else{
        AncienMDP = 0;
    }
}

function NouveauMDP(){
 
    motdepasse = document.getElementById("Saisie_Nouveau_Mot_De_Passe").value;

    if (motdepasse.length > 5){
        document.getElementById("Saisie_Nouveau_Mot_De_Passe").className = "form-control input-sm text";
        NewMotdePasse = 0;
    }else{
        document.getElementById("Saisie_Nouveau_Mot_De_Passe").className = "form-control input-sm text";
        NewMotdePasse = 1;
    }
}

function RepeterNouveauMDP(){

    repetermotdepasse = document.getElementById("SaisieRepeterNewMDP").value;

    if (repetermotdepasse == document.getElementById("Saisie_Nouveau_Mot_De_Passe").value){
        document.getElementById("SaisieRepeterNewMDP").className = "form-control input-sm text";
        NewMotdePasseVerif = 0;
    }else{
        document.getElementById("SaisieRepeterNewMDP").className = "form-control input-sm text";
        NewMotdePasseVerif = 1;
    }
}

function VerificationNewMDP() {

    if ((NewMotdePasse+NewMotdePasseVerif+AncienMDP) == 0){
						 
        $.ajax({
            type: "POST",
            url: "ajax/SQL_Changer_Mot_De_Passe_Envoie_Mail.php",
            data: "Ancien_Mot_De_Passe="+$("#Saisie_Ancien_Mot_De_Passe").val()+"&Nouveau_Mot_De_Passe="+$("#Saisie_Nouveau_Mot_De_Passe").val(),
            success: function(msg){
                if(msg==1){
                    Ajax('pages/MonCompte/PasswordChangeSendEmail.php');
                }else {
                    alert("Le mot de passe actuel est incorrect.");
                }
            }
        });
        return false;

    }else{

        messagederreur = "";

        if(NewMotdePasse == 1){
            messagederreur += "- Le mot de passe doit contenir 6 caractères minimum.\n";
            NouveauMDP();
        }
        if(NewMotdePasseVerif == 1){
            if (document.getElementById("SaisieRepeterNewMDP").value != ""){
                messagederreur += "- Les deux mots de passe ne sont pas identiques.\n";
                RepeterNouveauMDP();
            }else{
                messagederreur += "- Indiquez une deuxieme fois le mot de passe.\n";
                document.getElementById("SaisieRepeterNewMDP").className = "Zone_Saisie_Changer_Mot_De_Passe_Rouge";
            }
        }

        if(AncienMDP == 1){
            messagederreur += "- Il faut indiquer votre ancien mot de passe.\n";
            NouveauMDP();
        }

        alert(messagederreur);

        messagederreur = "";

        return false;
    }
}