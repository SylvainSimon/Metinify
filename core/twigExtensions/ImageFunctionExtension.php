<?php

class ImageFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'getimagesize' => new \Twig_SimpleFunction('getimagesize', array($this, 'getimagesize')),
        );
    }

    public function getName() {
        return 'image_extension';
    }
    
    public function getimagesize($url = "") {
        return getimagesize($url);
    }

}
