<?php

class ConfigHelper {

    public $objInstance;

    /**
     * Renvoi l'objet de configuration
     * @return Configula\Config
     */
    public function __construct() {

        $arrConfig = \Symfony\Component\Yaml\Yaml::parse(BASE_ROOT . "/core/config/main.yml");
        $arrConfigFunctions = \Symfony\Component\Yaml\Yaml::parse(BASE_ROOT . "/core/config/functions.yml");
        $arrConfigLanguage = \Symfony\Component\Yaml\Yaml::parse(BASE_ROOT . "/core/config/language.yml");

        $arrConfig = array_merge($arrConfig, $arrConfigFunctions, $arrConfigLanguage);

        $objConfig = new Configula\Config(BASE_ROOT . "/core/config/");

        if ($objConfig["happy_hours_start"] != 0 and $objConfig["happy_hours_end"] != 0) {

            $dateDebut = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $objConfig["happy_hours_start"]);
            $dateFin = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $objConfig["happy_hours_end"]);

            if (\Carbon\Carbon::now()->between($dateDebut, $dateFin)) {
                $arrConfigHappyHours = \Symfony\Component\Yaml\Yaml::parse(BASE_ROOT . "/core/config/mode/happyHours.yml");
                $arrConfig = array_merge($arrConfig, $arrConfigHappyHours);
            }
        }

        $this->objInstance = $arrConfig;
    }

}
