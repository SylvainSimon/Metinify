var Sidebar_Gauche_1 = true;
var Sidebar_Gauche_2 = true;
var Sidebar_Gauche_3 = true;
var Sidebar_Gauche_4 = true;

var Sidebar_Droite_1 = true;
var Sidebar_Droite_2 = true;
var Sidebar_Droite_3 = true;
var Sidebar_Droite_4 = true;

var Cadre_Principal_1 = true;
var Cadre_Principal_2 = true;
var Cadre_Principal_3 = true;
var Cadre_Principal_4 = true;
var Cadre_Principal_5 = true;

var Nombre_Transmis_Vamonaies = 0;
var Nombre_Transmis_Tananaies = 0;
            
function Fonction_Reteneuse_Tananaies(Nombre_Objectif_Tananaies){
                
    Nombre_Transmis_Tananaies = Nombre_Objectif_Tananaies;
    Definition_Compteurs_Tananaies(Nombre_Transmis_Tananaies);
}
            
            
function Definition_Compteurs_Tananaies(Nombre_Tananaies){
    
    if(parseInt(document.getElementById('Nombre_De_Tananaies').innerHTML, 10) != Nombre_Tananaies)
    {	   
        if (parseInt(document.getElementById('Nombre_De_Tananaies').innerHTML, 10) < Nombre_Tananaies){
            document.getElementById("Nombre_De_Tananaies").innerHTML = (parseInt(document.getElementById('Nombre_De_Tananaies').innerHTML, 10) + 1);
       
        }else if (parseInt(document.getElementById('Nombre_De_Tananaies').innerHTML) > Nombre_Tananaies){
            document.getElementById("Nombre_De_Tananaies").innerHTML = (parseInt(document.getElementById('Nombre_De_Tananaies').innerHTML, 10) - 1);
        }
    }
                
    if(parseInt(document.getElementById('Nombre_De_Tananaies').innerHTML, 10) != Nombre_Tananaies){
        setTimeout("Definition_Compteurs_Tananaies(Nombre_Transmis_Tananaies)", 1);
    }
}

function Fonction_Reteneuse_Vamonaies(Nombre_Objectif_Vamonaie){
                
    Nombre_Transmis_Vamonaies = Nombre_Objectif_Vamonaie;
    Definition_Compteurs_VamoNaies(Nombre_Transmis_Vamonaies);
}
            
            
function Definition_Compteurs_VamoNaies(Nombre_Vamonaies){
    
    if(parseInt(document.getElementById('Nombre_De_Vamonaies').innerHTML, 10) != Nombre_Vamonaies)
    {	   
        if (parseInt(document.getElementById('Nombre_De_Vamonaies').innerHTML, 10) < Nombre_Vamonaies){
            document.getElementById("Nombre_De_Vamonaies").innerHTML = (parseInt(document.getElementById('Nombre_De_Vamonaies').innerHTML, 10) + 1);
       
        }else if (parseInt(document.getElementById('Nombre_De_Vamonaies').innerHTML) > Nombre_Vamonaies){
            document.getElementById("Nombre_De_Vamonaies").innerHTML = (parseInt(document.getElementById('Nombre_De_Vamonaies').innerHTML, 10) - 1);
        }
        
    }
                
    if(parseInt(document.getElementById('Nombre_De_Vamonaies').innerHTML, 10) != Nombre_Vamonaies){
        
        setTimeout("Definition_Compteurs_VamoNaies(Nombre_Transmis_Vamonaies)", 2);
        
    }else{
        
    }
}

function Descente_Sidebar(){
    
    Barre_De_Statut("Chargement terminé.");
    Icone_Chargement(0);
}

function Descente_Contenue(){

    setTimeout(Descente_Sidebar, 1000);
}
  
        
function Slider_Sidebar_Gauche_1(){
        
    if (Sidebar_Gauche_1 == true){
        $('#Div_Sidebar_Gauche_1').slideUp(600);
        Sidebar_Gauche_1 = false;
    }else{
        $('#Div_Sidebar_Gauche_1').slideDown(600);
        Sidebar_Gauche_1 = true;
            
    }
}

function Slider_Sidebar_Gauche_2(){
        
    if (Sidebar_Gauche_2 == true){
        $('#Div_Sidebar_Gauche_2').slideUp(600);
        Sidebar_Gauche_2 = false;
    }else{
        $('#Div_Sidebar_Gauche_2').slideDown(600);
        Sidebar_Gauche_2 = true;
            
    }
}

function Slider_Sidebar_Droite_1(){
        
    if (Sidebar_Droite_1 == true){
        $('#Div_Sidebar_Droite_1').slideUp(600);
        Sidebar_Droite_1 = false;
    }else{
        $('#Div_Sidebar_Droite_1').slideDown(600);
        Sidebar_Droite_1 = true;
            
    }
}

function Slider_Sidebar_Droite_2(){
        
    if (Sidebar_Droite_2 == true){
        $('#Div_Sidebar_Droite_2').slideUp(600);
        Sidebar_Droite_2 = false;
    }else{
        $('#Div_Sidebar_Droite_2').slideDown(600);
        Sidebar_Droite_2 = true;
            
    }
}

function Slider_Sidebar_Droite_3(){
        
    if (Sidebar_Droite_3 == true){
        $('#Div_Sidebar_Droite_3').slideUp(600);
        Sidebar_Droite_3 = false;
    }else{
        $('#Div_Sidebar_Droite_3').slideDown(600);
        Sidebar_Droite_3 = true;
            
    }
}

function Slider_Cadre_Principal_1(){
        
    if (Cadre_Principal_1 == true){
        $('#Div_Cadre_Principal_1').slideUp(600);
        Cadre_Principal_1 = false;
    }else{
        $('#Div_Cadre_Principal_1').slideDown(600);
        Cadre_Principal_1 = true;
            
    }
}

function Slider_Cadre_Principal(numero){
        
    if(numero == 1){
        if (Cadre_Principal_1 == true){
            $('#Div_Cadre_Principal_1').slideUp(600);
            Cadre_Principal_1 = false;
        }else{
            $('#Div_Cadre_Principal_1').slideDown(600);
            Cadre_Principal_1 = true;
            
        }
    }else if(numero == 2){
        if (Cadre_Principal_1 == true){
            $('#Div_Cadre_Principal_2').slideUp(600);
            Cadre_Principal_1 = false;
        }else{
            $('#Div_Cadre_Principal_2').slideDown(600);
            Cadre_Principal_1 = true;
            
        }
    }else if(numero == 3){
        if (Cadre_Principal_1 == true){
            $('#Div_Cadre_Principal_3').slideUp(600);
            Cadre_Principal_1 = false;
        }else{
            $('#Div_Cadre_Principal_3').slideDown(600);
            Cadre_Principal_1 = true;
            
        }
    }else if(numero == 4){
        if (Cadre_Principal_1 == true){
            $('#Div_Cadre_Principal_4').slideUp(600);
            Cadre_Principal_1 = false;
        }else{
            $('#Div_Cadre_Principal_4').slideDown(600);
            Cadre_Principal_1 = true;
            
        }
    }
}