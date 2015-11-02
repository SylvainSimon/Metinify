<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Telechargement extends \PageHelper {

    public function run() {
        ?>
        <?php include 'Fonctions_Utiles.php'; ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Téléchargement du jeu</h3>
            </div>

            <div class="box-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box flat box-telechargement-exe" onclick="window.open('http://vamosmt2.org:81/Installateur%20VamosMT2%20Client%20officiel%202014-2015.exe', '_self')">

                            <span class="info-box-icon"><i class="material-icons md-icon-download md-36"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Télécharger l'installeur .exe</span>

                                <?php
                                $url = 'http://vamosmt2.org:81/Installateur%20VamosMT2%20Client%20officiel%202014-2015.exe';
                                $headers = get_headers($url, true);

                                if (isset($headers['Content-Length'])) {
                                    $size = $headers['Content-Length'];
                                } else {
                                    $size = 0;
                                }
                                ?>

                                <span class="info-box-number"><?php echo Formatage_Taille($size); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box flat box-telechargement-torrent" onclick="window.open('http://vamosmt2.org:81/VamosMT2%20Client%20officiel%202014-2015.exe.torrent', '_self')">

                            <span class="info-box-icon"><i class="material-icons md-icon-shuffle md-36"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Télécharger via torrent</span>

                                <span class="info-box-number"><?php echo Formatage_Taille($size); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">

                        <h4>
                            Configuration minimale
                        </h4>

                        <table class="table table-hover table-condensed table-responsive no-margin" style="border-collapse: collapse;">

                            <tr>
                                <td>Système d'exploitation</td>
                                <td class="Align_Right">Windows & Linux</td>
                            </tr>
                            <tr>
                                <td>Processeur</td>
                                <td class="Align_Right">Pentium 3, 1.0GHz</td>
                            </tr>
                            <tr>
                                <td>Mémoire vive (RAM)</td>
                                <td class="Align_Right">1 GB</td>
                            </tr>
                            <tr>
                                <td>Carte graphique</td>
                                <td class="Align_Right">Sup. à 32Mb de RAM</td>
                            </tr>
                            <tr>
                                <td>Carte son</td>
                                <td class="Align_Right">DirectX 9.0</td>
                            </tr>
                            <tr>
                                <td>Programmes</td>
                                <td class="Align_Right"><a href="http://www.microsoft.com/fr-fr/download/details.aspx?id=17851" target="_blank">Net Framework 4</a></td>
                            </tr>

                        </table>

                    </div>

                    <div class="col-lg-6">

                        <h4>
                            Configuration recommandé
                        </h4>

                        <table class="table table-hover table-condensed table-responsive no-margin" style="border-collapse: collapse;">

                            <tr>
                                <td>Système d'exploitation</td>
                                <td class="Align_Right">Windows & Linux</td>
                            </tr>
                            <tr>
                                <td>Processeur</td>
                                <td class="Align_Right">Pentium 4, 1.8GHz</td>
                            </tr>
                            <tr>
                                <td>Mémoire vive (RAM)</td>
                                <td class="Align_Right">2 GB</td>
                            </tr>
                            <tr>
                                <td>Carte graphique</td>
                                <td class="Align_Right">Sup. à 64Mb de RAM</td>
                            </tr>
                            <tr>
                                <td>Carte son</td>
                                <td class="Align_Right">DirectX 9.0</td>
                            </tr>
                            <tr>
                                <td>Programmes</td>
                                <td class="Align_Right"><a href="http://www.microsoft.com/fr-fr/download/details.aspx?id=17851" target="_blank">Net Framework 4</a></td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}

$class = new Telechargement();
$class->run();
