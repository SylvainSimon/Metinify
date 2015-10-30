<script type="text/javascript">var Clique_Code_Effacement = 0;</script>
<script type="text/javascript">var Clique_Code_Entrepot = 0;</script>
<div id="Onglet_InformationGeneral">
    <table id="Tableau1" class="box_shadows">
        <tr>
            <td class="TD_Bleu">Compte :</td>
            <td><?php echo $Resultat_Appel_Compte->login; ?></td>
        </tr>
        <tr>
            <td class="TD_Bleu">Création :</td>
            <?php
            $Explosion_DateEntiere = explode(" ", $Resultat_Appel_Compte->create_time);

            $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);
            $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

            if ($Explosion_DateEntiere[0] != '0000-00-00') {

                $Date_Jours = $Explosion_Date[2];
                $Date_Mois = $Array_Mois[$Explosion_Date[1]];
                $Date_Annee = $Explosion_Date[0];
            }

            $Date_Heure = $Explosion_Heure[0];
            $Date_Minute = $Explosion_Heure[1];
            $Date_Seconde = $Explosion_Heure[2];

            if ($Explosion_DateEntiere[0] != '0000-00-00') {
                $Recomposition_Date = "Le " . $Date_Jours . " " . $Date_Mois . " " . $Date_Annee . " à " . $Date_Heure . "h" . $Date_Minute . "m" . $Date_Seconde . "s";
            } else {
                $Recomposition_Date = "La date n'a pas été définie.";
            }
            ?>
            <td><span style="font-size: 12px; font-weight: bold;"><?php echo $Recomposition_Date; ?></span></td>
        </tr>
        <tr>
            <td class="TD_Bleu">Ip du compte :</td></td>
            <?php if ($Resultat_Appel_Compte->ip_creation == '') { ?>
                <td>Non-définie</td>

            <?php } else { ?>
                <td><?php echo $Resultat_Appel_Compte->ip_creation; ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td class="TD_Bleu">Empire :</td>
            <td>
                <?php if ($Resultat_Appel_Compte->empire == 1) { ?>
                    <img src="../images/empire/red.jpg" alt="Shinsoo" />
                <?php } else if ($Resultat_Appel_Compte->empire == 2) { ?> 
                    <img src="../images/empire/yellow.jpg" alt="Chunjo" />
                <?php } else if ($Resultat_Appel_Compte->empire == 3) { ?> 
                    <img src="../images/empire/blue.jpg" alt="Jinno" />
                <?php } else { ?> 
                    <img src="../images/empire/Royaume_Inconnu.jpg" alt="Inconnu" />
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td class="TD_Bleu">E-mail :</td>
            <td>
                <?php
                $chaineCoupe = substr($Resultat_Appel_Compte->email, 0, 8);
                $chaineCoupe = trim($chaineCoupe);

                $caractere = (strlen($Resultat_Appel_Compte->email) - 8);
                for ($i = 0; $i < $caractere; $i++) {
                    $i++;
                    $chaineCoupe.= "●";
                }
                ?>
                <?php echo $chaineCoupe; ?>

            </td>
        </tr>
        <tr>
            <td class="TD_Bleu">Mot de passe :</td>
            <td>●●●●●●●●●●●●</td>
        </tr>
        <?php if ($Resultat_Appel_Compte->social_id == "") { ?>
            <tr>
                <td class="TD_Bleu">Sécurité :</td>
                <td>Aucun code définie</td>
            </tr>
        <?php } else { ?>
            <tr>
                <td class="TD_Bleu">Sécurité :</td>
                <td id="Code_Effacement">●●●●●●●</td>
            </tr>
        <?php } ?>

        <?php if ($Resultat_Appel_Compte->Safebox_Size == "") { ?>
            <tr>
                <td class="TD_Bleu">Entrepôt :</td>
                <td>Entrepot non-crée.</td>
            </tr>
        <?php } else { ?>
            <?php if ($Resultat_Appel_Compte->Safebox_Password == "") { ?>
                <?php $Password_Entrepot = "000000"; ?>
            <?php } else { ?>
                <?php $Password_Entrepot = $Resultat_Appel_Compte->Safebox_Password; ?>
            <?php } ?>
            <tr>
                <td class="TD_Bleu">Entrepôt :</td>
                <td id="Code_Entrepot">●●●●●●</td>
            </tr>
        <?php } ?>

    </table>

    <div class="Icone_Modifier_Email Pointer" onclick="window.parent.Ajax('pages/Compte_ChangerMail.php'); window.parent.$.fancybox.close();" title="Modifier mon E-mail"></div>
    <div class="Icone_Modifier_Mot_De_Passe Pointer" onclick="window.parent.Ajax('pages/Compte_Changer_Mot_De_Passe.php'); window.parent.$.fancybox.close();" title="Modifier mon Mot de Passe"></div>

    <?php if ($Resultat_Appel_Compte->social_id == "") { ?>
        <div class="Icone_Creer_Code_Effacement Pointer" onclick="window.parent.Ajax('pages/Compte_Code_Effacement_Creation.php'); window.parent.$.fancybox.close();" title="Définir mon code d'effacement"></div>
    <?php } else { ?>
        <div class="Icone_Modifier_Code_Effacement Pointer" onclick="window.parent.Ajax('pages/Compte_Code_Effacement_Modifier.php'); window.parent.$.fancybox.close();" title="Modifier mon code"></div>
        <div class="Icone_Voir_Code_Effacement Pointer" onclick="if(Clique_Code_Effacement == 0){document.getElementById('Code_Effacement').innerHTML = '<?php echo $Resultat_Appel_Compte->social_id; ?>'; Clique_Code_Effacement = 1;}else{document.getElementById('Code_Effacement').innerHTML = '●●●●●●●'; Clique_Code_Effacement = 0;};" title="Voir le code"></div>
    <?php } ?>

    <?php if ($Resultat_Appel_Compte->Safebox_Size == "") { ?>
    <?php } else { ?>
        <div class="Icone_Modifier_Code_Entrepot Pointer" onclick="window.parent.Ajax('pages/Compte_Code_Entrepot_Modifier.php'); window.parent.$.fancybox.close();" title="Modifier mon code"></div>
        <!--<div class="Icone_Voir_Code_Entrepot Pointer" onclick="if(Clique_Code_Entrepot == 0){document.getElementById('Code_Entrepot').innerHTML = '<?php echo $Password_Entrepot; ?>'; Clique_Code_Entrepot = 1;}else{document.getElementById('Code_Entrepot').innerHTML = '●●●●●●'; Clique_Code_Entrepot = 0;};" title="Voir le code"></div>-->
		<div class="Icone_Voir_Code_Entrepot Pointer" onclick="window.parent.Ajax('includes/Entrepot_Oublie.php'); window.parent.$.fancybox.close();" title="Récupérer le code entrepôt"></div>

		<?php } ?>

    <?php
    /* ------------------------ Recuperation Compte ----------------------------- */
    $Liste_Personnages = "SELECT player.name,
                                 player.id,
                                 player.level,
                                 player.job,
                                 player.ip,
                                 player.exp,
                                 player.playtime,
                                 player.skill_group,
                                 player.last_play
                          FROM player.player
                          WHERE player.account_id = ?
                          ORDER by level DESC
                          LIMIT 4";
    $Parametres_Liste_Personnages = $Connexion->prepare($Liste_Personnages);
    $Parametres_Liste_Personnages->execute(array($Appel_Compte_Id));
    $Parametres_Liste_Personnages->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat = $Parametres_Liste_Personnages->rowCount();

    /* -------------------------------------------------------------------------- */
    ?>
    <table id="Tableau_Personnages" class="box_shadows">
        <thead>
            <tr>
                <th width="50">Race</th>
                <th width="130">Pseudonyme</th>
                <th width="60">Classe</th>
                <th width="30">Lvl</th>
                <th width="90">Experience</th>
                <th>Temps de jeu</th>
                <th width="95">Ip</th>
                <th width="30">Status</th>
            </tr>

        </thead>

        <tbody>

            <?php if ($Nombre_De_Resultat != 0) { ?>

                <?php while ($Resultat_Liste_Personnages = $Parametres_Liste_Personnages->fetch()) { ?>

                    <?php
                    $lHeure = floor($Resultat_Liste_Personnages->playtime / 60);
                    $lesMinutes = (($Resultat_Liste_Personnages->playtime) % 60);
                    $lJours = floor($lHeure / 24);

                    $lHeure = ($lHeure - ($lJours * 24));

                    if ($lesMinutes < 10) {

                        $lesMinutes = "0" . $lesMinutes;
                    }
                    ?>
                    <tr title="Cliquez pour voir les détails du personnage" onclick="Appel_Joueur(<?php echo $Resultat_Liste_Personnages->id; ?>)" class="Pointer" onmouseover="this.style.backgroundColor='#333333';" onmouseout="this.style.backgroundColor='transparent';">
                        <td align="center">
                            <?php if ($Resultat_Liste_Personnages->job == "0") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/0_mini.png" height="25"/>
                            <?php } else if ($Resultat_Liste_Personnages->job == "1") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/1_mini.png" height="25"/>
                            <?php } else if ($Resultat_Liste_Personnages->job == "2") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/2_mini.png" height="25"/>
                            <?php } else if ($Resultat_Liste_Personnages->job == "3") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/3_mini.png" height="25"/>
                            <?php } else if ($Resultat_Liste_Personnages->job == "4") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/4_mini.png" height="25"/>
                            <?php } else if ($Resultat_Liste_Personnages->job == "5") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/5_mini.png" height="25"/>
                            <?php } else if ($Resultat_Liste_Personnages->job == "6") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/6_mini.png" height="25"/>
                            <?php } else if ($Resultat_Liste_Personnages->job == "7") { ?> 
                                <img class="cadrephotoclassement" src="../images/races/7_mini.png" height="25"/>
                            <?php } ?>
                        </td>
                        <td>
                            <?php echo $Resultat_Liste_Personnages->name ?>
                        </td>
                        <td>

                            <?php if ($Resultat_Liste_Personnages->job == 0) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    Corp à Corp
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    Mental
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>	
                            <?php } elseif ($Resultat_Liste_Personnages->job == 1) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    Assasin
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    Archer
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Resultat_Liste_Personnages->job == 2) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    Arme magique
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    Magie Noir
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Resultat_Liste_Personnages->job == 3) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    Dragon
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    Soin
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Resultat_Liste_Personnages->job == 4) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    CàC
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    Mental
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>	
                            <?php } elseif ($Resultat_Liste_Personnages->job == 5) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    Assasin
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    Archer
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Resultat_Liste_Personnages->job == 6) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    AM
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    MN
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Resultat_Liste_Personnages->job == 7) { ?>
                                <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                    Dragon
                                <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                    Soin
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        </td>
                        <td><?php echo $Resultat_Liste_Personnages->level; ?></td>
                        <td><?php echo $Resultat_Liste_Personnages->exp; ?></td>
                        <td>
                            <?php echo $lJours . " jours et " . $lHeure . "h" . $lesMinutes . "min."; ?>
                        </td>
                        <td><?php echo $Resultat_Liste_Personnages->ip ?></td>

                        <?php
                        $Parametres_Verification_Connecte->execute(array(
                            $Resultat_Liste_Personnages->id));
                        $Parametres_Verification_Connecte->setFetchMode(PDO::FETCH_OBJ);
                        $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
                        ?>
                        <?php if ($Resultat_Verification_Connecte != "1") { ?>
                            <td title="Hors-ligne" align="center">
                                <img class="Deplacement_Status" src="../images/offline.gif" />
                            </td>
                        <?php } else { ?>
                            <td title="En ligne" align="center">
                                <img class="Deplacement_Status" src="../images/online.gif" />

                            </td>
                        <?php } ?>
                    </tr>

                <?php } ?>

            <?php } else { ?>
                <tr>
                    <td colspan="8">
                        Aucuns personnages.
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>

    <table id="Tableau_Bonus" class="box_shadows">

        <?php
        $Resultat_Appel_Compte->autoloot_expire = strtotime(str_replace("-", "/", $Resultat_Appel_Compte->autoloot_expire));
        $Resultat_Appel_Compte->gold_expire = strtotime(str_replace("-", "/", $Resultat_Appel_Compte->gold_expire));
        $Resultat_Appel_Compte->silver_expire = strtotime(str_replace("-", "/", $Resultat_Appel_Compte->silver_expire));
        $Resultat_Appel_Compte->safebox_expire = strtotime(str_replace("-", "/", $Resultat_Appel_Compte->safebox_expire));
        $Resultat_Appel_Compte->money_drop_rate_expire = strtotime(str_replace("-", "/", $Resultat_Appel_Compte->money_drop_rate_expire));
        $Resultat_Appel_Compte->fish_mind_expire = strtotime(str_replace("-", "/", $Resultat_Appel_Compte->fish_mind_expire));
        $Resultat_Appel_Compte->marriage_fast_expire = strtotime(str_replace("-", "/", $Resultat_Appel_Compte->marriage_fast_expire));
        ?>

        <tr>

            <td width="25%"><?php echo $Array_BonusCompte['autoloot_expire'] ?><span id="Compteloot" style="position: relative; top:-11px; left:12px;"></span></td>

            <td width="25%"><?php echo $Array_BonusCompte['gold_expire'] ?><span id="Comptegold" style="position: relative; top:-11px; left:12px;"></span></td>

            <td width="25%"><?php echo $Array_BonusCompte['silver_expire'] ?><span id="Comptesilver" style="position: relative; top:-11px; left:12px;"></span></td>

            <td width="25%"><?php echo $Array_BonusCompte['marriage_fast_expire'] ?><span id="Comptelove" style="position: relative; top:-11px; left:12px;"></span></td>
        </tr>

        <tr>
            <td width="25%"><?php echo $Array_BonusCompte['safebox_expire'] ?><span id="Comptesafebox" style="position: relative; top:-11px; left:12px;"></span></td>

            <td width="25%"><?php echo $Array_BonusCompte['money_drop_rate_expire'] ?><span id="Comptemonnaie" style="position: relative; top:-11px; left:12px;"></span></td>

            <td width="25%"><?php echo $Array_BonusCompte['fish_mind_expire'] ?><span id="Comptepeche" style="position: relative; top:-11px; left:12px;"></span></td>

            <td width="25%">&nbsp;</td>
        </tr>
    </table>

    <script type="text/JavaScript">
                                                                                                                                                                                
        var dateStringautoloot = "<?php echo $Resultat_Appel_Compte->autoloot_expire; ?>";  
        var dateStringgold = "<?php echo $Resultat_Appel_Compte->gold_expire; ?>";  
        var dateStringsilverexpire = "<?php echo $Resultat_Appel_Compte->silver_expire; ?>";
        var dateStringsafebox = "<?php echo $Resultat_Appel_Compte->safebox_expire; ?>";
        var dateStringmonnaie = "<?php echo $Resultat_Appel_Compte->money_drop_rate_expire; ?>";
        var dateStringpeche = "<?php echo $Resultat_Appel_Compte->fish_mind_expire; ?>";
        var dateStringlove = "<?php echo $Resultat_Appel_Compte->marriage_fast_expire; ?>";
                
        var dateactuel = "<?php echo $Date_Actuel_En_Seconde; ?>";
        nombreseconde = 0;
        Nombre_Seconde_Gold = 0;
        Nombre_Seconde_Silver = 0;
        Nombre_Seconde_Love = 0;
        Nombre_Seconde_SafeBox = 0;
        Nombre_Seconde_Monnaie = 0;
        Nombre_Seconde_Peche = 0;
                
        function Compte_A_Rebour() {                                                                                                 

            if (dateStringautoloot != "0"){
                var sec = (dateStringautoloot - dateactuel)-nombreseconde;
                var n = (24 * 3600);
                if (sec > 0) {
                    y = Math.floor (sec / (n*365));
                    j2 = Math.floor (sec / n);
                    j = Math.floor ((sec / n)-(y*365));
                    h = Math.floor (((sec - (j2 * n)) / 3600));
                    mn = Math.floor ((sec - ((j2 * n + h * 3600))) / 60);
                    sec = Math.floor (sec - ((j2 * n + h * 3600 + mn * 60)));
                    if(mn<10){
                                                                                                                                                                    
                        mn = "0"+mn;
                    }
                    nombreseconde++;
                    document.getElementById('Compteloot').innerHTML = ""+ y + " ans, " + j +" jours, "+ h +"H"+ mn +" et "+ sec + "s";
                }else{
                                                                                                                                                            
                    document.getElementById('Compteloot').innerHTML = "Vous n'avez pas ce bonus.";
                }
            }else{
                    
                document.getElementById('Compteloot').innerHTML = "Vous n'avez pas ce bonus.";
            }
                     
            if (dateStringgold != "0"){
                var sec = (dateStringgold - dateactuel)-Nombre_Seconde_Gold;
                var n = (24 * 3600);
                if (sec > 0) {
                    y = Math.floor (sec / (n*365));
                    j2 = Math.floor (sec / n);
                    j = Math.floor ((sec / n)-(y*365));
                    h = Math.floor (((sec - (j2 * n)) / 3600));
                    mn = Math.floor ((sec - ((j2 * n + h * 3600))) / 60);
                    sec = Math.floor (sec - ((j2 * n + h * 3600 + mn * 60)));
                    if(mn<10){
                                                                                                                                                                    
                        mn = "0"+mn;
                    }
                    Nombre_Seconde_Gold++;
                    document.getElementById('Comptegold').innerHTML = ""+ y + " ans, " + j +" jours, "+ h +"H"+ mn +" et "+ sec + "s";
                }else{
                                                                                                                                                            
                    document.getElementById('Comptegold').innerHTML = "Vous n'avez pas ce bonus.";
                }
            }else{
                    
                document.getElementById('Comptegold').innerHTML = "Vous n'avez pas ce bonus.";
            }
                    
            if (dateStringsilverexpire != "0"){
                var sec = (dateStringsilverexpire - dateactuel)-Nombre_Seconde_Silver;
                var n = (24 * 3600);
                if (sec > 0) {
                    y = Math.floor (sec / (n*365));
                    j2 = Math.floor (sec / n);
                    j = Math.floor ((sec / n)-(y*365));
                    h = Math.floor (((sec - (j2 * n)) / 3600));
                    mn = Math.floor ((sec - ((j2 * n + h * 3600))) / 60);
                    sec = Math.floor (sec - ((j2 * n + h * 3600 + mn * 60)));
                    if(mn<10){
                                                                                                                                                                    
                        mn = "0"+mn;
                    }
                    Nombre_Seconde_Silver++;
                    document.getElementById('Comptesilver').innerHTML = ""+ y + " ans, " + j +" jours, "+ h +"H"+ mn +" et "+ sec + "s";
                }else{
                                                                                                                                                            
                    document.getElementById('Comptesilver').innerHTML = "Vous n'avez pas ce bonus.";
                }
            }else{
                    
                document.getElementById('Comptesilver').innerHTML = "Vous n'avez pas ce bonus.";
            }
                    
            if (dateStringlove != "0"){
                var sec = (dateStringlove - dateactuel)-Nombre_Seconde_Love;
                var n = (24 * 3600);
                if (sec > 0) {
                    y = Math.floor (sec / (n*365));
                    j2 = Math.floor (sec / n);
                    j = Math.floor ((sec / n)-(y*365));
                    h = Math.floor (((sec - (j2 * n)) / 3600));
                    mn = Math.floor ((sec - ((j2 * n + h * 3600))) / 60);
                    sec = Math.floor (sec - ((j2 * n + h * 3600 + mn * 60)));
                    if(mn<10){
                                                                                                                                                                    
                        mn = "0"+mn;
                    }
                    Nombre_Seconde_Love++;
                    document.getElementById('Comptelove').innerHTML = ""+ y + " ans, " + j +" jours, "+ h +"H"+ mn +" et "+ sec + "s";
                }else{
                                                                                                                                                            
                    document.getElementById('Comptelove').innerHTML = "Vous n'avez pas ce bonus.";
                }
            }else{
                    
                document.getElementById('Comptelove').innerHTML = "Vous n'avez pas ce bonus.";
            }
                    
            if (dateStringsafebox != "0"){
                var sec = (dateStringsafebox - dateactuel)-Nombre_Seconde_SafeBox;
                var n = (24 * 3600);
                if (sec > 0) {
                    y = Math.floor (sec / (n*365));
                    j2 = Math.floor (sec / n);
                    j = Math.floor ((sec / n)-(y*365));
                    h = Math.floor (((sec - (j2 * n)) / 3600));
                    mn = Math.floor ((sec - ((j2 * n + h * 3600))) / 60);
                    sec = Math.floor (sec - ((j2 * n + h * 3600 + mn * 60)));
                    if(mn<10){
                                                                                                                                                                    
                        mn = "0"+mn;
                    }
                    Nombre_Seconde_SafeBox++;
                    document.getElementById('Comptesafebox').innerHTML = ""+ y + " ans, " + j +" jours, "+ h +"H"+ mn +" et "+ sec + "s";
                }else{
                                                                                                                                                            
                    document.getElementById('Comptesafebox').innerHTML = "Vous n'avez pas ce bonus.";
                }
            }else{
                    
                document.getElementById('Comptesafebox').innerHTML = "Vous n'avez pas ce bonus.";
            }
                    
            if (dateStringmonnaie != "0"){
                var sec = (dateStringmonnaie - dateactuel)-Nombre_Seconde_Monnaie;
                var n = (24 * 3600);
                if (sec > 0) {
                    y = Math.floor (sec / (n*365));
                    j2 = Math.floor (sec / n);
                    j = Math.floor ((sec / n)-(y*365));
                    h = Math.floor (((sec - (j2 * n)) / 3600));
                    mn = Math.floor ((sec - ((j2 * n + h * 3600))) / 60);
                    sec = Math.floor (sec - ((j2 * n + h * 3600 + mn * 60)));
                    if(mn<10){
                                                                                                                                                                    
                        mn = "0"+mn;
                    }
                    Nombre_Seconde_Monnaie++;
                    document.getElementById('Comptemonnaie').innerHTML = ""+ y + " ans, " + j +" jours, "+ h +"H"+ mn +" et "+ sec + "s";
                }else{
                                                                                                                                                            
                    document.getElementById('Comptemonnaie').innerHTML = "Vous n'avez pas ce bonus.";
                }
            }else{
                    
                document.getElementById('Comptemonnaie').innerHTML = "Vous n'avez pas ce bonus.";
            }
                    
            if (dateStringpeche != "0"){
                var sec = (dateStringpeche - dateactuel)-Nombre_Seconde_Peche;
                var n = (24 * 3600);
                if (sec > 0) {
                    y = Math.floor (sec / (n*365));
                    j2 = Math.floor (sec / n);
                    j = Math.floor ((sec / n)-(y*365));
                    h = Math.floor (((sec - (j2 * n)) / 3600));
                    mn = Math.floor ((sec - ((j2 * n + h * 3600))) / 60);
                    sec = Math.floor (sec - ((j2 * n + h * 3600 + mn * 60)));
                    if(mn<10){
                                                                                                                                                                    
                        mn = "0"+mn;
                    }
                    Nombre_Seconde_Peche++;
                    document.getElementById('Comptepeche').innerHTML = ""+ y + " ans, " + j +" jours, "+ h +"H"+ mn +" et "+ sec + "s";
                }else{
                                                                                                                                                            
                    document.getElementById('Comptepeche').innerHTML = "Vous n'avez pas ce bonus.";
                }
            }else{
                    
                document.getElementById('Comptepeche').innerHTML = "Vous n'avez pas ce bonus.";
            }
                                                                                                                                                                                                                                                                                                                                                
            tRebour2 = setTimeout("Compte_A_Rebour();", 1000);
        }
        Compte_A_Rebour();
    </script>
</div>