<?php

class Encryption {

    public static $resTd;
    public static $clesCryptage;

    public static function initialize() {
        
        global $config;
        
        if (!in_array('mcrypt', get_loaded_extensions())) {
            throw new \Exception('The PHP mcrypt extension is not installed');
        }
        if ((self::$resTd = mcrypt_module_open("rijndael-256", '', "cfb", '')) == false) {
            throw new \Exception('Error initializing encryption module');
        }
        
        self::$clesCryptage = $config->encryptKey;
    }

    public static function encrypt($varValue, $clesCryptage = null) {

        self::initialize();

        if (is_array($varValue)) {
            foreach ($varValue as $k => $v) {
                $varValue[$k] = urlencode(self::encrypt($v));
            }
            return $varValue;
        } elseif ($varValue == '') {
            return '';
        }

        if ($clesCryptage === null) {
            $clesCryptage = self::$clesCryptage;
        }
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size(self::$resTd), MCRYPT_RAND);
        mcrypt_generic_init(self::$resTd, md5($clesCryptage), $iv);
        $strEncrypted = mcrypt_generic(self::$resTd, $varValue);
        $strEncrypted = base64_encode($iv . $strEncrypted);
        mcrypt_generic_deinit(self::$resTd);
        return $strEncrypted;
    }

    public static function encryptForUrl($varValue, $clesCryptage = null) {

        if (is_array($varValue)) {
            return self::encrypt($varValue, $clesCryptage);
        } else {
            return urlencode(self::encrypt($varValue, $clesCryptage));
        }
    }


    public static function decrypt($varValue, $clesCryptage = null) {

        self::initialize();

        // Recursively decrypt arrays
        if (is_array($varValue)) {
            foreach ($varValue as $k => $v) {
                $varValue[$k] = self::decrypt(urldecode($v));
            }
            return $varValue;
        } elseif ($varValue == '') {
            return '';
        }

        $varValue = base64_decode($varValue);
        $ivsize = mcrypt_enc_get_iv_size(self::$resTd);
        $iv = substr($varValue, 0, $ivsize);
        $varValue = substr($varValue, $ivsize);
        if ($varValue == '') {
            return '';
        }
        if ($clesCryptage === null) {
            $clesCryptage = self::$clesCryptage;
        }
        mcrypt_generic_init(self::$resTd, md5($clesCryptage), $iv);
        $strDecrypted = mdecrypt_generic(self::$resTd, $varValue);
        mcrypt_generic_deinit(self::$resTd);
        return $strDecrypted;
    }

    public static function decryptForUrl($varValue, $clesCryptage = null) {

        if (is_array($varValue)) {
            return self::decrypt($varValue, $clesCryptage);
        } else {
            return self::decrypt(urldecode($varValue), $clesCryptage);
        }
    }

    public static function hash($strPassword) {
        $intCost = \Config::get('bcryptCost') ? : 10;
        if ($intCost < 4 || $intCost > 31) {
            throw new \Exception("The bcrypt cost has to be between 4 and 31, $intCost given");
        }
        if (function_exists('password_hash')) {
            return password_hash($strPassword, PASSWORD_BCRYPT, array('cost' => $intCost));
        } elseif (CRYPT_BLOWFISH == 1) {
            return crypt($strPassword, '$2y$' . sprintf('%02d', $intCost) . '$' . md5(uniqid(mt_rand(), true)) . '$');
        } elseif (CRYPT_SHA512 == 1) {
            return crypt($strPassword, '$6$' . md5(uniqid(mt_rand(), true)) . '$');
        } elseif (CRYPT_SHA256 == 1) {
            return crypt($strPassword, '$5$' . md5(uniqid(mt_rand(), true)) . '$');
        }
        throw new \Exception('None of the required crypt() algorithms is available');
    }


    public static function test($strHash) {
        if (strncmp($strHash, '$2y$', 4) === 0) {
            return true;
        } elseif (strncmp($strHash, '$2a$', 4) === 0) {
            return true;
        } elseif (strncmp($strHash, '$6$', 3) === 0) {
            return true;
        } elseif (strncmp($strHash, '$5$', 3) === 0) {
            return true;
        }
        return false;
    }

    public static function verify($strPassword, $strHash) {
        if (function_exists('password_verify')) {
            return password_verify($strPassword, $strHash);
        }
        $getLength = function($str) {
            return extension_loaded('mbstring') ? mb_strlen($str, '8bit') : strlen($str);
        };
        $newHash = crypt($strPassword, $strHash);
        if (!is_string($newHash) || $getLength($newHash) != $getLength($strHash) || $getLength($newHash) <= 13) {
            return false;
        }
        $intStatus = 0;
        for ($i = 0; $i < $getLength($newHash); $i++) {
            $intStatus |= (ord($newHash[$i]) ^ ord($strHash[$i]));
        }
        return $intStatus === 0;
    }

}
