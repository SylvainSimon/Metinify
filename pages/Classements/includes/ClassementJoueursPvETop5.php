<div class="box box-default flat">

    <div class="box-header">
        <h3 class="box-title">Classement PVE</h3>
    </div>

    <div class="box-body no-padding">

        <table class="table table-hover table-condensed table-responsive" style="border-collapse: collapse;">

            <thead>
                <tr>
                    <th>Joueur</th>
                    <th class="Align_Right">Score</th>
                </tr>
            </thead>

            <?php $arrObjPlayers = Player\PlayerHelper::getPlayerRepository()->findTop("PVE", 6); ?>
            
            <tbody>
                <?php if (count($arrObjPlayers) > 0) { ?>
                    <?php foreach ($arrObjPlayers AS $key => $objPlayers) { ?>
                        <tr>
                            <td style="line-height: 10px;">
                                <?php if (($key + 1) == 1) {
                                    ?><i class="material-icons md-icon-star" style="color:#F3EC12;"></i>
                                    <?php
                                } else if (($key + 1) == 2) {
                                    ?><i class="material-icons md-icon-star text-gray"></i>
                                    <?php
                                } else if (($key + 1) == 3) {
                                    ?><i class="material-icons md-icon-star" style="color:#813838;"></i>
                                    <?php
                                } else if (($key + 1) == 4) {
                                    ?><i class="material-icons md-icon-bookmark" style="color:#F3EC12; opacity: 0.5"></i>
                                    <?php
                                } else if (($key + 1) == 5) {
                                    ?><i class="material-icons md-icon-bookmark text-gray" style="opacity: 0.5"></i>
                                    <?php
                                } else if (($key + 1) == 6) {
                                    ?><i class="material-icons md-icon-bookmark" style="color:#813838; opacity: 0.5"></i>
                                    <?php
                                } else {
                                    echo ($key + 1) . " eme";
                                }
                                ?>
                                <span style="vertical-align: text-top;"><?php echo $objPlayers["name"]; ?></span>
                            </td>
                            <td class="Align_Right">
                                <?php echo $objPlayers["scorePve"]; ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>