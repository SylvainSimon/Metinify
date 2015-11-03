<?php

use Pimple\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class ServicesHelper {

    public $container;

    public function __construct() {

        $container = new Container();

        $container['session'] = function ($container) {
            $session = new Session();
            if (session_id() == '') {
                $session->start();
                $session->replace($_SESSION);
            }
            return $session;
        };

        $container['request'] = function ($container) {
            $request = Request::createFromGlobals();
            return $request;
        };
        
        $container['config'] = function ($container) {
            $config = new ConfigHelper();
            return $config;
        };

        $container['pdo'] = function ($container) {
            $config = $container['config'];
            $connexion = new \PDO('' . $config->objInstance->driverbdd . ':host=' . $config->objInstance->hostbdd . ';charset=utf8', $config->objInstance->userbdd, $config->objInstance->passwordbdd);
            return $connexion;
        };

        $container['twig'] = function ($container) {
            
            $arrayOfFileSystem = [
                BASE_ROOT. '/pages/Classements/templates/',
                BASE_ROOT. '/pages/Inscription/templates/',
                BASE_ROOT. '/pages/ItemShop/templates/',
                BASE_ROOT. '/pages/Messagerie/templates/',
                BASE_ROOT. '/pages/MonCompte/templates/',
                BASE_ROOT. '/pages/MonPersonnage/templates/',
                BASE_ROOT. '/pages/Statistiques/templates/',
                BASE_ROOT. '/pages/Votes/templates/',
                BASE_ROOT. '/pages/_LegacyPages/templates/',
            ];
            
            
            $loader = new Twig_Loader_Filesystem($arrayOfFileSystem);
            $twig = new Twig_Environment($loader, array(
                'cache' => BASE_ROOT. '/tmp/twig',
            ));
            
            return $twig;
        };

        $this->container = $container;
    }

}
