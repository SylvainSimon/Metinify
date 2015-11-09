Verification_Longueur = 1;
MotdePasseVerif = 1;
        
function Verification_Longueur_Code(value){
            
    if (value.length < 7){
                
        document.getElementById('Champs_Saisie_Nouveau_Code_Effacement').className = "form-control input-sm text";
        Verification_Longueur = 1;
                    
    }else{
                
        document.getElementById('Champs_Saisie_Nouveau_Code_Effacement').className = "form-control input-sm text";
        Verification_Longueur = 0;
                    
        var RE = /^-{0,1}\d*\.{0,1}\d+$/;
                    
        if (!RE.test(value)){
                        
            document.getElementById('Champs_Saisie_Nouveau_Code_Effacement').className = "form-control input-sm text";
            Verification_Longueur = 1;
                        
        }else{
                        
            document.getElementById('Champs_Saisie_Nouveau_Code_Effacement').className = "form-control input-sm text";
            Verification_Longueur = 0;
        }
    }      
}

function Verifier_Mot_De_Passe_Identique(){
    
    repetermotdepasse = document.getElementById("Champs_Saisie_Repeter_Nouveau_Code_Effacement").value;
        
    if (repetermotdepasse == document.getElementById("Champs_Saisie_Nouveau_Code_Effacement").value){
            
        document.getElementById("Champs_Saisie_Repeter_Nouveau_Code_Effacement").className = "form-control input-sm text";
            
        MotdePasseVerif = 0;
            
    }else{
            
        document.getElementById("Champs_Saisie_Repeter_Nouveau_Code_Effacement").className = "form-control input-sm text";
            
        MotdePasseVerif = 1;
    }
}

function Changement_Code_Effacement(){
            
    if(Verification_Longueur+MotdePasseVerif == 0){
                
        $.ajax({
            type: "POST",
            url: "pages/MonCompte/ajax/ajaxCodeEffacementChangeExecute.php",
            data: "Code_Effacement="+$("#Champs_Saisie_Repeter_Nouveau_Code_Effacement").val()+"&Code_Avant="+$("#Champs_Saisie_Ancien_Code_Effacement").val(), // données à transmettre
            success: function(msg){
                if(msg==1){
                        
                    Ajax("pages/MonCompte/modules/CodeEffacementChangeTerm.php");
                    
                }else{
                    
                    alert("Le code renseigné n'est pas correct.");
                }
            }
        });
        return false;
        
    }else{
        
        if (MotdePasseVerif == 1){
                
            alert("Les deux codes ne sont pas identiques !");
            
        }else{
            alert("Votre code doit contenir 7 chiffres !");
        }
    }
    
    return false;
}