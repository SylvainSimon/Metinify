<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include 'Fonctions_Utiles.php'; ?>
<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Calendrier des Evènements</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
        <iframe src="restylegc-1.1.2/restylegc.php??showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=2&amp;hl=fr&amp;bgcolor=%23333333&amp;src=riv96o7mqtdj03f8vnd45u0s1k%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Europe%2FParis" width="680" height="600" frameborder="0" scrolling="no"></iframe>
    </div>

</div>