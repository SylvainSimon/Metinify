<?php

class CoreHelper {

    public $objConnection;
    public $objConfig;
    public $objSession;

    public function __construct() {

        include BASE_ROOT . '/configPDO.php';
        
        $service = new ServicesHelper();
        $container = $service->container;
        
        global $config;
        $config = $container["config"];
        $this->objConfig = $config->objInstance;

        if (!$this->objConfig->requiredSSL) {
            $this->redirectToSSL();
        }
        
        /* @var $connexion \PDO */
        global $connexion;
        $connexion = $container["pdo"];
        $this->objConnection  = $connexion;
        
        global $session;
        $session = $container["session"];
        $this->objSession = $session;

        global $request;
        $request = $container["request"];
        $this->objRequest = $request;
    }

    public function redirectToSSL() {

        if (filter_input(INPUT_SERVER, "HTTPS") !== null) {
            $newUrl = str_replace("http", "https", filter_input(INPUT_SERVER, "SCRIPT_NAME"));
            header("Location: $newUrl");
            exit;
        }
    }

}
