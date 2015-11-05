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
    public $isAllowForBlock = false;

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

        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */
        global $session;
        $session = $container["session"];
        $this->objSession = $session;

        global $request;
        $request = $container["request"];
        $this->objRequest = $request;

        $this->response = new Response();

        if ($session->get("ID") !== null) {
            $objAccount = Account\AccountHelper::getAccountRepository()->find($session->get("ID"));
            $this->objAccount = $objAccount;
            $this->ReloadSessionValues();
        }

        if ($this->isProtected) {
            $this->ControleConnexion();
        }
    }

    public function ControleConnexion() {

        global $session;

        if ($this->isPage) {
            if ($session->get("ID") !== null) {
                if ($this->objAccount->getStatus() == "BLOCK") {

                    if (!$this->isAllowForBlock) {
                        include '../../pages/Bannissement.php';
                        exit();
                    }
                }
            } else {
                include '../../pages/_LegacyPages/Accueil.php';
                exit();
            }
        }
        if ($this->isScript) {
            if ($session->get("ID") !== null) {
                if ($this->objAccount->getStatus() == "BLOCK") {

                    if (!$this->isAllowForBlock) {
                        $this->response->setStatusCode(423);
                        $this->response->setContent("");
                        echo $this->response->send();
                        exit();
                    }
                }
            } else {
                $this->response->setStatusCode(418);
                $this->response->setContent("");
                echo $this->response->send();
                exit();
            }
        }
    }

    public function ReloadSessionValues() {

        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */
        global $session;
        
        $session->set("ID", $this->objAccount->getId());
        $session->set("Utilisateur", $this->objAccount->getLogin());
        $session->set("Email", $this->objAccount->getEmail());
        $session->set("VamoNaies", $this->objAccount->getCash());
        $session->set("TanaNaies", $this->objAccount->getMileage());
        $session->set("Date_de_creation", $this->objAccount->getCreateTime());
        $session->set("Status", $this->objAccount->getStatus());
        $session->set("Pseudo_Messagerie", $this->objAccount->getPseudoMessagerie());
    }

    public function redirectToSSL() {

        if (filter_input(INPUT_SERVER, "HTTPS") !== null) {
            $newUrl = str_replace("http", "https", filter_input(INPUT_SERVER, "SCRIPT_NAME"));
            header("Location: $newUrl");
            exit;
        }
    }

}
