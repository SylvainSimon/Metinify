<?php

class EncryptExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'encrypt' => new \Twig_SimpleFunction('encrypt', array($this, 'encryptString')),
            'decrypt' => new \Twig_SimpleFunction('decrypt', array($this, 'decryptString')),
            'encryptForUrl' => new \Twig_SimpleFunction('encryptForUrl', array($this, 'encryptStringForUrl')),
            'decryptForUrl' => new \Twig_SimpleFunction('decryptForUrl', array($this, 'decryptStringForUrl'))
        );
    }

    public function getName() {
        return 'encrypt_extension';
    }

    public function encryptString($string = "") {
        return \Encryption::encrypt($string);
    }

    public function decryptString($string = "") {
        return \Encryption::decrypt($string);
    }

    public function encryptStringForUrl($string = "") {
        return \Encryption::encryptForUrl($string);
    }

    public function decryptStringForUrl($string = "") {
        return \Encryption::decryptForUrl($string);
    }

}
