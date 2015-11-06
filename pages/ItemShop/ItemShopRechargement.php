<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class ItemShopRechargement extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        ?>
        <link href="../../css/css/Bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../css/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../css/css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../../css/Item_Shop.css">

        <style>
            html{
                background: none !important;
            }
            body{
                height: 400px !important;
                overflow: hidden !important;
            }
        </style>

        <div class="row">
            <div class="col-lg-12">
                <div class="box box-default flat no-margin">

                    <div class="box-header">
                        <h3 class="box-title">Recharger par Allopass</h3>
                    </div>

                    <div class="box-body">

                        <?php
                        if (!$this->isConnected) {
                            if (!empty($_POST['idcompte'])) {

                                $Id_Compte = $_POST['idcompte'];
                                $Login_Utilisateur = $_POST['nomCompte'];
                            } else {

                                $Id_Compte = "NON";
                                exit();
                            }
                        } else {
                            $Id_Compte = $_SESSION["ID"];
                            $Login_Utilisateur = $_SESSION["Utilisateur"];
                        }
                        ?>


                        Le rechargement par Allopass n'a pas de délais et il est crédité immédiatement quand la paiement est validé par le service.
                        <br/>
                        <br/>
                        <a class="btn btn-primary btn-flat" href="https://payment.allopass.com/buy/buy.apu?ids=227909&idd=898935&forward_target=current&data=<?= $Id_Compte ?>">
                            1 350 Vamonaies
                        </a>
                    </div>
                </div>

                <div class="box box-default flat">

                    <div class="box-header">
                        <h3 class="box-title">Recharger par Paypal</h3>
                    </div>

                    <div class="box-body" style="height: 100%;">

                        Le rechargement par Paypal est plus lent que les autres car il est vérifié manuellement par un administrateur.
                        <br/>
                        Le rechargement sera crédité dans un délais de 24 heures ou moins.
                        <br/>
                        <br/>

                        <div class="row">
                            <div class="col-sm-4">
                                <form  target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="RX9W8ULCKZ3HY">

                                    <input type="hidden" name="on0" value="Choisissez le nombre:">
                                    <input type="hidden" name="os0" value="5000 VamoNaies">

                                    <input type="hidden" name="on1" value="Identifiant">
                                    <input type="hidden" value="<?= $Login_Utilisateur ?>" name="os1" maxlength="200">

                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input class="btn btn-primary btn-flat" type="submit" border="0" value="5 000 Vamonaies  (5€)" name="submit" alt="Payer par Paypal">
                                </form>
                            </div>
                            <div class="col-sm-4">
                                <form  target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="RX9W8ULCKZ3HY">

                                    <input type="hidden" name="on0" value="Choisissez le nombre:">
                                    <input type="hidden" name="os0" value="20000 VamoNaies">

                                    <input type="hidden" name="on1" value="Identifiant">
                                    <input type="hidden" value="<?= $Login_Utilisateur ?>" name="os1" maxlength="200">

                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input class="btn btn-primary btn-flat" type="submit" border="0" value="20 000 Vamonaies (15€)" name="submit" alt="Payer par Paypal">
                                </form>
                            </div>
                            <div class="col-sm-4">
                                <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="RX9W8ULCKZ3HY">

                                    <input type="hidden" name="on0" value="Choisissez le nombre:">
                                    <input type="hidden" name="os0" value="50000 VamoNaies">

                                    <input type="hidden" name="on1" value="Identifiant">
                                    <input type="hidden" value="<?= $Login_Utilisateur ?>" name="os1" maxlength="200">

                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input class="btn btn-primary btn-flat" type="submit" border="0" value="50 000 Vamonaies (35€)" name="submit" alt="Payer par Paypal">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}

$class = new ItemShopRechargement();
$class->run();
