<?php

class ConfigHelper {

    public $objInstance;

    /**
     * Renvoi l'objet de configuration
     * @return Configula\Config
     */
    public function __construct() {
        $this->objInstance = new Configula\Config(BASE_ROOT . "/config/");
    }

}
