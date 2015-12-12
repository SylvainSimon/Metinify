<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class Parametres extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "Parametres.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::PARAMETRES);
    }

    public function run() {

        global $config;

        $new_yaml = \Symfony\Component\Yaml\Yaml::dump($config, 5, 4);
        \Debug::log($new_yaml);
        
        //file_put_contents($this->container->get('kernel')->getRootDir() . '/config/common.yml', $new_yaml);


        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Parametres();
$class->run();
