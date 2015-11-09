<?php

class DateTimeHelper {

    public static function stringToFormatedString($string = "", $format = "%A %d %B %Y") {
        $dateConverted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $string)->formatLocalized($format);
        return $dateConverted;
    }

    public static function dateTimeToFormatedString($dateTime = null, $format = "%A %d %B %Y \\à H:i:s") {
        $dateConverted = Carbon\Carbon::instance($dateTime)->formatLocalized($format);
        return $dateConverted;
    }

}
