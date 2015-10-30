<div id="Barre_De_Statut" title="Affiche le statut actuel.">
    <img id="Icone_Chargement" src="images/chargement.gif" width="17" />
    &nbsp;
    <span id="Phrase_Statut">Chargement du site...</span>
</div>
<div id="Copyright">Copyright &copy; <a href="https://vamosmt2.org/">VamosMT2</a> | Coded by <a href="http://www.sylvanus-production.com/" target="_blank">Sylvanus</a> 2010 - <?php echo Date('Y'); ?>. All rights reserved.</div>

<div id="traducteur"></div>
<script src="Google/Element_Traduction.js" type='text/javascript'></script>

<div id="Barre_Social">
    
    <img title="Notre page Facebook" onclick="window.open('https://www.facebook.com/groups/vamosmt2')" src="images/facebook.png" height="27" />
    <img title="Notre page Twitter" onclick="window.open('https://twitter.com/VamosMT2')" src="images/twitter.gif" height="26" />
    <img title="Notre Chaîne Youtube" onclick="window.open('http://www.youtube.com/VamosMt2')" src="images/youtubegrand.png" height="27" />
    <a href="ts3server://ts3.vamosmt2.org"><img title="Notre Teamspeak 3" src="images/teamspeack.png" height="27" /></a>
    <?php if (!empty($_SESSION['Administration_PannelAdmin'])) { ?>
        <?php if ($_SESSION['Administration_PannelAdmin']) { ?>
            <img title="Panneau d'administration" id="Icone_Administration_Acces" onclick="Changement_De_Decors('<?= $_SESSION['Administration_PannelAdmin_Jeton']; ?>')" src="images/icones/administration.png" height="27" />
        <?php } ?>
    <?php } ?>
</div>