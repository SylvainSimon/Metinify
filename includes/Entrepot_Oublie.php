<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php @include_once '../configPDO.php'; ?>
<?php @include_once '../pages/Fonctions_Utiles.php'; ?>



<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Code d'entrep&ocirc;t oubli&eacute;</h1>
    </div>
			<div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
			        <hr class="Hr_Haut"/>
<p>
Vous avez reçu un E-Mail contenant le code de votre entrepôt.<br />
</p>
        <hr class="Hr_Bas"/>
			</div>
        </form>
</div>


<?php

/* ------------------------ Vérification Données ---------------------------- */
$Recuperatio_Entrepot_Password = "SELECT safebox.password FROM account.account
									LEFT JOIN player.safebox
									ON account.id = safebox.account_id
                                    WHERE account.id = ?
									LIMIT 1";
$Parametres_Entrepot_Password = $Connexion->prepare($Recuperatio_Entrepot_Password);
$Parametres_Entrepot_Password->execute(array(
    $_SESSION['ID']));
$Parametres_Entrepot_Password->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat = $Parametres_Entrepot_Password->rowCount();
/* -------------------------------------------------------------------------- */
if ($Nombre_De_Resultat > 0) {

$Donnes_Password = $Parametres_Entrepot_Password->fetch();

    $to = $_SESSION['Email'];

    $subject = 'VamosMt2 - Mot de passe entrepot';

    $headers = "From: \"VamosMt2\" <noreplay@vamosmt2.org>" . "\n";
    $headers .= "Reply-to: \"VamosMt2\" <noreplay@vamosmt2.org>" . "\r\n";
    $headers .= 'Mime-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "\r\n";

    $msg = 'Bonjour, vous recevez cet E-Mail suite à votre demande de mot de passe entrepot' . "<br/>";
    $msg .= '' . "<br/>";
    $msg .= 'Mot de passe entrepot : ' . $Donnes_Password->password . '' . "<br/>";
    $msg .= '' . "<br/>";
    $msg .= 'Bon jeu ! ' . "<br/>";
    $msg .= '' . "<br/>";

    mail($to, $subject, $msg, $headers);
	
}
else
{

    $to = $_SESSION['Email'];

    $subject = 'VamosMt2 - Mot de passe entrepot';

    $headers = "From: \"VamosMt2\" <noreplay@vamosmt2.org>" . "\n";
    $headers .= "Reply-to: \"VamosMt2\" <noreplay@vamosmt2.org>" . "\r\n";
    $headers .= 'Mime-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "\r\n";

    $msg = 'Bonjour, vous recevez cet E-Mail suite à votre demande de mot de passe entrepot' . "<br/>";
    $msg .= '' . "<br/>";
    $msg .= 'Mot de passe entrepot : 000000 ' . "<br/>";
    $msg .= '' . "<br/>";
    $msg .= 'Pensez à en mettre un plus sécurisé, bon jeu ! ' . "<br/>";
    $msg .= '' . "<br/>";

    mail($to, $subject, $msg, $headers);
	
}
?>