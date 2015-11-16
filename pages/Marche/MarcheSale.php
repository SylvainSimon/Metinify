<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class MarcheSell extends \PageHelper {

    public $isProtected = true;

    public function run() {

        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findPlayers($this->objAccount->getId());
        ?>

        <div class="row">
            <div class="col-lg-4">
                <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>Personnage</th>
                            <th width="120">Classe</th>
                            <th width="30">Lvl</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (count($arrObjPlayers) > 0) { ?>

                            <?php foreach ($arrObjPlayers AS $objPlayers) { ?>

                                <tr data-tooltip="Vendre ce personnage" data-tooltip-position="right" onclick="Chargement_Formulaire_Vente(<?= $objPlayers->getId(); ?>)" class="Pointer">
                                    <td>
                                        <?php if ($objPlayers->getJob() == "0") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/0_mini.png" height="25"/>
                                        <?php } else if ($objPlayers->getJob() == "1") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/1_mini.png" height="25"/>
                                        <?php } else if ($objPlayers->getJob() == "2") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/2_mini.png" height="25"/>
                                        <?php } else if ($objPlayers->getJob() == "3") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/3_mini.png" height="25"/>
                                        <?php } else if ($objPlayers->getJob() == "4") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/4_mini.png" height="25"/>
                                        <?php } else if ($objPlayers->getJob() == "5") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/5_mini.png" height="25"/>
                                        <?php } else if ($objPlayers->getJob() == "6") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/6_mini.png" height="25"/>
                                        <?php } else if ($objPlayers->getJob() == "7") { ?> 
                                            <img class="cadrephotoclassement" src="../../images/races/7_mini.png" height="25"/>
                                        <?php } ?>

                                        <?php echo $objPlayers->getName() ?>
                                    </td>
                                    <td>

                                        <?php if ($objPlayers->getJob() == 0) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                Corps à Corps
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                Mental
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>	
                                        <?php } elseif ($objPlayers->getJob() == 1) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                Assasin
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                Archer
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($objPlayers->getJob() == 2) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                Arme magique
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                Magie Noir
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($objPlayers->getJob() == 3) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                Dragon
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                Soin
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($objPlayers->getJob() == 4) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                CàC
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                Mental
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>	
                                        <?php } elseif ($objPlayers->getJob() == 5) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                Assasin
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                Archer
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($objPlayers->getJob() == 6) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                AM
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                MN
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($objPlayers->getJob() == 7) { ?>
                                            <?php if ($objPlayers->getSkillGroup() == 1) { ?>
                                                Dragon
                                            <?php } elseif ($objPlayers->getSkillGroup() == 2) { ?>
                                                Soin
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $objPlayers->getLevel(); ?></td>
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

                <div style="padding-bottom: 10px; padding-left: 10px;">
                    - Vendez votre personnage contre des monnaies.<br/>
                    - Le personnage sera détaché du compte.<br/>
                    - Il sera remplacé par un personnage factice.<br/>
                    - Votre personnage sera sur la place du marché.<br/>
                    - Cela transfère l'équipement et l'inventaire.<br/>
                    - Le royaume du personnage est celui du compte.<br/>
                    - Le prix minimal est de 2 000 Vamonaies/Tananaies.<br/>
                    - Ce personnage ne doit pas être marié et sans guilde.<br />
                </div>

            </div>
            <div class="col-lg-8">
                <div id="Contenue_Cadre_Vente"  style="padding-top: 5px; padding-right: 15px;">
                    Pour commencer, il faut choisir un personnage à vendre.
                </div>
            </div>
        </div>

        <?php
    }

}

$class = new MarcheSell();
$class->run();
