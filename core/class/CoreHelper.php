<?php

use Symfony\Component\HttpFoundation\Response;

class CoreHelper {

    public $objConfig;
    public $objSession;
    public $objTwig;
    public $isAdmin = false;
    public $arrAdminRights = [];
    public $objAccount = null;
    public $objAdmin = null;
    public $isConnected = false;
    public $isBanned = false;
    public $response;
    public $isProtected = false;
    public $isAdminProtected = false;
    public $isPage = false;
    public $isScript = false;
    public $isAllowForBlock = false;
    public $ipAdresse = "";

    public function __construct() {

        $service = new ServicesHelper();
        $container = $service->container;

        global $config;
        $config = $container["config"];
        $this->objConfig = $config;

        global $translator;
        $translator = $container["translator"];

        if (!$this->objConfig["requiredSSL"]) {
            $this->redirectToSSL();
        }

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

        $this->ipAdresse = $request->server->get("REMOTE_ADDR");

        if ($session->get("ID") !== null) {
            $this->isConnected = true;
            $objAccount = Account\AccountHelper::getAccountRepository()->find($session->get("ID"));
            $this->objAccount = $objAccount;
            $this->ReloadSessionValues();
            $this->LoadAdminSessionValues();

            if ($this->objAccount->getStatus() == StatusHelper::BANNI) {
                $this->isBanned = true;
            }

            if ($this->isAdminProtected) {
                if (!$this->isAdmin) {
                    include '../../pages/_LegacyPages/News.php';
                    exit();
                }
            }
        } else {
            $this->isConnected = false;
        }

        if ($this->isProtected) {
            $this->ControleConnexion();
        }
    }

    public function ControleConnexion() {

        global $session;
        if ($this->isPage) {
            if ($session->get("ID") !== null) {

                if ($this->objAccount->getStatus() == StatusHelper::BANNI) {


                    if (!$this->isAllowForBlock) {
                        include BASE_ROOT . '/pages/_LegacyPages/Bannissement.php';
                        exit();
                    }
                }

                if ($this->objAccount->getStatus() == StatusHelper::NON_CONFIRME) {
                    if (!$this->isAllowForBlock) {
                        include BASE_ROOT . '/pages/_LegacyPages/AttenteConfirmation.php';
                        exit();
                    }
                }
            } else {
                include '../../pages/_LegacyPages/News.php';
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

    public function VerifMonCompte($idParametre = 0) {

        global $session;

        if ($idParametre != $session->get("ID")) {
            include BASE_ROOT . '/pages/MagicWord.php';
            exit();
        }
    }

    public function VerifMonJoueur($idParametre = 0) {

        global $session;

        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->verifyIsMyPlayer($session->get("ID"), $idParametre);

        if ($objPlayer !== null) {
            return $objPlayer;
        } else {
            include BASE_ROOT . '/pages/MagicWord.php';
            exit();
        }
    }

    public function moduleIsActivated($isActivated = false) {

        if (!$isActivated) {
            include BASE_ROOT . '/pages/_LegacyPages/ErrorDisabled.php';
            exit();
        }
    }

    public function ReloadSessionValues() {

        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */
        global $session;

        $session->set("ID", $this->objAccount->getId());
        $session->set("Utilisateur", $this->objAccount->getLogin());
        $session->set("Email", $this->objAccount->getEmail());
        $session->set("Cash", $this->objAccount->getCash());
        $session->set("Mileage", $this->objAccount->getMileage());
        $session->set("Status", $this->objAccount->getStatus());
    }

    public function LoadAdminSessionValues() {

        $objAdministrationUser = Site\SiteHelper::getAdminsRepository()->findAdministrationUser($this->objAccount->getId());

        if ($objAdministrationUser !== null) {

            $this->objAdmin = $objAdministrationUser;
            $this->isAdmin = $objAdministrationUser->getEstActif();
            $this->arrAdminRights = $objAdministrationUser->getDroits();

            return true;
        } else {
            return false;
        }
    }

    public function VerifyTheRight($droit = 0) {
        if (in_array($droit, $this->arrAdminRights)) {
            return true;
        } else {
            include BASE_ROOT . '/pages/MagicWord.php';
            exit();
        }
    }

    public function HaveTheRight($droit = 0) {
        if (in_array($droit, $this->arrAdminRights)) {
            return true;
        } else {
            return false;
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
