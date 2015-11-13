<?php

use Pimple\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class ServicesHelper {

    public $container;

    public function __construct() {

        global $container;

        $container = new Container();

        $container['session'] = function ($container) {
            $session = new Session();
            if (session_id() == '') {
                $session->start();
            }
            return $session;
        };

        $container['request'] = function ($container) {
            $request = Request::createFromGlobals();
            return $request;
        };

        $container['config'] = function ($container) {
            $config = new ConfigHelper();
            return $config->objInstance;
        };

        $container['pdo'] = function ($container) {
            $config = $container['config'];
            $connexion = new \PDO('' . $config->driverbdd . ':host=' . $config->hostbdd . ';charset=utf8', $config->userbdd, $config->passwordbdd);
            return $connexion;
        };

        $container['twig'] = function ($container) {

            $config = $container['config'];

            $arrayOfFileSystem = [
                BASE_ROOT . '/pages/Admin/templates/',
                BASE_ROOT . '/pages/Admin/templates/emails',
                BASE_ROOT . '/pages/Classements/templates/',
                BASE_ROOT . '/pages/Inscription/templates/',
                BASE_ROOT . '/pages/Inscription/templates/emails',
                BASE_ROOT . '/pages/ItemShop/templates/modules',
                BASE_ROOT . '/pages/ItemShop/templates/emails',
                BASE_ROOT . '/pages/Messagerie/templates/modules',
                BASE_ROOT . '/pages/Messagerie/templates/emails',
                BASE_ROOT . '/pages/MonCompte/templates/modules',
                BASE_ROOT . '/pages/MonCompte/templates/emails',
                BASE_ROOT . '/pages/MonPersonnage/templates/',
                BASE_ROOT . '/pages/Statistiques/templates/',
                BASE_ROOT . '/pages/Votes/templates/',
                BASE_ROOT . '/pages/_LegacyPages/templates/',
                BASE_ROOT . '/pages/_Home/templates/modules/',
                BASE_ROOT . '/core/templates/',
            ];

            if ($config->twigCache) {
                $urlCache = BASE_ROOT . $config->twigCacheUrl;
            } else {
                $urlCache = false;
            }

            $loader = new Twig_Loader_Filesystem($arrayOfFileSystem);

            $twig = new Twig_Environment($loader, array(
                'cache' => $urlCache,
            ));

            $twig->addExtension(new StringFunctionExtension());
            $twig->addExtension(new DateFunctionExtension());
            $twig->addExtension(new Twig_Extension_Debug());
            $twig->addExtension(new EncryptExtension());
            
            $twig->addGlobal('session', $container['session']);
            $twig->addGlobal('request', $container['request']);
            
            return $twig;
        };


        $container['doctrine.eventManager'] = function ($container) {
            $eventManager = new \Doctrine\Common\EventManager();
            return $eventManager;
        };

        $container['doctrine.connection.default'] = function ($container) {

            $param = $container['config'];

            $config = new \Doctrine\DBAL\Configuration();

            // build connection parameters
            $connectionParameters = array(
                'dbname' => "site",
                'user' => $param->userbdd,
                'password' => $param->passwordbdd,
                'host' => $param->hostbdd,
                'port' => $param->portbdd,
            );

            switch (strtolower($param->driverbdd)) {
                case 'mysql':
                    $connectionParameters['driver'] = 'pdo_mysql';
                    $connectionParameters['charset'] = strtolower($param->charsetbdd);
                    break;
                default:
                    throw new RuntimeException('Database driver ' . $param->driverbdd . ' not known by doctrine.');
            }

            /* if (!empty($GLOBALS['TL_CONFIG']['dbPdoDriverOptions'])) {
              $connectionParameters['driverOptions'] = deserialize($GLOBALS['TL_CONFIG']['dbPdoDriverOptions'], true);
              } */

            $connectionParameters['defaultTableOptions'] = array(
                'collate' => 'utf8_general_ci');

            /** @var \Doctrine\Common\EventManager $eventManager */
            $eventManager = $container['doctrine.eventManager'];

            // establish connection
            $connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParameters, $config, $eventManager);
            $connection->getConfiguration()->setSQLLogger(null);

            // fix platform differences
            $platform = $connection->getDatabasePlatform();
            $platform->registerDoctrineTypeMapping('bit', 'boolean');

            return $connection;
        };

        $container['doctrine.orm.entitiesCacheDir'] = function($container) {
            $entitiesCacheDir = BASE_ROOT . '/cache/doctrine/entities';
            if (!is_dir($entitiesCacheDir)) {
                mkdir($entitiesCacheDir, 0777, true);
            }

            $classLoader = new \Composer\Autoload\ClassLoader();
            $classLoader->add('', array(
                $entitiesCacheDir), true);
            $classLoader->register(true);
            $container['doctrine.orm.entitiesClassLoader'] = $classLoader;

            return $entitiesCacheDir;
        };

        $container['doctrine.orm.proxiesCacheDir'] = function($container) {
            $proxiesCacheDir = BASE_ROOT . '/cache/doctrine/proxies';
            if (!is_dir($proxiesCacheDir)) {
                mkdir($proxiesCacheDir, 0777, true);
            }

            return $proxiesCacheDir;
        };

        $container['doctrine.orm.repositoriesCacheDir'] = function($container) {
            $repositoriesCacheDir = BASE_ROOT . '/cache/doctrine/repositories';
            if (!is_dir($repositoriesCacheDir)) {
                mkdir($repositoriesCacheDir, 0777, true);
            }

            return $repositoriesCacheDir;
        };

        $container['doctrine.orm.entityManager'] = function ($container) {

            $param = $container['config'];

            $paths = array(
                BASE_ROOT . '/core/library/Account/Entity',
                BASE_ROOT . '/core/library/Player/Entity',
            );

            $isDevMode = false;

            $config = \Doctrine\ORM\Tools\Setup::createConfiguration($isDevMode);

            // Configuration
            $config = new Doctrine\ORM\Configuration();

            $config->addCustomStringFunction('PASSWORD', '\DoctrinePasswordExtension');

            // Proxy Configuration
            $proxiesCacheDir = $container['doctrine.orm.proxiesCacheDir'];
            $config->setProxyDir($proxiesCacheDir);
            $config->setProxyNamespace('entities\proxies');

            switch ($param->cacheBdd) {
                case 'apc':
                    $cache = new \Doctrine\Common\Cache\ApcCache();
                    break;
                case 'array':
                    $cache = new \Doctrine\Common\Cache\ArrayCache();
                    break;
                case false:
                    $cache = false;
                    break;
            }

            if (!$cache) {
                // Mapping Configuration
                $entitiesCacheDir = $container['doctrine.orm.entitiesCacheDir'];
                $reader = new \Doctrine\Common\Annotations\FileCacheReader(
                        new \Doctrine\Common\Annotations\AnnotationReader(), $entitiesCacheDir, $debug = false
                );
            } else {
                $reader = new \Doctrine\Common\Annotations\CachedReader(
                        new \Doctrine\Common\Annotations\AnnotationReader(), $cache, $debug = false
                );
            }

            $driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, $paths);

            //$driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(new \Doctrine\Common\Annotations\AnnotationReader(), $paths);
            // registering noop annotation autoloader - allow all annotations by default
            \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
            $config->setMetadataDriverImpl($driverImpl);

            // Caching Configuration
            $cache = new \Doctrine\Common\Cache\ArrayCache();
            $config->setMetadataCacheImpl($cache);
            $config->setQueryCacheImpl($cache);
            //$config->setAutoGenerateProxyClasses(false);

            /** @var $connection \Doctrine\DBAL\Connection */
            $connection = $container['doctrine.connection.default'];

            /** @var $eventManager \Doctrine\Common\EventManager */
            $eventManager = $container['doctrine.eventManager'];

            /** @var $entityManager \Doctrine\ORM\EntityManager */
            $entityManager = \Doctrine\ORM\EntityManager::create($connection, $config, $eventManager);

            return $entityManager;
        };


        $this->container = $container;
    }

}
