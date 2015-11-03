Verification_Longueur = 1;
        
function verifchiffre(value){
            
    if (value.length < 7){
                
        document.getElementById('ChampsSaisieSecu').className = "Zone_Saisie_Creation_Code_Effacement_Rouge";
        Verification_Longueur = 1;
                    
    }else{
                
        document.getElementById('ChampsSaisieSecu').className = "Zone_Saisie_Creation_Code_Effacement_Vert";
        Verification_Longueur = 0;
                    
        var RE = /^-{0,1}\d*\.{0,1}\d+$/;
                    
        if (!RE.test(value)){
                        
            document.getElementById('ChampsSaisieSecu').className = "Zone_Saisie_Creation_Code_Effacement_Rouge";
            Verification_Longueur = 1;
                        
        }else{
                        
            document.getElementById('ChampsSaisieSecu').className = "Zone_Saisie_Creation_Code_Effacement_Vert";
            Verification_Longueur = 0;
        }
    }      
}
        
function VerificationSecu(){
            
    if(Verification_Longueur == 0){
                
        $.ajax({
            type: "POST",
            url: "ajax/SQL_Code_Effacement_Definir.php",
            data: "Code_Effacement="+$("#ChampsSaisieSecu").val(),
            success: function(msg){
                if(msg==1){
                        
                    Ajax("pages/MonCompte/CodeEffacementCreateTerm.php");
                    
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