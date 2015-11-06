<?php

class PDOHelper {

    public static function getConnexion() {
        $service = new ServicesHelper();
        $container = $service->container;
        $connexion = $container["pdo"];
        return $connexion;
    }

}
