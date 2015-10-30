<div class="col-md-3 col-sm-3">
    <div id="Barre_De_Statut" class="pull-left" title="Affiche le statut actuel.">
        <img id="Icone_Chargement" src="images/chargement.gif" width="17" />
        &nbsp;
        <span id="Phrase_Statut">Chargement du site...</span>
    </div>
</div>

<div class="col-md-6 col-sm-7" style="text-align: center;">
    <div id="Copyright">Copyright &copy; <a href="https://vamosmt2.org/">VamosMT2</a> | Coded by <a href="skype:sylvanusproduction?add" target="_blank">Sylvanus</a> 2010 - <?php echo Date('Y'); ?>. All rights reserved.</div>

    <div id="traducteur"></div>
</div>

<div class="col-md-3 col-sm-2">
    
    <div class="pull-right" style="padding-top: 5px; padding-bottom: 2px;">
        
        <a href="https://www.facebook.com/groups/vamosmt2" target="_blank" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-facebook-alt withOpacity" style="background: #3b5998; border-radius: 50%; padding: 6px;"></i>
        </a>
        
        <a href="https://twitter.com/VamosMT2" target="_blank" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-twitter withOpacity" style="background: #55acee; border-radius: 50%; padding: 6px;"></i>
        </a>
        
        <a href="http://www.youtube.com/VamosMt2" target="_blank" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-youtube withOpacity" style="background: #FF2D2D; border-radius: 50%; padding: 6px;"></i>
        </a>
        
        <a href="ts3server://ts3.vamosmt2.org" style="color:white; margin-left: 5px;">
            <i class="genericon genericon-microphone withOpacity" style="background: #676B77; border-radius: 50%; padding: 6px;"></i>
        </a>
        
        <?php if (!empty($_SESSION['Administration_PannelAdmin'])) { ?>
            <?php if ($_SESSION['Administration_PannelAdmin']) { ?>
                <img title="Panneau d'administration" id="Icone_Administration_Acces" onclick="Changement_De_Decors('<?= $_SESSION['Administration_PannelAdmin_Jeton']; ?>')" src="images/icones/administration.png" height="27" />
            <?php } ?>
        <?php } ?>
    </div>
    
</div>
<script src="Google/Element_Traduction.js" type='text/javascript'></script>
