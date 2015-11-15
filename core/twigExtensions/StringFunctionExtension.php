<?php

class StringFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'truncateString' => new \Twig_SimpleFunction('truncateString', array($this, 'truncateString')),
            'formatNumber' => new \Twig_SimpleFunction('formatNumber', array($this, 'formatNumber')),
            'ip2long' => new \Twig_SimpleFunction('ip2long', array($this, 'ip2long')),
            'long2ip' => new \Twig_SimpleFunction('long2ip', array($this, 'long2ip')),
        );
    }

    public function getName() {
        return 'string_extension';
    }

    public function truncateString($string = "", $limit = 20) {
        return \FonctionsUtiles::Raccourcissement_Chaine($string, $limit);
    }

    public function ip2long($ip = "127.0.0.1") {
        return ip2long($ip);
    }

    public function long2ip($ip) {
        return long2ip($ip);
    }

    public function formatNumber($number) {
        return FonctionsUtiles::Formatage_Yangs($number);
    }

}
