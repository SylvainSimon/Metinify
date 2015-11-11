<?php

class DateFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'getFormatedDateTime' => new \Twig_SimpleFunction('getFormatedDateTime', array($this, 'getFormatedDateTime')),
        );
    }

    public function getName() {
        return 'datetime_extension';
    }

    public function getFormatedDateTime($dateTime, $format = null) {
        return \DateTimeHelper::dateTimeToFormatedString($dateTime, $format);
    }

}
