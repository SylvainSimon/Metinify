<?php

class ServerHelper {

    public static function testServer($ip = "", $port = "") {

        global $config;

        if ($ip === "") {
            $testIp = $config->ipTestServer;
            $testPort = $config->portTestServer;
        } else {
            $testIp = $ip;
            $testPort = $port;
        }

        if (!$sock = @fsockopen($testIp, $testPort, $num, $error, 0.5)) {
            return false;
        } else {
            fclose($sock);
            return true;
        }
    }

    public static function countOnline($dateTime, $format = null) {
        
        
        
    }

}