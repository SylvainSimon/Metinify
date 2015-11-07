<div class="box box-default flat  hidden-sm hidden-xs">
    <div class="box-header">
        <h3 class="box-title">Serveur</h3>

        <div class="box-tools" style="padding-top: 3px; padding-right: 1px;">
            <?php
            $port = '81';
            $ip = '178.32.80.49';


            if (!$sock = @fsockopen($ip, $port, $num, $error, 0.5)) {
                ?> <span class="iconStatutServer"></span> <?php
            } else {
                ?> <span class="iconStatutServer"></span> <?php
                    fclose($sock);
                }
                ?>
        </div>
    </div>

    <div class="box-body">

        <?php
        /* ------------------------------ Vérification connecte ---------------------------------------------- */
        $Comptage_Connectes = "SELECT id FROM player.player
                          WHERE player.last_play >= (NOW() - INTERVAL 90 MINUTE)";
        $Parametres_Comptage_Connectes = $this->objConnection->prepare($Comptage_Connectes);
        $Parametres_Comptage_Connectes->execute();
        $Parametres_Comptage_Connectes->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Comptage_Connectes->rowCount();
        /* -------------------------------------------------------------------------------------------------- */
        ?>

        <?php if ($Nombre_De_Resultat == 0) { ?>
            <tr>
                <td>
                    Aucun joueur connecté
                </td>
            </tr>
        <?php } else { ?>

            <tr data-tooltip="Connectés ou téléportés les 15 dernières minutes.">
                <td id="nombreconnecter"><?php echo $Nombre_De_Resultat; ?></td>
                <td>
                    Joueur connectés
                </td>
            </tr>
        <?php } ?>

        <script type="text/javascript">
            ServeurClassyd();
            setInterval("ServeurClassyd()", "60000");
        </script>
        <script type="text/javascript">
            JoueursConnectes();
            setInterval("JoueursConnectes()", "30000");
        </script>

    </div>
</div>