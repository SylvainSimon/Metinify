<?php

class DateFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'getFormatedDateTime' => new \Twig_SimpleFunction('getFormatedDateTime', array($this, 'getFormatedDateTime')),
            'getMinutesToString' => new \Twig_SimpleFunction('getMinutesToString', array($this, 'getMinutesToString')),
        );
    }

    public function getName() {
        return 'datetime_extension';
    }

    public function getFormatedDateTime($dateTime, $format = null) {
        return \DateTimeHelper::dateTimeToFormatedString($dateTime, $format);
    }
    
    public function getMinutesToString($minutes) {
        return \DateTimeHelper::minutesToString($minutes);
    }

}
