<?php

class SessionHelper {

    public static function getSession() {
        $service = new ServicesHelper();
        $container = $service->container;
        $session = $container["session"];
        return $session;
    }
    
    public static function destroySession() {
        $service = new ServicesHelper();
        $container = $service->container;
        $session = $container["session"];
        $session->invalidate();
    }

}
