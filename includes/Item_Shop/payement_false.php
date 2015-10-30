<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="../../js/Jquery 1.8.0.js"></script>
        <script type="text/javascript" src="../../js/ui/Jquery_UI_1.8.23.js"></script>

        <link rel="stylesheet" href="../../css/Item_Shop.css">

    </head>
    <body>
        <div id="Rechargement_Resultat_Titre">
            Résultat du rechargement
        </div>
        <div class="Contenue_Resultat_Rechargement">
            <div class="Texte_Resultat_Rechargement">

                Le code Allopass que vous avez saisie est non-valide.<br/><br/>
                Votre rechargement a été annulé, pensez à conserver ce code si vous souhaitez faire
                une réclamation auprès du support de VamosMT2.
            </div>
        </div>
    </body>
</html>