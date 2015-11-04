
        <div class="inline">
            <?php
            /* ------------------------ Vérification Données ---------------------------- */
            $Recuperation_Droits = "SELECT * 
                            FROM site.administration_users
                            WHERE id_compte = :id_compte
                            AND administration_users.support_ticket = 1
                            LIMIT 1";
            $Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
            $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
            $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>

            <?php if ($Nombre_De_Resultat_Recuperation_Droits != 0) { ?>

                <?php
                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Discussion_Attente = "SELECT numero_discussion
                                      FROM site.support_ticket_attente";
                $Parametres_Nombre_Discussion_Attente = $this->objConnection->prepare($Nombre_Discussion_Attente);
                $Parametres_Nombre_Discussion_Attente->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Discussion_Attente = $Parametres_Nombre_Discussion_Attente->rowCount();
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Message_Traitement = "SELECT id
                                      FROM site.support_ticket_traitement
                                      WHERE support_ticket_traitement.id_recepteur = :id_compte
                                      AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Message_Traitement = $this->objConnection->prepare($Nombre_Message_Traitement);
                $Parametres_Nombre_Message_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Message_Traitement = $Parametres_Nombre_Message_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Discussion_Traitement = "SELECT DISTINCT numero_discussion
                                         FROM site.support_ticket_traitement
                                         WHERE support_ticket_traitement.id_recepteur = :id_compte
                                         AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Discussion_Traitement = $this->objConnection->prepare($Nombre_Discussion_Traitement);
                $Parametres_Nombre_Discussion_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Discussion_Traitement = $Parametres_Nombre_Discussion_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                $Message = "message";
                if ($Nombre_De_Resultat_Message_Traitement > 1) {
                    $Message = "messages";
                }
                $Discussion = "discussion";
                if ($Nombre_De_Resultat_Discussion_Traitement > 1) {
                    $Discussion = "discussions";
                }
                $Attente = "ticket";
                if ($Nombre_De_Resultat_Discussion_Attente > 1) {
                    $Attente = "tickets";
                }

                if ($Nombre_De_Resultat_Message_Traitement == 0 and $Nombre_De_Resultat_Discussion_Attente == 0) {
                    echo "<i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='Aucun nouveau message' data-tooltip-position='left' style='cursor:pointer; top: 7px; position: relative;' class='material-icons md-icon-chat md-24'></i>";
                } else {

                    echo "<i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='" . $Nombre_De_Resultat_Message_Traitement . " message non-lu.<br/>".$Nombre_De_Resultat_Discussion_Attente." ticket(s) en attente.' " . $Message . "' style='cursor:pointer; top: 7px; position: relative;' class='material-icons text-green md-icon-chat md-22'></i>";
                }
                
                ?>
                <script type="text/javascript">
            <?php if ($Nombre_De_Resultat_Message_Traitement > 0) { ?>
                        var mon_title = "(<?= $Nombre_De_Resultat_Message_Traitement ?>) VamosMt2 :: Site Officiel"
            <?php } ?>

            <?php if ($Nombre_De_Resultat_Discussion_Attente > 0) { ?>
                        var mon_title = "(<?= $Nombre_De_Resultat_Discussion_Attente ?>) VamosMt2 :: Site Officiel"
            <?php } ?>

            <?php if (($Nombre_De_Resultat_Message_Traitement > 0) && ($Nombre_De_Resultat_Discussion_Attente > 0)) { ?>
                        var mon_title = "(<?= $Nombre_De_Resultat_Message_Traitement ?>) (<?= $Nombre_De_Resultat_Discussion_Attente ?>) VamosMt2 :: Site Officiel"
            <?php } ?>

            <?php if (($Nombre_De_Resultat_Message_Traitement == 0) && ($Nombre_De_Resultat_Discussion_Attente == 0)) { ?>
                        var mon_title = "VamosMt2 :: Site Officiel"
            <?php } ?>
                    document.title = mon_title;

                </script>

            <?php } else { ?>

                <?php
                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Message_Traitement = "SELECT id
                                      FROM site.support_ticket_traitement
                                      WHERE support_ticket_traitement.id_recepteur = :id_compte
                                      AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Message_Traitement = $this->objConnection->prepare($Nombre_Message_Traitement);
                $Parametres_Nombre_Message_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Message_Traitement = $Parametres_Nombre_Message_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                /* ------------------------ Vérification Données ---------------------------- */
                $Nombre_Discussion_Traitement = "SELECT DISTINCT numero_discussion
                                         FROM site.support_ticket_traitement
                                         WHERE support_ticket_traitement.id_recepteur = :id_compte
                                         AND support_ticket_traitement.etat = 'Non-Lu'";
                $Parametres_Nombre_Discussion_Traitement = $this->objConnection->prepare($Nombre_Discussion_Traitement);
                $Parametres_Nombre_Discussion_Traitement->execute(array(':id_compte' => $_SESSION["ID"]));
                $Nombre_De_Resultat_Discussion_Traitement = $Parametres_Nombre_Discussion_Traitement->rowCount();
                /* -------------------------------------------------------------------------- */

                $Message = "message";
                if ($Nombre_De_Resultat_Message_Traitement > 1) {
                    $Message = "messages";
                }
                $Discussion = "discussion";
                if ($Nombre_De_Resultat_Discussion_Traitement > 1) {
                    $Discussion = "discussions";
                }

                if ($Nombre_De_Resultat_Message_Traitement == 0) {
                    echo "<i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='Aucun nouveau message' data-tooltip-position='left' style='cursor:pointer; top: 7px; position: relative;' class='material-icons md-icon-chat md-24'></i>";
                } else {

                    echo "<i onclick='Ajax(\"pages/Messagerie/Messagerie.php\")' data-tooltip='" . $Nombre_De_Resultat_Message_Traitement . " message non-lu' data-tooltip-position='left' " . $Message . "' style='cursor:pointer; top: 7px; position: relative;' class='material-icons text-green md-icon-chat md-22'></i>";
                }
                ?>

                <script type="text/javascript">
            <?php if ($Nombre_De_Resultat_Message_Traitement > 0) { ?>
                        var mon_title = "(<?= $Nombre_De_Resultat_Message_Traitement ?>) VamosMt2 :: Site Officiel"
            <?php } ?>

            <?php if ($Nombre_De_Resultat_Message_Traitement == 0) { ?>
                        var mon_title = "VamosMt2 :: Site Officiel"
            <?php } ?>
                    document.title = mon_title;

                </script>

            <?php } ?>

        </div>