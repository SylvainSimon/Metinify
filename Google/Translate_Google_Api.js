(function(){
    var c=document,d="length",e=" avec Google\u00a0Traduction\u00a0?",h=")",k=".",l="Afficher cette page en\u00a0: ",m="D\u00e9sactiver la traduction (",n="D\u00e9sactiver pour\u00a0: ",p="",q="Google a traduit cette page automatiquement en\u00a0: ",r="Tout traduire en ",s="Traduire",t="Traduire cette page en ",u="Cette page est traduite en\u00a0: ",v="var ",x=this;
    function y(a,w){
        var f=a.split(k),b=x;
        !(f[0]in b)&&b.execScript&&b.execScript(v+f[0]);
        for(var g;f[d]&&(g=f.shift());)!f[d]&&void 0!==w?b[g]=w:b=b[g]?b[g]:b[g]={}
        }
        Math.random();
    var z={
    0:s,
    1:"Annuler",
    2:"Fermer",
    3:function(a){
        return q+a
        },
    4:function(a){
        return u+a
        },
    5:"Erreur\u00a0: Le serveur n'a pas pu ex\u00e9cuter votre requ\u00eate. Veuillez r\u00e9essayer ult\u00e9rieurement.",
    6:"En savoir plus",
    7:function(a){
        return p+a
        },
    8:s,
    9:"Traduction en cours",
    10:function(a){
        return t+(a+e)
        },
    11:function(a){
        return l+a
        },
    12:"Afficher l'original",
    13:"Le contenu de ce fichier local sera envoy\u00e9 \u00e0 Google pour traduction via une connexion s\u00e9curis\u00e9e.",
    14:"Le contenu de cette page s\u00e9curis\u00e9e sera envoy\u00e9 \u00e0 Google pour traduction via une connexion s\u00e9curis\u00e9e.",
    15:"Le contenu de cette page intranet sera envoy\u00e9 \u00e0 Google pour traduction via une connexion s\u00e9curis\u00e9e.",
    16:"Langues",
    17:function(a){
        return m+(a+h)
        },
    18:function(a){
        return n+a
        },
    19:"Toujours masquer",
    20:"Texte original\u00a0:",
    21:"Proposer une meilleure traduction",
    22:"Envoyer",
    23:"Tout traduire",
    24:"Tout restaurer",
    25:"Tout annuler",
    26:"Traduire les sections dans ma langue",
    27:function(a){
        return r+a
        },
    28:"Afficher les versions originales",
    29:"Options",
    30:"D\u00e9sactiver la traduction pour ce site",
    31:null,
    32:"Afficher d'autres traductions",
    33:"Cliquez sur les termes ci-dessus pour obtenir des traductions alternatives.",
    34:"Utiliser",
    35:"Appuyez sur la touche Maj pour faire glisser et r\u00e9organiser",
    36:"Cliquez ici pour voir d'autres traductions",
    37:"Maintenez la touche Maj enfonc\u00e9e, cliquez sur les termes ci-dessus et faites-les glisser pour les r\u00e9organiser.",
    38:"Merci de votre contribution \u00e0 Google Traduction.",
    39:"G\u00e9rer la traduction pour ce site",
    40:"Cliquez sur un mot pour obtenir d'autres traductions ou double-cliquez sur celui-ci pour le modifier directement.",
    41:"Texte d'origine",
    42:"Google\u00a0Traduction",
    43:s,
    44:"Votre correction a bien \u00e9t\u00e9 soumise."
};

var A=window.google&&google.translate&&google.translate._const;
if(A){
    var B;
        e:{
        for(var C=[],D=["10,0.0001,20130530"],E=0;E<D[d];++E){
            var F=D[E].split(","),G=F[0];
            if(G){
                var H=Number(F[1]);
                if(H&&!(0.1<H||0>H)){
                    var I=Number(F[2]),J=new Date,K=1E4*J.getFullYear()+100*(J.getMonth()+1)+J.getDate();
                    I&&!(I<K)&&C.push({
                        version:G,
                        a:H,
                        b:I
                    })
                    }
                }
        }
        for(var L=0,M=window.location.href.match(/google\.translate\.element\.random=([\d\.]+)/),N=Number(M&&M[1])||Math.random(),E=0;E<C[d];++E){
        var O=C[E],L=L+O.a;
        if(1<=L)break;
        if(N<L){
            B=O.version;
            break e
        }
    }
    B="14"
}
var P="/translate_static/js/element/%s/element_main.js".replace("%s",
    B);
if("0"==B){
    var Q=" translate_static js element %s element_main.js".split(" ");
    Q[Q[d]-1]="main_fr.js";
    P=Q.join("/").replace("%s",B)
    }
    var R=("https:"==window.location.protocol?"https://":"http://")+A._pah+P,S=c.createElement("script");
S.type="text/javascript";
S.charset="UTF-8";
S.src=R;
var T=c.getElementsByTagName("head")[0];
T||(T=c.body.parentNode.appendChild(c.createElement("head")));
T.appendChild(S);
y("google.translate.m",z);
y("google.translate.v",B)
};

})()