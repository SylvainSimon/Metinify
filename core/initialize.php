<?php

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

if (!defined("BASE_ROOT")) {
    define('BASE_ROOT', dirname(__DIR__));
}

require_once BASE_ROOT . '/vendor/autoload.php';

use Symfony\Component\ClassLoader\ClassLoader;

$loader = new ClassLoader();

$loader->addPrefix('', array(
    BASE_ROOT . '/core/class',
    BASE_ROOT . '/core/class/DoctrineExtension',
    BASE_ROOT . '/core/helpers',
    BASE_ROOT . '/core/library/Account',
    BASE_ROOT . '/core/library/Player',
    BASE_ROOT . '/core/library/Common',
    BASE_ROOT . '/core/library/Shared',
    BASE_ROOT . '/core/library/Site',
    BASE_ROOT . '/core/library'
));

$loader->register();

\Carbon\Carbon::setLocale('fr');