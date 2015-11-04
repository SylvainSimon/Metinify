<?php

use Symfony\Component\HttpFoundation\Response;

class CoreHelper {

    public $objConnection;
    public $objConfig;
    public $objSession;
    public $objTwig;
    public $objAccount = null;
    public $response;
    public $isProtected = false;
    public $isPage = false;
    public $isScript = false;

    public function __construct() {

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
        $this->objConnection = $connexion;

        /* @var $twig \Twig_Environment */
        global $twig;
        $twig = $container["twig"];
        $this->objTwig = $twig;

        global $session;
        $session = $container["session"];
        $this->objSession = $session;

        global $request;
        $request = $container["request"];
        $this->objRequest = $request;

        $this->response = new Response();


        if ($this->isProtected) {
            if ($this->isPage) {
                if ($session->get("ID") !== null) {

                    $objAccount = Account\AccountHelper::getAccountRepository()->find($session->get("ID"));
                    if ($objAccount->getStatus() == "BLOCK") {

                        include '../../pages/Bannissement.php';
                        exit();
                    }
                } else {
                    //Va te faire foutre car t'est pas connecté
                }
            }
            if ($this->isScript) {
                if ($session->get("ID") !== null) {

                    $objAccount = Account\AccountHelper::getAccountRepository()->find($session->get("ID"));
                    if ($objAccount->getStatus() == "BLOCK") {

                        $this->response->setStatusCode(423);
                        $this->response->setContent("");
                        echo $this->response->send();
                        exit();
                    }
                } else {

                    $this->response->setStatusCode(418);
                    $this->response->setContent("");
                    echo $this->response->send();
                    exit();
                }
            }
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
