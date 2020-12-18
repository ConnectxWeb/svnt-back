<?php


namespace App\Services\Generic\Utils;


use DateTime;

class DateUtils
{
    static function curTimestamp()
    {
        $date = new DateTime();

        return $date->getTimestamp();
    }
}