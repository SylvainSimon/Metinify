<?php
$countMessageNonLu = \Site\SiteHelper::getSupportMessagesRepository()->countMessagesNonLu($this->objAccount->getId());

$Message = " message";
if ($countMessageNonLu > 1) {
    $Message = " messages";
}

if ($countMessageNonLu == 0) {
    echo "<span id='Messagerie_Notification'><i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='Aucun nouveau message' data-tooltip-position='left' style='cursor:pointer; top: 7px; position: relative; margin-left: 7px;' class='material-icons md-icon-chat md-24'></i></span>";
} else {

    echo "<span id='Messagerie_Notification'><i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='" . $countMessageNonLu . $Message. " non-lu' data-tooltip-position='left' style='cursor:pointer; top: 7px;  margin-left: 7px; position: relative;' class='material-icons text-green md-icon-chat md-22'></i></span>";
}
?>

<input type="hidden" id="Nombre_Message_Non_Lu" value="<?php echo $countMessageNonLu ?>" />

<script type="text/javascript">
<?php if ($countMessageNonLu > 0) { ?>
        var mon_title = "(<?= $countMessageNonLu ?>) VamosMt2 :: Site Officiel"
<?php } ?>

<?php if ($countMessageNonLu == 0) { ?>
        var mon_title = "VamosMt2 :: Site Officiel"
<?php } ?>
    document.title = mon_title;

</script>
