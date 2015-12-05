Verification_Longueur = 1;
        
function verifchiffre(value){
            
    if (value.length < 7){
                
        document.getElementById('ChampsSaisieSecu').className = "form-control input-sm text";
        Verification_Longueur = 1;
                    
    }else{
                
        document.getElementById('ChampsSaisieSecu').className = "form-control input-sm text";
        Verification_Longueur = 0;
                    
        var RE = /^-{0,1}\d*\.{0,1}\d+$/;
                    
        if (!RE.test(value)){
                        
            document.getElementById('ChampsSaisieSecu').className = "form-control input-sm text";
            Verification_Longueur = 1;
                        
        }else{
                        
            document.getElementById('ChampsSaisieSecu').className = "form-control input-sm text";
            Verification_Longueur = 0;
        }
    }      
}
        
function VerificationSecu(){
            
    if(Verification_Longueur == 0){
                
        $.ajax({
            type: "POST",
            url: "pages/MonCompte/ajax/ajaxCodeEffacementCreateExecute.php",
            data: "Code_Effacement="+$("#ChampsSaisieSecu").val(),
            success: function(msg){
                if(msg==1){
                    
                    toastr.success("Le code de sureté à bien été défini.");
                    Ajax("pages/MonCompte/modules/MonCompte.php");
                    
                }else{
                    
                    alert("Une erreur s'est produite lors de la transaction avec le serveur.");
                }
            }
        });
        return false;
        
    }else{
                
        alert("Votre code doit contenir 7 caracteres et uniquement des chiffres !");
    }
    
    return false;
}