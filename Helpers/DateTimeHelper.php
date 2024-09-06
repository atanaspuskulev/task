<?php

namespace App\Helpers;

use Lib\Config;

class DateTimeHelper
{
    public static function format(string $date, string $format): string
    {
        return date($format, strtotime($date));
    }

    public static function formatFromConfig(string $date): string
    {
        $configFormat = Config::get('DEFAULT_DATE_FORMAT');

        return $configFormat ? self::format($date, $configFormat) : $date;
    }
}