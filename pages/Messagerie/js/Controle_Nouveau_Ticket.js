var Objet_Selectionner = 1;
var Longueur_Minimal = 1;

function Longueur_minimal(){
    if(document.getElementById('Textarea_Nouveau_Ticket').value.length < 50){
        
        Longueur_Minimal = 1;
    }else{
        
        Longueur_Minimal = 0;
    }
}


function Assignation_Ticket(numero_discussion) {

    window.parent.Barre_De_Statut("Assignation et déplacement du ticket...");
    window.parent.Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "pages/Messagerie/ajax/ajaxDiscussionAssign.php",
        data: "Numero_Discussion=" + numero_discussion,
        success: function (msg) {

            if (msg == "NULL") {

                window.parent.Barre_De_Statut("Le message n'existe plus.");
                window.parent.Icone_Chargement(2);

            } else {

                Ajax_Ouverture_Ticket(msg);
            }
        }
    });
}

function Objet_selectionner(){
    
    if(document.getElementById('Selecteur_Objet_Ticket').value != "--"){
        
        Objet_Selectionner = 0;
        
    }else{
        
        Objet_Selectionner = 1
    }
    
}

function Valider_Formulaire_Nouveau_Ticket(){
    
    Longueur_minimal();
    
    window.parent.Barre_De_Statut("Envoie du nouveau ticket...");
    window.parent.Icone_Chargement(1);
    
    if(Longueur_Minimal+Objet_Selectionner == 0){
        
        $.ajax({
            type: "POST",
            url: "pages/Messagerie/ajax/ajaxDiscussionCreate.php",
            data: "Nouveau_Ticket_Objet="+$("#Selecteur_Objet_Ticket").val()+"&Nouveau_Ticket_Message="+$("#Textarea_Nouveau_Ticket").val(),
            success: function(msg){
                
                console.log(msg); 
                
                if(msg==1){
                    
                    window.parent.Barre_De_Statut("Message envoyé avec succès.");
                    window.parent.Icone_Chargement(0);
                    
                    Ajax_Appel_Messagerie("pages/Messagerie/MessagerieInbox.php");
                }
                else{
                    
                    window.parent.Barre_De_Statut("Envoie du ticket échoué.");
                    window.parent.Icone_Chargement(2);
                }
            }
        });
        return false;
    }else{
        
        var Message_Erreur = "";
        
        if (Objet_Selectionner == 1){
            
            Message_Erreur += "Veuillez séléctionner un objet pour votre demande.\n";
        }
        
        if (Longueur_Minimal == 1){
            
            Message_Erreur += "Votre message est trop cours.\n";
        }
        
        alert(Message_Erreur);
        
        window.parent.Barre_De_Statut("Envoie annulé.");
        window.parent.Icone_Chargement(2);
        
        return false;
    }
}