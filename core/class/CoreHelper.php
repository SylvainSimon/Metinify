<?php

class CoreHelper {

    public $objConnection;
    public $objConfig;
    public $objSession;

    public function __construct() {

        include 'configPDO.php';
        $this->objConnection = $Connexion;

        $instanceConfig = new ConfigHelper();
        $this->objConfig = $instanceConfig->objInstance;

        $instanceSession = new SessionHelper();
        $this->objSession = $instanceSession->objInstance;

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
