<?php

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

if (!defined("BASE_ROOT")) {
    define('BASE_ROOT', dirname(__DIR__));
}

require_once BASE_ROOT . '/vendor/autoload.php';

use Symfony\Component\ClassLoader\ClassLoader;

$loader = new ClassLoader();

$loader->addPrefix('', array(
    BASE_ROOT . '/core/class'
));

$loader->register();

\Carbon\Carbon::setLocale('fr');