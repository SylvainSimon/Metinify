<?php

class DateTimeHelper {

    public static function stringToFormatedString($string = "", $format = "%A %d %B %Y") {
        $dateConverted = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $string)->formatLocalized($format);
        return $dateConverted;
    }

    public static function minutesToString($minutes = "") {
        
        $dt = \Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->startOfDay();
        $dt2 = $dt->copy()->addMinute($minutes);
        $var = $dt->diffInMonths($dt2) . " mois, ";
        $var .= $dt->diffInDays($dt2) . " jours et ";
        $var .= $dt->diffInHours($dt2) . " heures";
        
        return $var;
    }

    public static function dateTimeToFormatedString($dateTime, $format = null) {

        if (!is_a($dateTime, 'DateTime')) {
            return '';
        }

        $testYear = $dateTime->format('Y');

        if ($testYear === '0000' or $testYear === '-0001') {
            return '';
        }

        $srtFormat = ($format) ? $format : "d/m/Y H:i:s";

        return $dateTime->format($srtFormat);
    }

}
