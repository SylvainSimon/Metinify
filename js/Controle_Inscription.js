var UtilisateurSyntax = 1;
var UtilisateurDispo = 1;
var MotdePasse = 1;
var MotdePasseVerif = 1;
var MailSyntax = 1;
var Captcha = 1;

function CaptchaVerif(){
    
    var d = document.getElementById('SaisieCaptcha').value;
    if (d == c){
        
        Captcha = 0;  
        
    }else{
        
        Captcha = 1;
    }
}

function verifNomDutilisateur()
{
    pseudo = document.getElementById("SaisieUtilisateur").value;
    
    for(i=0 ; i < pseudo.length ; i++) {
            
        if((pseudo.charCodeAt(i) >= 0 && pseudo.charCodeAt(i) < 45) || 
            (pseudo.charCodeAt(i) >= 45 && pseudo.charCodeAt(i) < 48) || 
            (pseudo.charCodeAt(i) > 57 && pseudo.charCodeAt(i) < 65) || 
            (pseudo.charCodeAt(i) > 90 && pseudo.charCodeAt(i) < 95) || 
            (pseudo.charCodeAt(i) >= 95 && pseudo.charCodeAt(i) < 97) || 
            (pseudo.charCodeAt(i) > 122) && (pseudo.charCodeAt(i) < 128) ||
            (pseudo.charCodeAt(i) > 144)) {
                
            document.getElementById('ReponseDuTestNomDutilisateur').innerHTML = "<font color=\"#FD130B\">Caractère(s) non-autorisé(s).</font>";
            document.getElementById("SaisieUtilisateur").className = "Zone_Saisie_Inscription_Rouge";
                
            UtilisateurSyntax = 1;
                
            return;
        }else{
                
            UtilisateurSyntax = 0;
        }
    }
    if(pseudo.length<2){
            
        document.getElementById('ReponseDuTestNomDutilisateur').innerHTML = "<font color=\"#FD130B\">Nom d\'utilisateur trop court.</font>";
        document.getElementById("SaisieUtilisateur").className = "Zone_Saisie_Inscription_Rouge";
            
        UtilisateurSyntax = 1;
    }

    else if(texte = RequeteAJAX('ajax/VerifUtilisateur.php?pseudo='+escape(pseudo)))
    {  
        if(texte == 1){
            document.getElementById('ReponseDuTestNomDutilisateur').innerHTML = "<font color=\"#FD130B\">Nom d'utilisateur déjà utilisé.</font>";
            document.getElementById("SaisieUtilisateur").className = "Zone_Saisie_Inscription_Rouge";
                
            UtilisateurDispo = 1;
        }
        else if(texte == 2){
                
            document.getElementById('ReponseDuTestNomDutilisateur').innerHTML = "<font color=\"#6FCB8A\">Nom d'utilisateur libre</font>";
            document.getElementById("SaisieUtilisateur").className = "Zone_Saisie_Inscription_Vert";
                
            UtilisateurDispo = 0;
                
        }else{
                
            document.getElementById('ReponseDuTestNomDutilisateur').innerHTML = texte;
            
            UtilisateurDispo = 1;
            
        }
    }
}

function verifMDP(){
    
    motdepasse = document.getElementById("SaisieMDP").value;
        
    if (motdepasse.length > 5){
            
        document.getElementById('ReponseDuTestMotDePasse').innerHTML = "<font color=\"#6FCB8A\">Mot de passe correct.</font>";
        document.getElementById("SaisieMDP").className = "Zone_Saisie_Inscription_Vert";
            
        MotdePasse = 0;
            
    }else{
            
        document.getElementById('ReponseDuTestMotDePasse').innerHTML = "<font color=\"#FD130B\">Mot de passe trop court.</font>";
        document.getElementById("SaisieMDP").className = "Zone_Saisie_Inscription_Rouge";
            
        MotdePasse = 1;
    }
        
}

function verifRepeterMDP(){
    
    repetermotdepasse = document.getElementById("SaisieRepeterMDP").value;
        
    if (repetermotdepasse == document.getElementById("SaisieMDP").value){
            
        document.getElementById('ReponseDuTestRepeterMotDePasse').innerHTML = "<font color=\"#6FCB8A\">Mot de passe identique.</font>";
        document.getElementById("SaisieRepeterMDP").className = "Zone_Saisie_Inscription_Vert";
            
        MotdePasseVerif = 0;
            
    }else{
            
        document.getElementById('ReponseDuTestRepeterMotDePasse').innerHTML = "<font color=\"#FD130B\">Mot de passe différent.</font>";
        document.getElementById("SaisieRepeterMDP").className = "Zone_Saisie_Inscription_Rouge";
            
        MotdePasseVerif = 1;
    }
}

function VerifSyntaxEmail(){
    
    mail = document.getElementById("SaisieMail").value;
    
    reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    
    if(reg.test(mail)){
        
        syntax = true;
        document.getElementById('ReponseDuTestMail').innerHTML = "<font color=\"#6FCB8A\">Adresse e-mail valide.</font>";
        document.getElementById("SaisieMail").className = "Zone_Saisie_Inscription_Vert";
        
        MailSyntax = 0;
        
    }else{
        
        syntax = false;
        document.getElementById('ReponseDuTestMail').innerHTML = "<font color=\"#FD130B\">Adresse e-mail invalide.</font>";
        document.getElementById("SaisieMail").className = "Zone_Saisie_Inscription_Rouge";
        
        MailSyntax = 1;
    }
}

function RequeteAJAX(fichier)
{
    if(window.XMLHttpRequest) // FIREFOX
        xhr_object = new XMLHttpRequest();
    else if(window.ActiveXObject) // IE
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
    xhr_object.open("GET", fichier, false);
    xhr_object.send(null);
    if(xhr_object.readyState == 4) return(xhr_object.responseText);
    else return(false);
}

function VerificationFormulaire() {
    
    typedecalcule2 = Math.ceil(Math.random() * 3);
            
    if (typedecalcule2 == 1){
                
        Generation1();
        typedecalcule = 1;
                
    }else if (typedecalcule2 == 2){
                
        Generation2();
        typedecalcule = 2;
                
    }else if (typedecalcule2 == 3){
                
        Generation3();
        typedecalcule = 3;
    }
    
    if ((UtilisateurSyntax+UtilisateurDispo+MotdePasse+MotdePasseVerif+MailSyntax+Captcha) == 0){
        
        Barre_De_Statut("Inscription en cours...");
        Icone_Chargement(1);
        						 
        $.ajax({
            type: "POST",
            url: "ajax/SQL_Inscription.php",
            data: "Utilisateur="+$("#SaisieUtilisateur").val()+"&Mot_De_Passe="+$("#SaisieMDP").val()+"&Email="+$("#SaisieMail").val(),
            success: function(msg){
                if(msg==1){
                    
                    Ajax("pages/Inscription_Resultat.php?Resultat=oui");
                }
                else{
                    
                    Ajax("pages/Inscription_Resultat.php?Resultat=non");
                }
            }
        });
        return false;
        
    }else{
        
        messagederreur = "";
        
        if(UtilisateurSyntax == 1){
            messagederreur += "- Nom d'utilisateur non-correct\n";
            verifNomDutilisateur();
        }
        if((UtilisateurDispo == 1)&&(UtilisateurSyntax == 0)){
            messagederreur += "- Le nom d'utilisateur n'est pas disponible.\n";
            verifNomDutilisateur();
        }
        if(MotdePasse == 1){
            messagederreur += "- Le mot de passe doit contenir 6 caractères minimum.\n";
            verifMDP();
        }
        if(MotdePasseVerif == 1){
            
            if (document.getElementById("SaisieRepeterMDP").value != ""){
                messagederreur += "- Les deux mots de passe ne sont pas identiques.\n";
                verifRepeterMDP();
            }else{
                
                messagederreur += "- Indiquez une deuxieme fois le mot de passe.\n";
                document.getElementById('ReponseDuTestRepeterMotDePasse').innerHTML = "<font color=\"#FD130B\">Répétez mot de passe.</font>";
                document.getElementById("SaisieRepeterMDP").className = "Zone_Saisie_Inscription_Rouge";
            }
        }
        if(MailSyntax == 1){
            messagederreur += "- L'adresse e-mail indiqué n'est pas correct.\n";
            VerifSyntaxEmail();
        }
        
        if(Captcha == 1){
            
            messagederreur += "- Le résultat du calcul est incorrect\n";

            typedecalcule2 = Math.ceil(Math.random() * 3);
            
            if (typedecalcule2 == 1){
                
                Generation1();
                typedecalcule = 1;
                
            }else if (typedecalcule2 == 2){
                
                Generation2();
                typedecalcule = 2;
                
            }else if (typedecalcule2 == 3){
                
                Generation3();
                typedecalcule = 3;
            }
            

            $.ajax({
                type: "POST",
                url: "ajax/SQL_CompteurCaptcha.php",
                success: function(msg){

                    if(msg == 1){
                       
                        document.getElementById("ReponseCaptcha").innerHTML = "2 tentatives restantes";
                    }else if(msg == 2){
                       
                        document.getElementById("ReponseCaptcha").innerHTML = "1 tentative restante";
                        
                    }else{
                       
                        Ajax("pages/Inscription_Formulaire.php");
                    }

                }
            });

        }
        
        alert(messagederreur);
        
        messagederreur = "";
        
        return;
    }
}