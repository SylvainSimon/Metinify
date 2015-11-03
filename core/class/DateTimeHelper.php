<?php

class DateTimeHelper {

    public static function stringToFormatedString($string = "", $format = "%A %d %B %Y \\à H:i:s") {
        $dateConverted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $string)->formatLocalized($format);
        return $dateConverted;
    }

}
