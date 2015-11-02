<?php

use Symfony\Component\HttpFoundation\Session\Session;

class SessionHelper {

    public $objInstance;

    public function __construct() {
        
        $session = new Session();
        $session->start();
        
        $session->replace($_SESSION);

        $this->objInstance = $session;
    }
}
