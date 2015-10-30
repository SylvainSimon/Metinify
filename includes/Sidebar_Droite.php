<?php @include '../configPDO.php'; ?>
<?php include 'Top_5_Guildes.php'; ?>

<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Serveur Classyd</h3>
    </div>

    <div class="box-body">

        <script type="text/javascript" src="js/Actualisation_Status.js"></script>

        <table class="Table_Status_Serveurs">
            <tr><td colspan="3"><div class="barre"></div></td></tr>
            <tr class="Pointer" onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">
                <td>
                    Status du serveur :
                </td>		
                <?php
                $port = '81';
                $ip = '178.32.80.49';


                if (!$sock = @fsockopen($ip, $port, $num, $error, 0.5)) {
                    ?> <td id="ServeurClassyd" class="Align_Right"><img class="Ombre_Grise_2 Deplacement_Bouton_Status" title="Hors-Ligne" src="images/offline.gif" /></td> <?php
            } else {
                    ?> <td id="ServeurClassyd" class="Align_Right"><img class="Ombre_Grise_2 Deplacement_Bouton_Status" title="En Ligne" src="images/online.gif" /></td> <?php
                    fclose($sock);
                }
                ?>
            </tr>
            <tr><td colspan="3"><div class="barre"></div></td></tr>

            <tr title="Joueurs connectés ou téléportés les 15 dernières minutes" class="Pointer" onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">

                <td>
                    Joueurs connectés :
                </td>

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

                <td id="nombreconnecter" class="Align_Right Decalage_Nombre_Co"><?php echo $Nombre_De_Resultat; ?></td>
            </tr>

            <tr><td colspan="3"><div class="barre"></div></td></tr>
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