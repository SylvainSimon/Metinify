<div class="col-md-3 col-sm-4" style="line-height: 40px;">
    <div class="pull-left">
        <i id="Icone_Chargement" class="fa fa-spin material-icons md-icon-spin"></i>
        &nbsp;
        <span id="Phrase_Statut">Chargement...</span>
    </div>
</div>

<div class="col-md-6 col-sm-5" style="line-height: 40px; text-align: center;">
    
    <div id="Copyright"><a href="https://vamosmt2.org/">© VamosMT2</a> | Coded by <a href="skype:sylvanusproduction?add" target="_blank">Sylvanus</a></div>
    
</div>

<div class="col-md-3 col-sm-3">

    <div class="pull-right" style="padding-top: 5px; padding-bottom: 2px;">

        <a data-tooltip-position="top" data-tooltip="Notre page Facebook" href="https://www.facebook.com/groups/vamosmt2" target="_blank" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-facebook-alt withOpacity" style="background: #3b5998; border-radius: 50%; padding: 6px;"></i>
        </a>

        <a data-tooltip-position="top" data-tooltip="Notre page Twiter" href="https://twitter.com/VamosMT2" target="_blank" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-twitter withOpacity" style="background: #55acee; border-radius: 50%; padding: 6px;"></i>
        </a>

        <a data-tooltip-position="top" data-tooltip="Notre chaine Youtube" href="http://www.youtube.com/VamosMt2" target="_blank" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-youtube withOpacity" style="background: #FF2D2D; border-radius: 50%; padding: 6px;"></i>
        </a>

        <a data-tooltip-position="top" data-tooltip="Teamspeack" href="ts3server://ts3.vamosmt2.org" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-microphone withOpacity" style="background: #676B77; border-radius: 50%; padding: 6px;"></i>
        </a>

        <?php if (!empty($_SESSION['Administration_PannelAdmin'])) { ?>
            <?php if ($_SESSION['Administration_PannelAdmin']) { ?>
                <img title="Panneau d'administration" id="Icone_Administration_Acces" onclick="Changement_De_Decors('<?= $_SESSION['Administration_PannelAdmin_Jeton']; ?>')" src="images/icones/administration.png" height="27" />
            <?php } ?>
        <?php } ?>
    </div>

</div>
