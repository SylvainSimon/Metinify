<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   medtra_core
 * @author    Cyril Ponce
 * @license   AXESS
 * @copyright Cyril Ponce 2014
 */

namespace Shared;

use \Doctrine\ORM\EntityManager;

class DoctrineHelper
{

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public static function getEntityManager()
    {
        global $container;

        /** @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager = $container['doctrine.orm.entityManager'];
        return $entityManager;
    }

    /**
     * @param string $className
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public static function getRepository($className)
    {
        $entityManager = static::getEntityManager();
        return $entityManager->getRepository($className);
    }

    /**
     * @return \Doctrine\ORM\UnitOfWork
     */
    public static function getUnitOfWork()
    {
        $entityManager = static::getEntityManager();
        return $entityManager->getUnitOfWork();
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public static function getDefaultConnection()
    {
        global $container;
        
        /** @var $entityManager \Doctrine\DBAL\Connection */
        $defaultConnection = $container['doctrine.connection.default'];
        return $defaultConnection;
    }    
}
