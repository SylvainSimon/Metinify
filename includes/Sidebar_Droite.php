<?php @include '../configPDO.php'; ?>
<?php include 'Top_5_Guildes.php'; ?>

<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Serveur</h3>

        <div class="box-tools" style="padding-top: 3px; padding-right: 1px;">
            <?php
            $port = '81';
            $ip = '178.32.80.49';


            if (!$sock = @fsockopen($ip, $port, $num, $error, 0.5)) {
                ?> <span id="ServeurClassyd"><i class="text-red material-icons md-icon-public md-22" data-tooltip="Hors-Ligne" data-tooltip-position="left"></i></span> <?php
            } else {
                ?> <span id="ServeurClassyd"><i class="text-green material-icons md-icon-public md-22" data-tooltip="En ligne" data-tooltip-position="left"></i></span> <?php
                fclose($sock);
            }
            ?>
        </div>
    </div>

    <div class="box-body">

        <script type="text/javascript" src="js/Actualisation_Status.js"></script>

        <table class="">

            <tr title="Joueurs connectés ou téléportés les 15 dernières minutes">

                <?php
                /* ------------------------------ Vérification connecte ---------------------------------------------- */
                $Comptage_Connectes = "SELECT id FROM player.player
                          WHERE player.last_play >= (NOW() - INTERVAL 90 MINUTE)";
                $Parametres_Comptage_Connectes = $Connexion->prepare($Comptage_Connectes);
                $Parametres_Comptage_Connectes->execute();
                $Parametres_Comptage_Connectes->setFetchMode(PDO::FETCH_OBJ);
                $Nombre_De_Resultat = $Parametres_Comptage_Connectes->rowCount();
                /* -------------------------------------------------------------------------------------------------- */
                ?>

                <?php if ($Nombre_De_Resultat == 0) { ?>
                    <td>
                        Aucun joueur connecté
                    </td>
                <?php } else { ?>

                    <td id="nombreconnecter"><?php echo $Nombre_De_Resultat; ?></td>

                    <td>
                        Joueur connectés
                    </td>
                <?php } ?>
            </tr>

        </table>

        <script type="text/javascript">
            setInterval("ServeurClassyd()", "60000");
        </script>
        <script type="text/javascript">
            setInterval("JoueursConnectes()", "30000");
        </script>

    </div>
</div>
<?php include 'Module_Vote.php'; ?>