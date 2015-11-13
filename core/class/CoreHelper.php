<?php

use Symfony\Component\HttpFoundation\Response;

class CoreHelper {

    public $objConnection;
    public $objConfig;
    public $objSession;
    public $objTwig;
    public $isAdmin = false;
    public $arrAdminRights = [];
    public $objAccount = null;
    public $isConnected = false;
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

        $this->ipAdresse = $request->server->get("REMOTE_ADDR");

        if ($session->get("ID") !== null) {
            $this->isConnected = true;
            $objAccount = Account\AccountHelper::getAccountRepository()->find($session->get("ID"));
            $this->objAccount = $objAccount;
            $this->ReloadSessionValues();

            if ($this->isAdminProtected) {
                if (!$this->LoadAdminSessionValues()) {
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

                if ($this->objAccount->getStatus() == "BLOCK") {
                    if (!$this->isAllowForBlock) {
                        include BASE_ROOT . '/pages/Bannissement.php';
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
            include '../../pages/MagicWord.php';
            exit();
        }
    }

    public function VerifMonJoueur($idParametre = 0) {

        global $session;

        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idParametre);

        if ($objPlayer !== null) {

            if ($objPlayer->getIdAccount() != $session->get("ID")) {
                include '../../pages/MagicWord.php';
                exit();
            }else{
                return $objPlayer;
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

    public function LoadAdminSessionValues() {

        $objAdministrationUser = Site\SiteHelper::getAdministrationUsersRepository()->findAdministrationUser($this->objAccount->getId());

        if ($objAdministrationUser !== null) {
            $this->isAdmin = $objAdministrationUser->getPannelAdmin();
            $this->arrAdminRights["supportTicket"] = $objAdministrationUser->getSupportTicket();
            $this->arrAdminRights["rechercheJoueurs"] = $objAdministrationUser->getRechercheJoueurs();
            $this->arrAdminRights["rechercheJoueursAdmin"] = $objAdministrationUser->getRechercheJoueursAdmin();
            $this->arrAdminRights["rechercheComptes"] = $objAdministrationUser->getRechercheComptes();
            $this->arrAdminRights["rechercheGuildes"] = $objAdministrationUser->getRechercheGuildes();
            $this->arrAdminRights["rechercheEmails"] = $objAdministrationUser->getRechercheEmails();
            $this->arrAdminRights["rechercheIps"] = $objAdministrationUser->getRechercheIp();
            $this->arrAdminRights["recherchePecheurs"] = $objAdministrationUser->getRecherchePecheurs();
            $this->arrAdminRights["rechercheMaries"] = $objAdministrationUser->getRechercheMaries();
            $this->arrAdminRights["rechercheItems"] = $objAdministrationUser->getRechercheItems();
            $this->arrAdminRights["rechercheBanissements"] = $objAdministrationUser->getRechercheBannissements();
            $this->arrAdminRights["rechercheRename"] = $objAdministrationUser->getRechercheRenames();
            $this->arrAdminRights["banissement"] = $objAdministrationUser->getBannissement();
            $this->arrAdminRights["banissementIp"] = $objAdministrationUser->getBannissementIp();
            $this->arrAdminRights["debanissement"] = $objAdministrationUser->getDebannissement();
            $this->arrAdminRights["debanissementIp"] = $objAdministrationUser->getDebannissementIp();
            $this->arrAdminRights["voirPersonnage"] = $objAdministrationUser->getVoirPersonnage();
            $this->arrAdminRights["voirCompte"] = $objAdministrationUser->getVoirCompte();
            $this->arrAdminRights["voirDescriptionMembre"] = $objAdministrationUser->getDescriptionMembre();
            $this->arrAdminRights["gererMonnaies"] = $objAdministrationUser->getGererMonnaies();
            $this->arrAdminRights["gererNews"] = $objAdministrationUser->getGererNews();
            $this->arrAdminRights["gererEquipe"] = $objAdministrationUser->getEquipe();
            $this->arrAdminRights["historiqueCommandes"] = $objAdministrationUser->getCommandes();
            $this->arrAdminRights["historiqueMp"] = $objAdministrationUser->getMp();

            return true;
        } else {
            return false;
        }
    }

    public function VerifyTheRight($nameRight = "") {

        if ($this->arrAdminRights[$nameRight]) {
            return true;
        } else {
            include '../../pages/MagicWord.php';
            exit();
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
