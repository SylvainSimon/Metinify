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

        $container['request'] = function ($container) {
            
            $loader = new Twig_Loader_Filesystem(BASE_ROOT. '/template');
            $twig = new Twig_Environment($loader, array(
                'cache' => BASE_ROOT. '/tmp/twig',
            ));
            
            return $twig;
        };

        $this->container = $container;
    }

}
