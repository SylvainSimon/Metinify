<?php

class ConfigHelper {

    public $objInstance;

    /**
     * Renvoi l'objet de configuration
     * @return Configula\Config
     */
    public function __construct() {

        $objConfig = new Configula\Config(BASE_ROOT . "/core/config/");

        if ($objConfig->getItem("happy_hours_start") != 0 and $objConfig->getItem("happy_hours_end") != 0) {

            $dateDebut = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $objConfig->getItem("happy_hours_start"));
            $dateFin = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $objConfig->getItem("happy_hours_end"));

            if (\Carbon\Carbon::now()->between($dateDebut, $dateFin)) {
                $objConfig->loadConfgFile(BASE_ROOT . "/core/config/mode/happyHours.yml");
            }
        }

        $this->objInstance = $objConfig;
    }

}
