<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include 'Fonctions_Utiles.php'; ?>
<?php
if (empty($_SESSION['ID'])) {

    echo "Vous n'êtes pas connecté";
    exit();
}
?>
<?php include '../configPDO.php'; ?>

<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Historique de vos connexions</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
        <?php
        /* ------------------------ Listage Connexions ---------------------------- */
        $Listage_Connexions = "SELECT * 
                               FROM $BDD_Site.logs_connexion
                               WHERE id_compte = ?
                               OR compte = ?
                               ORDER BY date DESC
                               LIMIT 0, 20";
        $Parametres_Listage_Connexions = $Connexion->prepare($Listage_Connexions);
        $Parametres_Listage_Connexions->execute(array(
            $_SESSION["ID"],
            $_SESSION["Utilisateur"]));
        $Parametres_Listage_Connexions->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Listage_Connexions = $Parametres_Listage_Connexions->rowCount();
        /* -------------------------------------------------------------------------- */

        /* ------------------------ Recherche Pays ---------------------------- */
        $Recherche_Pays = "SELECT * 
                           FROM $BDD_Site.ip_to_country 
                           WHERE ? BETWEEN IP_FROM AND IP_TO ";
        $Parametres_Recherche_Pays = $Connexion->prepare($Recherche_Pays);
        /* -------------------------------------------------------------------------- */

        /* ------------------------ Traduction Pays ---------------------------- */
        $Traduction_Pays = "SELECT country_name_fr 
                            FROM $BDD_Site.ip_pays_fr 
                            WHERE country_name = ?";
        $Parametres_Traduction_Pays = $Connexion->prepare($Traduction_Pays);
        /* -------------------------------------------------------------------------- */
        ?>
        <table class="Tableau_Logs_Connexions">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Date</th>
                    <th>Adresse IP</th>
                    <th>Pays</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($Nombre_De_Resultat_Listage_Connexions != 0) { ?>

                    <?php while ($Donnees_Listage_Connexions = $Parametres_Listage_Connexions->fetch()) { ?>
                        <tr>
                            <?php if ($Donnees_Listage_Connexions->resultat == 1) { ?>
                                <td>Vous avez établie une connexion</td>
                            <?php } else if($Donnees_Listage_Connexions->resultat == 3){ ?>
                                <td>Tentative de connexion en étant banni</td>
                            <?php } else { ?>
                                <td>Une connexion à échoué avec votre compte</td>
                            <?php } ?>
                            <td><?= Formatage_Date($Donnees_Listage_Connexions->date); ?></td>
                            <td><?= $Donnees_Listage_Connexions->ip; ?></td>

                            <?php if ($Donnees_Listage_Connexions->ip != "") { ?>

                                <?php $ip_formate = ipAdressNumber($Donnees_Listage_Connexions->ip); ?>

                                <?php
                                $Parametres_Recherche_Pays->execute(array(
                                    $ip_formate));
                                $Parametres_Recherche_Pays->setFetchMode(PDO::FETCH_OBJ);
                                $Nombre_De_Resultat_Recherche_Pays = $Parametres_Recherche_Pays->rowCount();
                                $Donnees_Recherche_Pays = $Parametres_Recherche_Pays->fetch();

                                $Nom_Pays_Original = $Donnees_Recherche_Pays->COUNTRY;
                                $Lien_Drapeau = "images/drapeaux/".strtolower($Donnees_Recherche_Pays->CTRY).".png";

                                $Parametres_Traduction_Pays->execute(array(
                                    addslashes($Nom_Pays_Original)));
                                $Parametres_Traduction_Pays->setFetchMode(PDO::FETCH_OBJ);
                                $Nombre_De_Resultat_Traduction_Pays = $Parametres_Traduction_Pays->rowCount();
                                $Donnees_Traduction_Pays = $Parametres_Traduction_Pays->fetch();

                                if ($Nombre_De_Resultat_Traduction_Pays != 0) {
                                    $Nom_Pays_Original = $Donnees_Traduction_Pays->country_name_fr;
                                }
                                ?>

                                <?php if ($Nombre_De_Resultat_Recherche_Pays != 0) { ?>

                            <td align="center" title="<?= $Nom_Pays_Original; ?>"><img src="<?= $Lien_Drapeau ?>" height="11"/></td>

                                <?php } else { ?>
                                    <td>Inconnu</td>
                                <?php } ?>

                            <?php } else { ?>
                                <td></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>

                <?php } else { ?>
                    <tr><td colspan="">Il n'y a aucuns enregistrement dans votre historique de connexion.</td></tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

</div>