<?php

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\YamlFileLoader;

class TranslateHelper {

    public $objInstance;

    public function __construct($request) {

        $host = explode('.', $request->getHost());
        $sousDomaines = array_slice($host, 0, count($host) - 2);

        $sousDomaine = "fr";
        if (count($sousDomaines) > 0) {
            $sousDomaine = end($sousDomaines);
        }
        
        $translator = new Translator($sousDomaine, new MessageSelector());
        $translator->addLoader('yaml', new YamlFileLoader());
        $translator->setFallbackLocales(array('fr'));
        
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/common.fr.yml', 'fr', 'common');
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/common.' . $sousDomaine . '.yml', $sousDomaine, 'common');
        
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/menu.fr.yml', 'fr', 'menu');
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/menu.' . $sousDomaine . '.yml', $sousDomaine, 'menu');
        
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/map.fr.yml', 'fr', 'map');
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/map.' . $sousDomaine . '.yml', $sousDomaine, 'map');
        
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/grade.fr.yml', 'fr', 'grade');
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/grade.' . $sousDomaine . '.yml', $sousDomaine, 'grade');
        
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/item_attr.fr.yml', 'fr', 'itemAttr');
        $translator->addResource('yaml', BASE_ROOT . '/core/translations/item_attr.' . $sousDomaine . '.yml', $sousDomaine, 'itemAttr');
        
        $this->objInstance = $translator;
    }

}
