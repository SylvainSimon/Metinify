Verification_Longueur = 1;
MotdePasseVerif = 1;
        
function Verification_Longueur_Code(value){
            
    if (value.length < 6){
                
        document.getElementById('Champs_Saisie_Nouveau_Code_Entrepot').className = "form-control input-sm text";
        Verification_Longueur = 1;
                    
    }else{
                
        document.getElementById('Champs_Saisie_Nouveau_Code_Entrepot').className = "form-control input-sm text";
        Verification_Longueur = 0;
    }      
}

function Verifier_Mot_De_Passe_Identique(){
    
    repetermotdepasse = document.getElementById("Champs_Saisie_Repeter_Nouveau_Code_Entrepot").value;
        
    if (repetermotdepasse == document.getElementById("Champs_Saisie_Nouveau_Code_Entrepot").value){
            
        document.getElementById("Champs_Saisie_Repeter_Nouveau_Code_Entrepot").className = "form-control input-sm text";
            
        MotdePasseVerif = 0;
            
    }else{
            
        document.getElementById("Champs_Saisie_Repeter_Nouveau_Code_Entrepot").className = "form-control input-sm text";
            
        MotdePasseVerif = 1;
    }
}

function Changement_Code_Entrepot(){
            
    if(Verification_Longueur+MotdePasseVerif == 0){
                
        $.ajax({
            type: "POST",
            url: "pages/MonCompte/ajax/ajaxCodeEntrepotChangeExecute.php",
            data: "Code_Entrepot="+$("#Champs_Saisie_Repeter_Nouveau_Code_Entrepot").val()+"&Code_Avant="+$("#Champs_Saisie_Ancien_Code_Entrepot").val(),
            success: function(msg){
                if(msg==1){
                        
                    Ajax("pages/MonCompte/modules/CodeEntrepotChangeTerm.php");
                    
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
            alert("Votre code doit contenir 6 caracteres !");
        }
    }
    
    return false;
}