<?php


namespace App\Service\Generic\Utils;


use DateTime;

class DateUtils
{
    static function curTimestamp()
    {
        $date = new DateTime();

        return $date->getTimestamp();
    }
}