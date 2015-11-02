<?php

class CoreHelper {

    public $objConnection;
    public $objConfig;
    public $objSession;

    public function __construct() {

        include BASE_ROOT . '/configPDO.php';
        $this->objConnection = $Connexion;

        $instanceConfig = new ConfigHelper();
        $this->objConfig = $instanceConfig->objInstance;

        $service = new ServicesHelper();
        $container = $service->container;
        $session = $container["session"];
        $this->objSession = $session;

        if (!$this->objConfig->requiredSSL) {
            $this->redirectToSSL();
        }
    }

    public function redirectToSSL() {

        if (filter_input(INPUT_SERVER, "HTTPS") !== null) {
            $newUrl = str_replace("http", "https", filter_input(INPUT_SERVER, "SCRIPT_NAME"));
            header("Location: $newUrl");
            exit;
        }
    }

}
