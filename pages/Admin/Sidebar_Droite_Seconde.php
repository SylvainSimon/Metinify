
<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Gestion</h3>
    </div>
    <div class="box-body no-padding hidden-sm hidden-xs">

        <table class="table table-condensed table-hover" style="border-collapse: collapse;">
            <?php if ($this->arrAdminRights["gererMonnaies"]) { ?>
                <tr onclick="Ajax('pages/Admin/Gestion_Monnaies.php');"><td> Gestion des monnaies</td></tr>
            <?php } ?>
            <?php if ($this->arrAdminRights["gererNews"]) { ?>
                <tr onclick="Ajax('pages/Admin/Gestion_News.php')"><td> Gestion des news</td></tr>
            <?php } ?>
        </table>
    </div>
</div>


<?php include 'pages/_Home/includes/StatutServer.php'; ?>
