<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Mot_De_Passe_Oublie_Resultat extends \PageHelper {

    public function run() {
        ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Tirage au sort de noël</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                <?php if (empty($_SESSION['Utilisateur'])) { ?>
                    Vous devez être connecté afin de participer au concours et remporter de gros lots !
                    <hr class="Hr_Bas">
                </div>
            </div>
            <noscript>
        <?php } ?>

        <?php
        $Verification_IP = $_SERVER['REMOTE_ADDR'];
        $Verification_Compte = $_SESSION['Utilisateur'];

        /* ------------------------------ Vérification Données Ip---------------------------------------------- */
        $Verification_Concours_Ip = "SELECT ip FROM site.concours
                            WHERE ip = '" . $Verification_IP . "'
                            LIMIT 1";
        $Parametres_Verification_Concours_Ip = $this->objConnection->query($Verification_Concours_Ip);
        $Parametres_Verification_Concours_Ip->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Ip = $Parametres_Verification_Concours_Ip->rowCount();
        /* -------------------------------------------------------------------------------------------------- */

        /* ------------------------------ Vérification Données2 Comptes--------------------------------------------- */
        $Verification_Concours = "SELECT compte FROM site.concours
                            WHERE compte = '" . $Verification_Compte . "'
                            ";
        $Parametres_Verification_Concours = $this->objConnection->query($Verification_Concours);
        $Parametres_Verification_Concours->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Concours->rowCount();
        /* -------------------------------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat_Ip == 1 OR $Nombre_De_Resultat == 1) {
            ?>

            Votre participation a déjà été prise en compte !
        <?php } else { ?>
            Votre participation a bien été prise en compte !<br />
            Les résultats seront donnés le 27.12.2013.<br />
            <?php
            if (empty($_SESSION['Utilisateur'])) {
                
            } else {

                $Insertion_Logs2 = "INSERT INTO site.concours (compte, ip) 
                          VALUES (:compte, :ip)";

                $Paremetres_Insertion2 = $this->objConnection->prepare($Insertion_Logs2);
                $Paremetres_Insertion2->execute(array(
                    ':compte' => $Verification_Compte,
                    ':ip' => $Verification_IP));
            }
            ?>

        <?php } ?>
        <hr class="Hr_Bas">
        </div>

        </div>
        <?php
    }

}

$class = new Mot_De_Passe_Oublie_Resultat();
$class->run();
