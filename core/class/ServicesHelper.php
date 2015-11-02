<?php

use Pimple\Container;
use Symfony\Component\HttpFoundation\Session\Session;

class ServicesHelper {

    public $container;

    public function __construct() {

        $container = new Container();
                
        $container['session'] = function ($container) {
            $session = new Session();
            if (!@session_start()) {
                $session->start();
                $session->replace($_SESSION);
            }
            return $session;
        };

        $this->container = $container;
    }

}
